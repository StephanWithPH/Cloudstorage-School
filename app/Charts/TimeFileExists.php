<?php

namespace App\Charts;

use App\File;
use Carbon\Carbon;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class TimeFileExists extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $greatherThanOneYear = File::whereDate('created_at', '<=', Carbon::now()->subDays(366)->toDateString())->where('deleted', false)->count();
        $greatherThanOneMonth = File::whereDate('created_at', '<=', Carbon::now()->subDays(32)->toDateString())->whereDate('created_at', '>=', Carbon::now()->subDays(365)->toDateString())->where('deleted', false)->count();
        $greatherThanOneWeek = File::whereDate('created_at', '<=', Carbon::now()->subDays(8)->toDateString())->whereDate('created_at', '>=', Carbon::now()->subDays(31)->toDateString())->where('deleted', false)->count();
        $greatherThanOneDay = File::whereDate('created_at', '<=', Carbon::now()->addHours(25)->toDateString())->whereDate('created_at', '>=', Carbon::now()->subDays(7)->toDateString())->where('deleted', false)->count();


        $timeDataArray = [$greatherThanOneYear, $greatherThanOneMonth, $greatherThanOneWeek, $greatherThanOneDay];
        $this->labels(['> 1 year', '> 1 month', '> 1 week', '> 1 day']);
        $this->dataset('Files', 'bar', $timeDataArray)->fill(false)->color('#0049ff');
    }
}
