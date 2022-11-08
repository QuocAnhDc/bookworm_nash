<?php

namespace App\Http\Api;

use App\Http\Repository\BookRepository;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;


class BookApi extends Controller
{
    public function index()
    {
        $book = new BookRepository();
        return $book->getAllBook();
    }

    public function show($id)
    {
        $book = new BookRepository();
        return $book->showBook($id);
    }

    public function filter(Request $request)
    {
        $book = new BookRepository();
        return $book->filterBookWithParam($request);
    }
}
