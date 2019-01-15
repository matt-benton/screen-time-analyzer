<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Daytime;

class DaytimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('daytimes.daytimes', ['daytimes' => Auth::user()->daytimes]);
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
        $daytime = new Daytime;
        $daytime->name = $request->name;
        $daytime->description = $request->description;
        Auth::user()->daytimes()->save($daytime);

        return back();
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
        return view('daytimes.daytime', ['daytime' => Auth::user()->daytimes()->where('id', $id)->first()]);
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
        $daytime = Auth::user()->daytimes()->where('id', $id)->first();
        $daytime->name = $request->name;
        $daytime->description = $request->description;
        $daytime->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $daytime = Auth::user()->daytimes()->where('id', $id)->first();
        $daytime->delete();

        return redirect('/daytimes');
    }
}
