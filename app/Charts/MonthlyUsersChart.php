<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        $tutor = DB::select(DB::raw("select year(created_at),MONTHNAME(created_at),count(*) from users WHERE role=2 group by year(created_at),MONTHNAME(created_at) order by year(created_at),MONTHNAME(created_at)"));
        $student = DB::select(DB::raw("select year(created_at),MONTHNAME(created_at),count(*) from users WHERE role=3 group by year(created_at),MONTHNAME(created_at) order by year(created_at),MONTHNAME(created_at)"));

        $collection = collect($tutor);
        $collection1 = collect($student);


        return $this->chart->areaChart()
            ->addData('Tutors', $collection->pluck('count(*)')->toArray())
            ->addData('Students', $collection1->pluck('count(*)')->toArray())
            ->setXAxis($collection->pluck('MONTHNAME(created_at)')->toArray())
            ->setGrid();


    }
}
