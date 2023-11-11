<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Search extends Model
{
    use HasFactory;

    protected $table = 'movies';

    public function getSearchMovies($searchTerm)
    {
        $moviesSearch = DB::table($this->table)
            ->where('name', 'LIKE', "%$searchTerm%")
            ->orWhere('content', 'LIKE', "%$searchTerm%")
            ->get();
        // dd($moviesSearch);
        return $moviesSearch;
    }
    public function getSuggest()
    {
        $suggest = DB::table($this->table)
            ->get();
        // dd($moviesSearch);
        return $suggest;
    }
}
