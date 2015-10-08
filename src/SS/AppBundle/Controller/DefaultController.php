<?php

namespace SS\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {

        $this->get('old_sound_rabbit_mq.hello_world_producer')
            ->publish(
                json_encode(
                    array(
                        "response" => $name
                    )
                )
            );

        return $this->render('SSAppBundle:Default:index.html.twig', array('name' => $name));
    }
}
