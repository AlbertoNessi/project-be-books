<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\UserReviews;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class ReviewsController extends AbstractController 
{
	private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

	#[Route('/my_reviews', name: 'myReviews_url')]
	public function myReviews() {
		// get all the posted reviews...
		$allReviews = $this->entityManager->getRepository(UserReviews::class)->findAll();

		return $this->render('my_reviews.html.twig', [
			'data' => [
				'currentPage' => 'my_reviews',
				'reviews' => $allReviews
			],
		]);
	}

	#[Route('/review', name: 'postReview_url', methods:['POST'])]
	public function postReview(Request $request) {
		$parameters = $request->request->all();

		if(!$parameters) {
			return new JsonResponse("Parameters empty");
		}

		try {
			$newReview = new UserReviews();
			$newReview->setBookId($parameters['book_id']);
			$newReview->setBookTitle($parameters['book_title']);
			$newReview->setReviewDescription($parameters['review_description']);
			$newReview->setReviewVote($parameters['review_vote']);

			$this->entityManager->persist($newReview);
			$this->entityManager->flush();


			return new JsonResponse([
				'new_review_id' => $newReview->getId(),
				'new_review_vote' => $newReview->getReviewVote()
			]);
		} catch (Exception $ex) {
			return new JsonResponse($ex->getMessage(), $ex->getTraceAsString());
		}
	}

	#[Route('/review/{reviewId}', name: 'getReviewById_url', methods:['GET'])]
	public function getReviewById(Request $request, $reviewId) {
		$parameters = $request->request->all();

		if(!$reviewId) {
			return new JsonResponse("No review id given");
		}

		try {
			$review = $this->entityManager->getRepository(UserReviews::class)->find($reviewId);
			$reviewData = [];
			if($review) {
				$reviewData = [
					'book_title' => $review->getBookTitle(),
					'review_vote' => $review->getReviewVote(),
					'review_description' => $review->getReviewDescription()
				];
			}
	
			return new JsonResponse($reviewData);
		} catch (Exception $ex) {
			return new JsonResponse($ex->getMessage(), $ex->getTraceAsString());
		}
	}
}