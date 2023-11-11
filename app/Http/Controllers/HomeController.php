<?php

namespace App\Http\Controllers;

use App\Models\Admin\Visit;
use App\Models\Home;
use App\Models\Popup;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $data;
    private $movies;
    private $popup;
    private $user;

    public function __construct()
    {
        $this->movies = new Home();
        $this->popup = new Popup();
        $this->user = new User();
    }
    public function index(Request $request)
    {
        $this->data['title'] = 'Trang Chủ';
        $this->data['moviesTrailer'] = $this->movies->getTrailerMovies();
        $this->data['dataRankMovie'] = $this->movies->getTopRank();
        $this->data['popularMovie'] = $this->movies->getMoviesPopular();
        if (!empty(session('id'))) {
            $this->data['notifys'] = $this->user->notify(session('id'));
        }
        // dd(session('id'));

        $visit = new Visit();
        $visit->ip_address = $request->ip();
        $visit->user_agent = $request->userAgent();
        $visit->save();
        // $topMovie = $this->movies->getTopMovies();
        // dd($this->data['username'][0]->username);

        return view('clients.home', $this->data);
    }

    public function popup($id)
    {
        $id = $this->popup->findRecord($id);

        return response()->json([
            'status' => 200,
            'movie' => $id
        ]);
    }

    public function notify()
    {
    }
}
