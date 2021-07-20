<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_data = {{  model  }}::where('trash', false)->where('status', true)->latest()->get();
        return view('view.index', [
            'all_data' => $all_data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('view.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        {{  model  }}::create([
            'name'      => $request->name
        ]);

        return redirect()->back()->with('success', 'Data added successfully ): ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = {{  model  }}::find($id);
        return view('view.show', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = {{  model  }}::find($id);
        return view('view.edit', [
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = {{  model  }}::find($id);

        if($data){
            $this->validate($request, [
                'name' => 'required',
            ]);

            $data->name = $request->name;
            $data->update();

            return redirect()->back()->with('success', 'Data added successfully ): ');
        }else {
            return redirect()->back()->with('error', 'Sorry, Not found data! ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Test::find($request->id);
        if($data){

            $data->delete();

             return redirect()->back()->with('success', 'Data deleted successfully ): ');
        }else {
            return redirect()->back()->with('error', 'Sorry, Not found data! ');
        }
    }


    /**
    *
    *   Status update method
    */
    public function statusUpdate(Request $request){
        $data = Test::find($request->id);
        if($data){
            $data->status = status;
            $data->update;

            return redirect()->back()->with('success', 'Status updated successfully ): ');
        }else {
            return redirect()->back()->with('error', 'Sorry, Not found data! ');
        }
    }


    /**
    *
    *   Trash list page method
    */
    public function trashList(){
        $all_data = Test::where('trash', true)->latest()->get();

        return view('view.trash-list', [
            'all_data' => $all_data
        ]);
    }


    /**
    *
    *   Trash update method
    */
    public function statusUpdate(Request $request){
        $data = Test::find($request->id);
        if($data){
            $data->status = trash;
            $data->update;

            return redirect()->back()->with('success', 'Trash updated successfully ): ');
        }else {
            return redirect()->back()->with('error', 'Sorry, Not found data! ');
        }
    }

}
