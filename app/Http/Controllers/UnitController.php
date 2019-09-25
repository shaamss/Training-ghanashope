<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::paginate(env('PAGINATION_COUNT'));

        return view('admin.units.units')->with(
            ['units' => $units]
        );
    }

    public function store(Request $request)
    {
        //TODO check if the unit already exists
        $request->validate([
            'unit_name' =>'required',
            'unit_code' => 'required'
        ]);

        $unit = new Unit();
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();

        //$request->session()->flash('key', $value);
        Session::flash('message', 'Unit ' . $unit->unit_name . ' has been added');

        return redirect()->back();
    }

    public function update(Request $request)
    {
        //TODO update the given unit
    }

    public function delete(Request $request)
    {

        if( is_null($request->input('unit_id')) || empty($request->input('unit_id'))){
            Session::flash('message','Unit ID is required');
            return redirect()->back();
        }

        $id = $request->input('unit_id');
        Unit::destroy($id);

        Session::flash('message', 'Unit has been deleted');

        return redirect()->back();
    }




}
