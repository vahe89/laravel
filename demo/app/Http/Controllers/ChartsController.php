<?php

namespace App\Http\Controllers;

use App\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Datatables;

class ChartsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('charts.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('charts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:charts',
        ]);
        $user_id = \Auth::user()->id;
        $data = $request->all();

        $data['user_id'] = $user_id;

        Charts::create($data);
        return redirect()->route('charts.index')
            ->with('success','Chart created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $chart = Charts::find($id);
        return view('charts.edit',compact('chart'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required',
        ]);


        Charts::find($id)->update($request->all());
        return redirect()->route('charts.index')
            ->with('success','Chart updated successfully');
    }

    public function chartsList()
    {
        $charts = new Charts();
        $charts = Charts::select(['id','name','type']);

        return Datatables::of($charts)->addColumn('action', function ($faculties) {
            return '<a href="'. route('charts.edit', $faculties->id) .'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                   <a href="'. route('charts.destroy', $faculties->id) .'" data-remote="'. route('charts.destroy', $faculties->id) .'" class="btn btn-xs btn-danger btn-delete"><i class="glyphicon glyphicon-trash"></i> Delete</a>   ';
        })->make(true);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if($id){
            $item = Charts::findOrFail($id);
            $item->delete();
            return 'success';
        }
    }


}
