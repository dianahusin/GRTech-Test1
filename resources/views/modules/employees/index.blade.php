@extends('layouts.app2')

@section('content')

@if(session()->has('success'))
<div class="alert alert-success ml-3 mr-3">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="content p-3">
    <div class="card card-body">
        <div class="card-body">
            <div class="card">
                <div class="card-header"><b><i>Search</i></b></div>
                <section class="mb-2 card-body">
                        {{-- <div class="form-group row">
                            <label class="col-form-label col-md-2">Date</label>
                            <div class="col-md-2">
                                <input class="form-control filter" name="start_date" id="start_date" type="date" data-column="0">
                            </div>
                            TO
                            <div class="col-md-2">
                                <input class="form-control filter" name="end_date" id="end_date" type="date" data-column="1">
                            </div>
                        </div> --}}
                        {{-- <div class="form-group row">
                            <label class="col-form-label col-md-2">First Name</label>
                            <div class="col-md-4">
                                <input class="form-control filter" name="firstname" type="text" data-column="0">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Last Name</label>
                            <div class="col-md-4">
                                <input class="form-control filter" name="lastname" type="text" data-column="1">
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Full Name</label>
                            <div class="col-md-4">
                                <input class="form-control filter" name="fullname" type="text" data-column="2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-4">
                                <input class="form-control filter" name="email" type="email" data-column="2">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Company</label>
                            <div class="col-md-4">
                                <input class="form-control filter" name="company" type="text" data-column="2">
                            </div>
                        </div>
                </section>
            </div>
            <button type="button" class="btn btn-sm btn-primary mb-3 mt-3" data-toggle="modal" data-target="#create"> <i
                    class="fa fa-plus"></i>
                Add</button>
            @include('modules.employees.modal.create')
            <table class="table table-striped" id="employeetable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Company</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
            @include('modules.employees.modal.update')
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
           var table =  $('#employeetable').DataTable({
            processing:true,
            serverSide:true,
            ajax: {
                url: "{{route('employees.getEmployeeData')}}",

            },
            columns: [
                {
                    name:'DT_RowIndex',
                    data:'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    name:'fullname',
                    data:'fullname'
                },
                {
                    name:'firstname',
                    data:'firstname'
                },
                {
                    name:'email',
                    data:'email'
                },
                {
                    name:'company',
                    data:'company'
                },
                {
                    name:'action',
                    data:'action',
                    orderable:false
                },

            ]
        });


        $('.filter').on('keyup', function() {
            table.column( $(this).data('column') )
            .search($(this).val())
            .draw();
        });

        // $('.filter-firstname').on('keyup', function() {
        //     table.column($(this).data('firstname'))
        //     .search($(this).val())
        //     .draw();
        // });

        // $('.filter-company').on('keyup', function() {
        //     table.column($(this).data('company'))
        //     .search($(this).val())
        //     .draw();
        // });

});
</script>

@endsection
