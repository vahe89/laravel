<?php

namespace App\Http\Controllers;

use App\Transactions;
use App\Charts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Datatables;

class TransactionsController extends Controller
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

        return view('transactions.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user_id = \Auth::user()->id;

        $charts = Charts::where('user_id', $user_id)
            ->orderBy('name', 'asv')
            ->get();

        return view('transactions.create',['charts'=>$charts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'description' => 'required',
            'amount'=>'required',
            'transaction_date'=>'required',
            'chart_id'=>'required|integer',
        ]);

        $data = $request->all();
        if($data['amount']<0){
            $data['type'] = 'Debit';
        }else{
            $data['type'] = 'Credit';
        }


        Transactions::create($data);
        return redirect()->route('transactions.index')
            ->with('success','Transaction created successfully');
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
        $user_id = \Auth::user()->id;
        $transaction = Transactions::find($id);
        $charts = Charts::where('user_id', $user_id)
            ->orderBy('name', 'asv')
            ->get();


        return view('transactions.edit',compact('transaction','charts'));

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {


        Transactions::find($id)->update($request->all());
        return redirect()->route('transactions.index')
            ->with('success','Transaction updated successfully');
    }

    public function TransactionsList()
    {

        $transaction = Transactions::select(['id', 'description','amount', 'type','transaction_date','chart_id']);

        return Datatables::of($transaction)->addColumn('action', function ($faculties) {
            return '<a href="'. route('transactions.edit', $faculties->id) .'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                   <a href="'. route('transactions.destroy', $faculties->id) .'" data-remote="'. route('transactions.destroy', $faculties->id) .'" class="btn btn-xs btn-danger btn-delete"><i class="glyphicon glyphicon-trash"></i> Delete</a>   ';
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
            $item = Transactions::findOrFail($id);
            $item->delete();
            return 'success';
        }
    }


}
