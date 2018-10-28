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
        $zones = Zone::latest()->paginate(5);
        return view('superadmin.zone.zoneview')->with('zones', $zones)
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zone = Zone::create($request->input());
        return response()->json($zone);
    }

    public function storeZone(Request $request)
    {
        $zone = Zone::create($request->input());
        return redirect()->back()->with('success','New Zone Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($zone_id)
    {
        $zone = Zone::destroy($zone_id);
        return response()->json($zone);
    }


}
