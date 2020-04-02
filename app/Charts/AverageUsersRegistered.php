<?php

namespace App\Charts;

use App\User;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class AverageUsersRegistered extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        /* Users registered per month */
        $usersDataArray = [];
        for($i = 1; $i < 13; $i++){
            $data = User::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->count();
            array_push($usersDataArray, $data);
        }
        $this->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December']);
        $this->dataset('Users', 'line', $usersDataArray)->fill(false)->color('#0049ff');
    }
}
