<?php

namespace App\Http\Controllers;

use App\Models\Watch;
use Illuminate\Http\Request;

class WatchController extends Controller
{
    //
    private $movie;
    public function __construct()
    {
        $this->movie = new Watch();
    }

    public function index(Request $request, $id)
    {
        $movie = $this->movie->getMovie($id);
        $title = $movie[0]->name;
        // dd($title);

        return view('clients.watch', compact('title', 'movie'));
    }

    public function updateVideoTime(Request $request)
    {
        // Xử lý dữ liệu và cập nhật thời gian video ở đây
        $currentTime = $request->input('currentTime');
        $newTime = $currentTime + 10;
        // ...
        return response()->json(
            [
                'status' => 'success',
                'newTime' => $newTime
            ]
        );
    }
}
