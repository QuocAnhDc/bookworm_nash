<?php

namespace App\Http\Api;

use App\Http\Repository\FilterRepository;
use App\Http\Controllers\Controller;


class FilterApi extends Controller
{
    public function index()
    {
        $filter = new FilterRepository();
        return $filter->filterStructure();
    }
}
