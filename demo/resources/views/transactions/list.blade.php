@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <a href="{{route('transactions.create')}}" class="btn btn-primary">Create</a>
            <h2>Transactions List</h2>
            <table class="table table-bordered" id="table12">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Description</th>
                    <th>Amount</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Chart ID</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>


    </div>
</div>
<script>
    $(document).ready(function(){
        $('#table12').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('transactions.list') }}',
            columns: [
                {data: 'id'},
                {data: 'description'},
                {data: 'amount'},
                {data: 'type'},
                {data: 'transaction_date'},
                {data: 'chart_id'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ]

        });


        $('#table12').on('click', '.btn-delete', function (e) {

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
                    $('#table12').DataTable().draw(false);
                });
            }else
                alert("You have cancelled!");
        });
    });

</script>
@endsection
