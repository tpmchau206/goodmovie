<?php

namespace App\Http\Controllers;

use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    private $movies;

    public function __construct()
    {
        $this->movies = new Search();
    }

    public function index(Request $request)
    {
        $title = 'Tìm Kiếm';
        $searchTerm = $request->input('search');
        $search = $this->movies->getSearchMovies($searchTerm);
        $suggest = $this->movies->getSuggest();
        return view('clients.search', compact('title', 'search', 'searchTerm', 'suggest'));
    }
}
