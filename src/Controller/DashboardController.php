<?php

namespace App\Controller;

use App\Repository\MessagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{

 
 
   
     #[Route('/UserDashboard', methods:['GET'], name: 'u_dashb')]
    public function getUserDash(){
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('dashboard/user_dashboard.html.twig');
    }


     #[Route('/Dashboard', methods:['GET'], name: 'a_dashb')]
    public function getAdmnDash(){
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        
        
        return $this->render('dashboard/admin_dashboard.html.twig',[
            
        ]);
    }

    #[Route('/TechnDashboard', methods:['GET'], name: 't_dashb')]
    public function getTechnDash(){
        $this->denyAccessUnlessGranted('ROLE_TECHNICIAN');
        return $this->render('dashboard/technician_dash.html.twig');
    }

}
