@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New transaction</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('transactions.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{route('transactions.store')}}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Amount: (include negative number for debit)</strong>
                    <input value="{{old('amount')}}" type="text" placeholder="Amount" name="amount" class = 'form-control'/>
                </div>
                <div class="form-group">
                    <strong>Description</strong>
                    <textarea placeholder="description" name="description" class = 'form-control'>{{old('description')}}</textarea>

                </div>

                <div class="form-group">
                    <strong>Transaction Date</strong>
                    <input type="date" value="{{old('transaction_date')}}" placeholder="Transaction Date" name="transaction_date" class = 'form-control'/>
                </div>

                <div class="form-group">
                    <strong>Chart:</strong>
                    <select name="chart_id"  class = 'form-control'>
                        <option value="">Enter Chart</option>
                        @if (count($charts) > 0)
                            @foreach ($charts as $chart)
                                <option value="{{$chart->id}}">{{$chart->name}}</option>
                            @endforeach
                        @endif

                    </select>

                </div>

            </div>
            <div class="col-xs-6 col-sm-6 col-md-6">

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

    </div>

@endsection
