<?php

namespace App\Charts;

use App\File;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class FilesAdded extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December']);

        $fileExtensions = File::distinct('extension')->get(['extension'])->toArray();
        $fileExtensionsArray = [];
        foreach($fileExtensions as $fileExtension){
            array_push($fileExtensionsArray, $fileExtension['extension']);
        }

        foreach($fileExtensionsArray as $fileExtensionItem){
            $filesDataArray = [];
            for($i = 1; $i < 13; $i++){
                $data = File::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->where('extension', $fileExtensionItem)->count();
                array_push($filesDataArray, $data);
            }
            $this->dataset($fileExtensionItem, 'line', $filesDataArray)->fill(false)->color('#' . substr(md5(mt_rand()), 0, 6));
        }

        if(!$fileExtensionsArray){
            $this->dataset("No data found", 'line', [0])->fill(false)->color('#' . substr(md5(mt_rand()), 0, 6));
        }
    }
}
