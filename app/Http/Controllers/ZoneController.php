<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::all();
        return view('superadmin.zone.zoneview')->with('zones', $zones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zone = Zone::create($request->input());
        return response()->json($zone);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($zone_id)
    {
        $zone = Zone::find($zone_id);
        return response()->json($zone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $zone_id)
    {
        $zone = Zone::find($zone_id);
        $zone->zone_name = $request->zone_name;
        $zone->save();
        return response()->json($zone);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($zone_id)
    {
        $zone = Zone::destroy($zone_id);
        return response()->json($zone);
    }
}
