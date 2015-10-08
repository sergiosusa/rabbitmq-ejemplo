<?php
/**
 * Created by PhpStorm.
 * User: sergiosusa
 * Date: 7/10/15
 * Time: 17:15
 */

namespace SS\AppBundle\RabbitMQ;


use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class HelloWorldDeadLetterConsumer implements ConsumerInterface
{

    public function execute(AMQPMessage $msg) {

        $infoHeader = $msg->get("application_headers")->getNativeData();
        $response = json_decode($msg->body, true);

        echo "Message: " . $response["response"] . "  Reason (".$infoHeader['x-death'][0]['reason'].")".PHP_EOL;
        return self::MSG_ACK;
    }

}
