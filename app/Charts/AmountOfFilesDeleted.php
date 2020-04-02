<?php

namespace App\Charts;

use App\File;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class AmountOfFilesDeleted extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $filesNotDeleted = File::where('deleted', false)->count();
        $filesDeleted = File::where('deleted', true)->count();

        $filesDataArray = [0];
        $filesDataArray = [$filesDeleted, $filesNotDeleted];
        $this->labels(['Deleted', 'Not deleted']);
        $this->dataset('Files', 'pie', $filesDataArray)->fill(false)->backgroundColor(['#ff0026', '#0049ff']);
    }
}
