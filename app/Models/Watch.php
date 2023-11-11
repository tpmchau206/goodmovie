<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Watch extends Model
{
    use HasFactory;

    protected $table = 'movies';

    public function getMovie($id)
    {
        $movie = DB::table($this->table)
            ->where('id', '=', $id)
            ->get();
        // dd($moviesTrailer->trailer);
        // foreach($moviesTrailer as $movie){

        // }
        // dd($moviesTrailer->pluck('trailer'));
        return $movie;
    }
}
