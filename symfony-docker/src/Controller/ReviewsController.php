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
		return $this->render('my_reviews.html.twig', [
			'data' => [
				'currentPage' => 'my_reviews',
				'reviews' => []
			],
		]);
	}

	#[Route('/review', name: 'postReview_url', methods:['POST'])]
	public function postReview(Request $request) {

		$parameters = $request->request->all();


		// get data from form by unserialization
		// write data in db

		// FOR NOW


		return new JsonResponse($parameters);
	}
}