@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Update chart {{$chart->name}}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('charts.index') }}"> Back</a>
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

    <form method="POST" action="{{route('charts.update', ['id' => $chart->id])}}">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input value="{{$chart->name}}" type="text" placeholder="Name" name="name" class = 'form-control'/>
                </div>
                <div class="form-group">
                    <strong>Type:</strong>
                    <select name="type"  class = 'form-control'>
                        <option value="Bar">Bar</option>
                        <option value="Line">Line</option>
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
