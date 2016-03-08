<?php

namespace AppBundle\Command;

use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SendMessageExample1Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('send:example1')
            ->setDescription('Send message to example 1')
            ->addArgument(
                'response',
                InputArgument::OPTIONAL,
                'Message reply after being processed'
            )
            ->addArgument(
                'times',
                InputArgument::OPTIONAL,
                'Send a message multiple times'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $input->getArgument('response');
        $times = $input->getArgument('times');

        if (!$response) {
            $response = 'Ack';
        }

        if (!$times) {
            $times = 1;
        }

        /** @var Producer $producer */
        $producer = $this->getContainer()->get('old_sound_rabbit_mq.example1_producer');

        for( $x = 0; $x < $times ; $x++ ) {
            $producer->publish(
                json_encode(
                    array (
                        'response' => $response
                    )
                )
            );
            $output->writeln('send message number: '. ($x + 1 ));
        }
    }
}
