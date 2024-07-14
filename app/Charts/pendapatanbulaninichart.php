<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class pendapatanbulaninichart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
  
        $orders = Order::selectRaw('DAY(created_at) as day, sum(total_price) as total')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('day')
            ->orderBy('day')
            ->get();

       
        $daysInMonth = Carbon::now()->daysInMonth;
        $dailyEarnings = array_fill(0, $daysInMonth, 0);

        foreach ($orders as $order) {
            $dailyEarnings[$order->day - 1] = $order->total;
        }

        $days = range(1, $daysInMonth);

        return $this->chart->lineChart()
            ->setTitle('Pendapatan Bulan Ini')
            ->setSubtitle('Pendapatan berdasarkan hari dalam bulan ini')
            ->addData('Pendapatan', $dailyEarnings)
            ->setXAxis($days);
    }
}

