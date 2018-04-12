<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatisticController extends Controller
{
    /**
     * @Route("/stat")
     */
    public function statisticAction()
    {
        return $this->render(
            'site/index.html.twig',
            []
        );
    }

}