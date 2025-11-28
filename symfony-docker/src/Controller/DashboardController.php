<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DashboardController extends AbstractController 
{
	private const GET_BOOKS_ENDPOINT = 'books/';
	
	#[Route('/dashboard', name: 'dashboard_url')]
	public function dashboard() {
		return $this->render('dashboard.html.twig', [
            'data' => [],
        ]);
	}

	#[Route('my_reviews', name: 'myReviews_url')]
	public function myReviews() {
		return $this->render('my_reviews.html.twig', ['reviews' => []]);
	}
}