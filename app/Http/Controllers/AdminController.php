<?php

namespace App\Http\Controllers;

use App\Charts\AverageUsersRegistered;
use App\Charts\FilesAdded;
use App\File;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function loadAdminStatisticsPage()
    {
        /* Users registered per month */
        $usersDataArray = [];
        for($i = 1; $i < 13; $i++){
            $data = User::whereMonth('created_at', $i)->whereYear('created_at', date('Y'))->count();
            array_push($usersDataArray, $data);
        }
        $averageUsersRegistered = new AverageUsersRegistered();
        $averageUsersRegistered->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December']);
        $averageUsersRegistered->dataset('Users', 'line', $usersDataArray)->fill(false)->color('#0049ff');



        /* Files added per month per file type */
        $filesAdded = new FilesAdded();
        $filesAdded->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'November', 'December']);

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
            $filesAdded->dataset($fileExtensionItem, 'line', $filesDataArray)->fill(false)->color('#' . substr(md5(mt_rand()), 0, 6));
        }


        /* Returning view */
        return view('pages.admin.statistics', [
            'averageUsersRegistered' => $averageUsersRegistered,
            'filesAdded' => $filesAdded
        ]);
    }
}
