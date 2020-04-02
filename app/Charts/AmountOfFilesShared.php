<?php

namespace App\Charts;

use App\File;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class AmountOfFilesShared extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $filesHaveShares = File::has('shares')->count();
        $filesDoesntHaveShares = File::doesnthave('shares')->count();

        $sharesDataArray = [0];
        $sharesDataArray = [$filesHaveShares, $filesDoesntHaveShares];
        $this->labels(['Shared or previously shared', 'Not shared']);
        $this->dataset('Files', 'pie', $sharesDataArray)->fill(false)->backgroundColor(['#0049ff', '#ff0026']);
    }
}
