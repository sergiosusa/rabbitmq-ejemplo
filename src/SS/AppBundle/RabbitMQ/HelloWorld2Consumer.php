<?php

/**
 * Created by PhpStorm.
 * User: sergiosusa
 * Date: 5/10/15
 * Time: 15:18
 */

namespace SS\AppBundle\RabbitMQ;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class HelloWorld2Consumer implements ConsumerInterface
{

    public function execute(AMQPMessage $msg)
    {

        $body = json_decode($msg->body, true);

        if ($msg->has("application_headers")) {
            $nativeData = $msg->get("application_headers")->getNativeData();
        }

        return $this->readMessage($body, isset($nativeData['attempts']) ? $nativeData['attempts'] : 0);

    }

    public function readMessage(Array $body, $attemps = 0)
    {

        echo "Message: " . $body["response"] . " with " .$attemps . " attemps ". PHP_EOL;

        switch ($body["response"]) {
            case "ack";
                return self::MSG_ACK;
            case "nack_requeue";
                return self::MSG_SINGLE_NACK_REQUEUE;
            case "reject_requeue";
                return self::MSG_REJECT_REQUEUE;
            case "reject";
                return self::MSG_REJECT;
            default:
                return self::MSG_ACK;
        }

    }
}
