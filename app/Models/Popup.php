<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Popup extends Model
{
    use HasFactory;

    protected $table = 'movies';

    public function findRecord($id)
    {
        // $id = DB::select("SELECT `movies`.*, `category`.`name`
        //                 FROM `movies` 
        //                 LEFT JOIN `category` 
        //                 ON `movies`.`id_category` = `category`.`id`;
        //                 WHERE id=?", [$id]);


        $id = DB::table($this->table)
            ->join('category', 'movies.id_category', '=', 'category.id')
            ->select('category.id', 'category.name as category_movie', 'movies.*')
            ->where('movies.id', '=', $id)
            ->get();

        // if (!empty($topMovies)) {
        //     $user = $topMovies[0];
        //     $id = $user->id;
        //     $name = $user->name;
        // } else {
        //     echo "Không tìm thấy!";
        // }
        return $id;
    }
}
