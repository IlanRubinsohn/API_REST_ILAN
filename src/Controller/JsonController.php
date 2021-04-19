<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JsonController extends AbstractController
{
    /**
     * @Route("/json", name="json")
     */
    public function index(): Response
    {

        $data = array(
            "formation" => "SIO",
            "SIO" => array("BTS SIO" => "2",
                "BACHELOR CSI" => "1",
                "MASTER" => "2"
            )
        );

        dd(json_encode($data));

        return $this->render('json/index.html.twig', [
            'controller_name' => 'JsonController',
        ]);
    }
}
