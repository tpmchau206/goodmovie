<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Visit;
use Illuminate\Http\Request;

class VisitsController extends Controller
{
    //
    private $data;
    private $visits;

    public function __construct()
    {
        $this->visits  = new Visit();
    }
    public function index()
    {
        $this->data['title'] = 'Visits';
        $this->data['visits'] = $this->visits->getVisits();


        return view('clients.admin.visits.list', $this->data);
    }
}
