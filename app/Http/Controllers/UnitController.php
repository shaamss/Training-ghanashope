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
            [
                'units' => $units,
                'showLinks' => true

            ]
        );
    }

    public function search(Request $request)
    {

        $request->validate([
            'unit_search' => 'required',
        ]);

        $searchTerm = $request->input('unit_search');

        $units = Unit::where(
            'unit_name', 'LIKE', '%' . $searchTerm . '%'
        )->orWhere(
            'unit_code', 'LIKE', '%' . $searchTerm . '%'
        )->get();


        if (count($units) > 0)
        {
            return view('admin.units.units')->with([
                'units' => $units,
                'showLinks' => false ,
            ]);
        }


        Session::flash('message', 'Nothing Found !!!');
        return redirect()->back();

    }

     //validation if unit name exist
    private function unitNameExist($unitName)
    {
        $unit = Unit::where(
            'unit_name', '=' , $unitName
        )->first();
        if (!is_null($unit))
        {
            Session::flash('message', 'Unit Name [ ' . $unitName .  ' ] Already Exist');

            return false;
        }

        return true;
    }

    //validation if unit code exist
    private function unitCodeExist($unitCode)
    {
        $unit = Unit::where(
            'unit_code', '=' , $unitCode
        )->first();
        if (!is_null($unit))
        {
            Session::flash('message', 'Unit Code [ '. $unitCode .' ] Already Exist');
            return false;
        }

        return true;
    }



    public function store(Request $request)
    {
        //TODO check if the unit already exists
        $request->validate([
            'unit_name' =>'required',
            'unit_code' => 'required'
        ]);

        $unitName = $request->input('unit_name');
        $unitCode = $request->input('unit_code');

        if(! $this->unitNameExist($unitName)){

            return redirect()->back();
        }
        if(! $this->unitCodeExist($unitCode)){

            return redirect()->back();
        }

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
        $request->validate([
            'unit_id' => 'required',
            'unit_name' => 'required',
            'unit_code' => 'required'
        ]);

        $unitName = $request->input('unit_name');
        $unitCode = $request->input('unit_code');

        if(! $this->unitNameExist($unitName)){

            return redirect()->back();
        }
        if(! $this->unitCodeExist($unitCode)){

            return redirect()->back();
        }

        $unitUpdateID = intval ($request->input('unit_id'));
        $unit = Unit::find($unitUpdateID);

        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();

        Session::flash('message','Unit ' . $unit->unit_name . ' has been updated !');

        return redirect()->back();
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
