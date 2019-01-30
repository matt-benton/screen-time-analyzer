<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\EyeCondition;

class EyeConditionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('eye_conditions.eye_conditions', ['eyeConditions' => Auth::user()->eyeConditions]);
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
        $eyeCondition = new EyeCondition;
        $eyeCondition->name = $request->name;
        $eyeCondition->definition = $request->definition;
        Auth::user()->eyeConditions()->save($eyeCondition);

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
        return view('eye_conditions.eye_condition', ['eyeCondition' => Auth::user()->eyeConditions()->where('id', $id)->first()]);
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
        $eyeCondition = Auth::user()->eyeConditions()->where('id', $id)->first();
        $eyeCondition->name = $request->name;
        $eyeCondition->definition = $request->definition;
        $eyeCondition->save();

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
        $eyeCondition = Auth::user()->eyeConditions()->where('id', $id)->first();
        $eyeCondition->delete();

        return redirect('/eye_conditions');
    }
}
