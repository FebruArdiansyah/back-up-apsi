<?php

namespace App\Charts;

use app\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class adminchart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $users = User::all(); 

        $userCounts = $users->groupBy('role_id')->map->count();

        $data = $userCounts->values()->toArray();
        $labels = $userCounts->keys()->map(function($roleId) {
            return "admin $roleId"; 
        })->toArray();

        // Buat chart berdasarkan data pengguna
        return $this->chart->pieChart()
            ->setTitle('Admin yang aktif saat ini ')
            ->setSubtitle('2024')
            ->setSubtitle('Hans Restaurant')
            ->addData($data)
            ->setLabels($labels);
       
    }
}
