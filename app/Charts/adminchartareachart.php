<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Order;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AdminChartAreaChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        // Get order data for 2024
        $orders = Order::selectRaw('MONTH(created_at) as month, count(*) as count')
            ->whereYear('created_at', 2024)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Prepare data for the chart
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $orderCounts = array_fill(0, 12, 0);

        foreach ($orders as $order) {
            $orderCounts[$order->month - 1] = $order->count;
        }

        return $this->chart->areaChart()
            ->setTitle('Data Orders Per Month in 2024')
            ->setSubtitle('Number of orders placed each month')
            ->addData('Orders', $orderCounts)
            ->setXAxis($months);
    }
}

// namespace App\Charts;

// use Carbon\Carbon;
// use App\Models\User;
// use ArielMejiaDev\LarapexCharts\LarapexChart;

// class adminchartareachart
// {
//     protected $chart;

//     public function __construct(LarapexChart $chart)
//     {
//         $this->chart = $chart;
//     }

//     public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
//     {
//         // Get user data user from model user by DJONY
//         $userRegistrations = User::selectRaw('MONTH(created_at) as month, count(*) as count')
//             ->whereYear('created_at', Carbon::now()->year)
//             ->groupBy('month')
//             ->orderBy('month')
//             ->get();

//         // chart data preparation
//         $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
//         $registrations = array_fill(0, 12, 0);

//         foreach ($userRegistrations as $registration) {
//             $registrations[$registration->month - 1] = $registration->count;
//         }

//         return $this->chart->areaChart()
//             ->setTitle('Data admin berdasarkan pendaftaran selama tahun 2024')
//             ->setSubtitle('Karyawan yang mendaftar pada tahun ini')
//             ->addData('Registrations', $registrations)
//             ->setXAxis($months);
//     }
// }

// namespace App\Charts;

// use Carbon\Carbon;
// use app\Models\User;
// use Illuminate\Support\Facades\DB;
// use ArielMejiaDev\LarapexCharts\LarapexChart;

// class adminchartareachart
// {
//     protected $chart;

//     public function __construct(LarapexChart $chart)
//     {
//         $this->chart = $chart;
//     }

//     public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
//     {
//         // Get user registration data for 2024
//         $userRegistrations = DB::table('users')
//             ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
//             ->whereYear('created_at', Carbon::now()->year)
//             ->groupBy('month')
//             ->orderBy('month')
//             ->get();

//         // Prepare data for the chart
//         $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
//         $registrations = array_fill(0, 12, 0);

//         foreach ($userRegistrations as $registration) {
//             $registrations[$registration->month - 1] = $registration->count;
//         }

//         return $this->chart->areaChart()
//             ->setTitle('Data admin berdasarkan pendaftaran selama tahun 2024')
//             ->setSubtitle('Data user yang aktif')
//             ->addData('Registrations', $registrations)
//             ->setXAxis($months);
//     }


