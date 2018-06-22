@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <a href="{{route('charts.create')}}" class="btn btn-primary">Create</a>
            <h2>Charts List</h2>

            <table class="table table-bordered" id="table">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>


    </div>
</div>
<script>
    $(document).ready(function(){
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('charts.list') }}',
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'type'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]

        });


        $('#table').on('click', '.btn-delete', function (e) {

            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = $(this).data('remote');
            // confirm then
            if (confirm('Are you sure you want to delete this?')) {
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    dataType: 'json',
                    data: {method: '_DELETE', submit: true}
                }).always(function (data) {
                    $('#table').DataTable().draw(false);
                });
            }else
                alert("You have cancelled!");
        });
    });

</script>
@endsection
