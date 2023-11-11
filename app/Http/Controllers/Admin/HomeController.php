<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Movies;
use App\Models\Admin\Users;
use App\Models\Admin\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    //
    private $data;
    private $users;
    private $movies;
    private $visits;

    public function __construct()
    {
        $this->movies = new Movies();
        $this->users = new Users();
        $this->visits = new Visit();
    }

    public function index()
    {
        $this->data['title'] = 'Home';
        $this->data['movies'] = $this->movies->getTotalMovies();
        $this->data['users'] = $this->users->getTotalUsers();
        $this->data['visits'] = $this->visits->getTotalVisits();
        $this->data['visitstoyear'] = $this->visits->getTotalVisitsToYear();
        $this->data['topviews'] = $this->movies->getTopViews();


        // dd(session()->all());
        return view('clients.admin.home', $this->data);
    }

    public function chart(Request $request)
    {
        // $total = $this->visits->getTotalVisitsToMonth(2023);
        $total = $this->visits->getTotalVisitsToMonth($request->year);
        // dd($total[0]->month);
        $data = [];
        for ($i = 0; $i < 12; $i++) {
            if (isset($total[$i]->month) && $total[$i]->month == $i + 1) {
                $data[] = $total[$i]->count;
            } else {
                $data[] = 0;
            }
        }
        // $data = [10, 20, 30, 40, 50];
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function currentChart()
    {
        $total = $this->visits->getTotalVisitsToMonth(date('Y'));
        // dd($total[0]->month);
        $data = [];
        for ($i = 0; $i < 12; $i++) {
            if (isset($total[$i]->month) && $total[$i]->month == $i + 1) {
                $data[] = $total[$i]->count;
            } else {
                $data[] = 0;
            }
        }
        // $data = [10, 20, 30, 40, 50];
        return response()->json([
            'status' => 200,
            'data' => $data
        ]);
    }

    // public function getViewTopMovies() {

    // }
}
