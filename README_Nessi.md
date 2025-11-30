# My book review service
This is a small web app that allow the user to browse all the books presents on gutendex.com and review the books.

## Framework + stack
Symfony + mysql + Bootstrap + jQuery.

## How to run:
Clone this repo, then `cd symfony-docker` and follow these steps:
1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --pull --no-cache` to build fresh images
3. Run `docker compose up --wait` to set up and start a fresh Symfony project
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. `php bin/console doctrine:migrations:migrate`
6. `php bin/console cache:clear`: Clear cache / install assets if needed
7. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Docker-related command and configs:
See the `README_symfony_docker.md` file.

## Logic
The UI presents itself at first with a search bar in which the user can search for books.
The search calls the endpoint on gutendex.com '/book/search' that returns a list of books.

The user can select a book and add a review with:
- "review": "text"
- "score": 6 (1/10)

The user can submit the review.

The review is saved in the db in the 'user_reviews' table, with:
- book_id
- book_title
- review_vote
- review_description

In the My reviews section the user can see all the added reviews.
Each review can be updated or deleted.




