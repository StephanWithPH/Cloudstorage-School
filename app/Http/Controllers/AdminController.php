<?php

namespace App\Http\Controllers;

use App\Charts\AmountOfFilesDeleted;
use App\Charts\AmountOfFilesShared;
use App\Charts\AverageUsersRegistered;
use App\Charts\FilesAdded;
use App\Charts\TimeFileExists;
use App\Charts\TimeUntilDeletion;
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
        /* Users registered per month (linechart) */
        $averageUsersRegistered = new AverageUsersRegistered();

        /* Files added per month per file type (linechart) */
        $filesAdded = new FilesAdded();

        /* Time a file already exists */
        $timeFileExists = new TimeFileExists();

        /* Amount of files shared */
        $amountOfFilesShared = new AmountOfFilesShared();

        /* Amount of files deleted */
        $amountOfFilesDeleted = new AmountOfFilesDeleted();

        /* Returning view */
        return view('pages.admin.statistics', [
            'averageUsersRegistered' => $averageUsersRegistered,
            'filesAdded' => $filesAdded,
            'timeFileExists' => $timeFileExists,
            'amountOfFilesShared' => $amountOfFilesShared,
            'amountOfFilesDeleted' => $amountOfFilesDeleted
        ]);
    }

    public function loadAdminUsersPage(){
        return view('pages.admin.users');
    }

    public function loadEditUserPage($id){
        $user = User::find($id);
        return view('pages.admin.edituser', compact('user'));
    }

    public function editUserSubmit(Request $request){
        $user = User::find($request->id);

        if($user){
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->emailverified == "true"){
                $user->email_verified_at = Carbon::now();
            }
            else {
                $user->email_verified_at = null;
            }

            if($request->isadmin == "true"){
                $user->is_admin = true;
            }
            else {
                $user->is_admin = false;
            }
            $user->save();

            flash(__('language.editusersuccess'))->success();
        }
        else {
            flash(__('language.editusererror'))->error();
        }
        return redirect()->back();
    }

    public function deleteUser($id){
        $user = User::find($id);

        if($user){
            $user->delete();

            flash(__('language.deleteusersuccess'))->success();
        }
        else {
            flash(__('language.deleteusererror'))->error();
        }
        return redirect()->back();
    }
}
