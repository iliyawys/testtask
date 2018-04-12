<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Auth;

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
        // echo date("d.m.Y", strtotime("last Monday"));
        
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $authRepository = $this->getDoctrine()->getRepository(Auth::class);

        $registerPerMonth = $userRepository->allRegisterUserByDate(date('Y-m-01'));
        
        $authForWeek = $authRepository->allActiveLoginByDate(7);
        $usersForWeek = $authRepository->allActiveLoginByUsername(7);

        $birthdaysForSevenDay = $userRepository->birthdayByDate(7);
        $birthdaysForThreeDay = $userRepository->birthdayByDate(3);


        return $this->render(
            'stat/index.html.twig',
            [
                'registerPerMonth' => $registerPerMonth,
                'authForWeek' => $authForWeek,
                'birthdaysForSevenDay' => $birthdaysForSevenDay,
                'birthdaysForThreeDay' => $birthdaysForThreeDay,
                'usersForWeek' => $usersForWeek
            ]
        );
    }

}