<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController 
{	
	#[Route('/dashboard', name: 'dashboard_url')]
	public function dashboard() {
		return $this->render('dashboard.html.twig', [
            'data' => [
				'currentPage' => 'home'
			],
        ]);
	}
}