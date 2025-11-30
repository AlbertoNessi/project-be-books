<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\UserReviews;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;

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

	#[Route(
		'/review/{id}', 
		name: 'handleReview_url', 
		defaults: ['id' => '0'], 
		methods:['POST', 'GET', 'PUT', 'DELETE']
	)]
	public function postReview(Request $request, $id) {
		$parameters = $request->request->all();
		
		try {
			$review = $this->entityManager->getRepository(UserReviews::class)->find($id);
			$reviewData = [];

			if ($request->isMethod('POST')) {
				if($review) {
					throw new Exception("Review already exists with this id: $id", Response::HTTP_INTERNAL_SERVER_ERROR);
				}
	
				$newReview = new UserReviews();
				$newReview->setBookId($parameters['book_id']);
				$newReview->setBookTitle($parameters['book_title']);
				$newReview->setReviewDescription($parameters['review_description']);
				$newReview->setReviewVote($parameters['vote']);
	
				$this->entityManager->persist($newReview);
				$this->entityManager->flush();
	
				return new JsonResponse([
					'new_review_id' => $newReview->getId(),
					'new_review_vote' => $newReview->getReviewVote()
				]);
			} elseif ($request->isMethod('GET')) {	
				if($review) {
					$reviewData = [
						'book_title' => $review->getBookTitle(),
						'review_vote' => $review->getReviewVote(),
						'review_description' => $review->getReviewDescription()
					];
				}
		
				return new JsonResponse($reviewData);
			} elseif ($request->isMethod('PUT')) {
				if(!$review) {
					throw new Exception("Review not found with id: $id", Response::HTTP_NOT_FOUND);
				}
				
				$review->setReviewVote($parameters['vote']);
				$review->setReviewDescription($parameters['review_description']);

				$this->entityManager->persist($review);
				$this->entityManager->flush();
	
				return new JsonResponse([
					'new_review_id' => $review->getId(),
					'new_review_vote' => $review->getReviewVote(),
					'new_review_description' => $review->getReviewDescription()
				]);

				return new JsonResponse($reviewData);
			} elseif ($request->isMethod('DELETE')) {
				$review = $this->entityManager->getRepository(UserReviews::class)->find($id);
				$reviewData = [];
				
				if($review) {
					$this->entityManager->remove($review);
					$this->entityManager->flush();
				}	

				return new JsonResponse();
			}	
		} catch (Exception $ex) {
			return new JsonResponse($ex->getMessage(), $ex->getTraceAsString());
		}
	}
}