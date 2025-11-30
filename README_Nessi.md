# My book review service

## Framework + stack
Symfony + mysql

## How to run:


## Logic
The UI presents itself at first with a search bar in which the user can search for books.
The search calls the endpoiint on gutendex.com '/book/search' that returns a list of books.

The user can select a book and add a review with:
- "review": "text"
- "score": 6 (1/10)
- maybe author, Publishing house, publiching year etc

The user can submit the review.

The review is saved in the db in the 'user_reviews' table, with:
- book_id
- book_title
- review_vote
- review_description

The user can see other informations about the book and its review by clicking to the action next to its name after a search.
- 202 response code while it's still processing
- 200 response code and your enriched data when everything is ready


The user then can update or delete the review.




