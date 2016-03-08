<?php

namespace AppBundle\Consumer\Example1;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class Example1DeadLetterConsumer implements ConsumerInterface
{

    public function execute(AMQPMessage $msg) {

        $infoHeader = $msg->get("application_headers")->getNativeData();
        $response = json_decode($msg->body, true);

        echo "Message: " . $response["response"] . "  Reason (".$infoHeader['x-death'][0]['reason'].")".PHP_EOL;
        return self::MSG_ACK;
    }

}
