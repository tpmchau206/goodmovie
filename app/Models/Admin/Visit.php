<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visit extends Model
{
    use HasFactory;
    public function getVisits()
    {
        return DB::table('visits')->get();
    }

    public function getTotalVisits()
    {
        return DB::table('visits')->count();
    }

    public function getTotalVisitsToYear()
    {
        $results = DB::table('visits')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->groupBy('year')
            ->orderByDesc('year')
            ->get();
        return $results;
    }
    public function getTotalVisitsToMonth($year)
    {
        $results = DB::table('visits')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)
            ->groupBy('year', 'month')
            // ->orderByDesc('month')
            ->get();
        return $results;
    }
    public function getTotalVisitsMonInYear($year, $month)
    {
        $results = DB::table('visits')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('year', 'month')
            ->orderByDesc('month')
            ->get();
        return $results;
    }
    public function getTotalVisitsChart()
    {
        $results = DB::table('visits')
            ->select(DB::raw('COUNT(*) as count'))
            ->get();
        return $results;
    }
}
