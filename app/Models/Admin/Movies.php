<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Movies extends Model
{
    use HasFactory;

    protected $movies = 'movies';
    // protected $category = 'category';

    public function getMovies($perPage)
    {
        $movies = DB::table($this->movies)
            ->select('movies.*', 'category.name AS name_category')
            ->leftJoin('category', 'movies.id_category', '=', 'category.id');

        if (!empty($perPage)) {
            $movies = $movies->paginate($perPage);
        } else {
            $movies = $movies->get();
        }
        return $movies;
    }

    public function getCategorys()
    {
        $category = DB::table('category')
            ->get();
        // dd($category);
        return $category;
    }

    public function insertMovie($data)
    {
        DB::table($this->movies)->insert($data);
    }

    public function getMovieId($id)
    {
        $getMovieId = DB::table($this->movies)
            ->where('id', $id)
            ->get();
        // dd($getMovieId);
        return $getMovieId;
    }

    public function updateMovie($dataUpdate, $id)
    {
        return DB::table($this->movies)
            ->where('id', $id)
            ->update($dataUpdate);
    }

    public function deleteMovie($id)
    {
        DB::table($this->movies)->delete($id);
    }

    public function getTotalMovies()
    {
        $count = DB::table($this->movies)->count();
        // dd($count);
        return $count;
    }

    public function getTopViews()
    {
        return DB::table($this->movies)
            ->select(['id', 'name', 'poster', 'view'])
            ->orderByDesc('view')
            ->limit(10)
            ->get();
        // dd($count);

    }
}
