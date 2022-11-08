<?php

namespace App\Http\Api;

use App\Http\Repository\ReviewBookRepository;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;


class ReviewBookApi extends Controller
{
    public function index($book)
    {
        $reviewBook = new ReviewBookRepository();
        return $reviewBook->indexReview($book);
    }

    public function store(Request $request, $book)
    {
        $reviewBook = new ReviewBookRepository();
        return $reviewBook->storeReview($request, $book);
    }

    public function show($book, $review)
    {
        $reviewBook = new ReviewBookRepository();
        return $reviewBook->showReviewOfBook($book, $review);
    }

    public function filter(Request $request, $book)
    {
        $reviewBook = new ReviewBookRepository();
        return $reviewBook->filterReview($request,$book);
    }
}
