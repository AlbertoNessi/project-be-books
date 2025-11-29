<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ReviewsController extends AbstractController 
{
	#[Route('/my_reviews', name: 'myReviews_url')]
	public function myReviews() {
		return $this->render('my_reviews.html.twig', ['reviews' => []]);
	}

	#[Route('/review', name: 'postReview_url')]
	public function postReview(Request $request) {

		// get data from form by unserialization
		// write data in db

		// FOR NOW
		$reviewId = '123';


		return new Response($reviewId);
	}
}