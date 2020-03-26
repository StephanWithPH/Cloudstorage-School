<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('fileuploaded')) {
            $file = new File();
            $file->name = $request->file('fileuploaded')->getClientOriginalName();
            // Save uploaded file to storage
            $path = $request->file('fileuploaded')->store(Auth::user()->email);

            $file->path = $path;
            $file->user()->associate(Auth::user())->save();

            flash(__('language.uploadsuccess'))->success();
            return redirect()->back();
        } else {
            //
            flash(__('language.uploaderror'))->error();
            return redirect()->back();
        }

    }

    /**
     * Get the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        //
        $file = Auth::user()->files()->where('id', $id)->get()->first();

        if($file){
            if(!$file->deleted){

                return response()->download(storage_path("app/". $file->path), $file->name);
            }
            else {
                flash(html_entity_decode(__('language.deletedfile')))->error();
                return redirect()->back();
            }
        }
        else {
            flash(html_entity_decode(__('language.filenotfound')))->error();
            return redirect()->back();
        }



    }

    /**
     * Get the specified SHARED resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getShared($id)
    {
        //
        $file = Auth::user()->shared()->where('id', $id)->get()->first();

        if($file){
            if(!$file->deleted && !$file->pivot->deleted){

                return response()->download(storage_path("app/". $file->path), $file->name);
            }
            else {
                flash(html_entity_decode(__('language.deletedshare')))->error();
                return redirect()->back();
            }
        }
        else {
            flash(html_entity_decode(__('language.filenotfound')))->error();
            return redirect()->back();
        }



    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove($id)
    {
        //
        $file = Auth::user()->files()->where('id', $id)->get()->first();
        if($file) {
            $file->deleted = true;
            $file->save();
            flash(__('language.deletesuccess'))->success();
        }
        else {
            flash(__('language.filenotfound'))->error();
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeShared($id)
    {
        //
        $file = Auth::user()->shared()->where('id', $id)->get()->first();
        if($file){
            $file->pivot->deleted = 1;
            $file->pivot->save();
            flash(__('language.deletesharesuccess'))->success();
        }
        else {
            flash(__('language.filenotfound'))->error();
        }

        return redirect()->back();
    }
}
