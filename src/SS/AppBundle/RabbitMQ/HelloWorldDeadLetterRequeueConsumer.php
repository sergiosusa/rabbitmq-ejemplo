<?php
/**
 * Created by PhpStorm.
 * User: sergiosusa
 * Date: 7/10/15
 * Time: 17:15
 */

namespace SS\AppBundle\RabbitMQ;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use OldSound\RabbitMqBundle\RabbitMq\Producer;
use PhpAmqpLib\Message\AMQPMessage;

class HelloWorldDeadLetterRequeueConsumer implements ConsumerInterface
{

    const MAX_ATTEMPTS = 5;

    protected $producer;

    public function __construct(Producer $producer) {
        $this->producer = $producer;
    }

    public function execute(AMQPMessage $msg) {

        $infoHeader = $msg->get("application_headers")->getNativeData();
        $response = json_decode($msg->body, true);

        echo "Message: " . $response["response"] . "  Reason (".$infoHeader['x-death'][0]['reason'].")".PHP_EOL;

        if ($this->hasMaxAttempts($msg)) {
            echo "Message: max attemps reached".PHP_EOL;
            return ConsumerInterface::MSG_ACK;
        }

        if ($msg->has("application_headers")) {
            $propertiesTable = $msg->get("application_headers");
        }

        $properties = $this->manageAttemps($propertiesTable);


        echo "Message: Re publish in original queue".PHP_EOL;
        $this->producer->publish(
            $msg->body,
            "",
            array('application_headers'=>$properties)
        );

        return self::MSG_ACK;
    }

    /**
     * Initializes and increments the attempt counter
     * @param $properties
     * @return mixed
     */
    protected function manageAttemps($properties) {

        $nativeData = $properties->getNativeData();

        if (isset($nativeData['attempts'])) {
            $attemps = $nativeData['attempts'] + 1;
            echo "Message: " . $attemps . " attemps.".PHP_EOL;
        } else {
            $attemps = "1";
            echo "Message: " . $attemps . " attemps.".PHP_EOL;
        }

        return array('attempts'=>array('I', $attemps));
    }

    /**
     * Verify if message reached max attemps.
     * @param AMQPMessage $msg
     * @return bool
     */
    protected function hasMaxAttempts(AMQPMessage $msg) {

        $AMQPTable = $msg->get("application_headers");
        $properties = $AMQPTable->getNativeData();

        if (isset($properties['attempts'])) {
            $attemps = $properties['attempts'];
            if ($attemps > self::MAX_ATTEMPTS) {
                return true;
            }
        }
        return false;
    }

}
