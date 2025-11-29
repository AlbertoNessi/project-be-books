<?php

namespace App\Controller;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use App\Entity\UserReviews;
use Doctrine\ORM\EntityManagerInterface;

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


		// get data from form by unserialization
		// write data in db

		// FOR NOW

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
	}
}