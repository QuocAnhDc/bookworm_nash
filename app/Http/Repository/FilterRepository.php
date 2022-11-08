<?php

namespace App\Http\Repository;

use App\Models\Author;
use App\Models\Category;
use Throwable;
use Illuminate\Http\Request;
USE Illuminate\Http\Response;

class FilterRepository{
    public function filterStructure()
    {
        try {
            $categories = Category::orderBy('category_name')->get();
            $authors = Author::orderBy('author_name')->get();
            $stars = [1,2,3,4,5];
            return response()->json([
                'categories' => $categories,
                'authors' => $authors,
                'star' => $stars
            ], Response::HTTP_OK);
        } catch (Throwable $th) {
            return response()->json([
                'error' => 'Server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
