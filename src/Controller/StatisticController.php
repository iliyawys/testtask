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
        
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $authRepository = $this->getDoctrine()->getRepository(Auth::class);
        
        //numbers in the arguments is value of days to select
        $authForWeek = $authRepository->allActiveLoginByDate(7);
        $usersForWeek = $authRepository->allActiveLoginByUsername(7);
        $usersForWeek = $this->formatUsersList($usersForWeek);

        $registerPerMonth = $userRepository->allRegisterUserByDate(date('Y-m-01'));

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
    
    /**
     * Formating users array for twig loops
     *
     * @param $users
     * @return $users
     */
    private function formatUsersList($users)
    {
        $out = [];
        // create all days array
        $days =  array_unique(array_map(function ($i) { return $i['dateAsMonth']; }, $users));
        // create all uids array
        $uids =  array_unique(array_map(function ($i) { return $i['user_id']; }, $users));

        //blank associative array
        foreach ($days as $d) 
            foreach ($uids as $u) 
                $out[$u][$d] = null;

        foreach ($users as $user) 
            $out[$user['user_id']][$user['dateAsMonth']] = $user;

        //rename uid an usernames
        foreach ($out as $users) {
            foreach ($users as $u) {
                if ($u !== null) {
                    $username = $u['firstName'] . ' ' . $u['secondName'];
                    $out[$username] = $out[$u['user_id']];
                    unset($out[$u['user_id']]);
                    break;
                }
            }
        }

        return $out;
    }

}