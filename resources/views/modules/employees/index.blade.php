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
                    <form>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Date</label>
                            <div class="col-md-2">
                                <input class="form-control" name="start_date" id="start_date" type="date" >
                            </div>
                            TO
                            <div class="col-md-2">
                                <input class="form-control" name="end_date" id="end_date" type="date" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Email</label>
                            <div class="col-md-4">
                                <input class="form-control" name="email" type="email" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Fist Name</label>
                            <div class="col-md-4">
                                <input class="form-control" name="fisrtname" type="text" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Last Name</label>
                            <div class="col-md-4">
                                <input class="form-control" name="lastname" type="text" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Company</label>
                            <div class="col-md-4">
                                <input class="form-control" name="company" type="text" >
                            </div>
                        </div>
                        <div class="text-right" style="margin-right:34%;">
                            <button class="btn btn-warning" type="reset" > Reset</button>
                            {{-- <button class="btn btn-primary">Search</button> --}}
                            <button type="text" id="search-form" class="btn btn-info">Search</button>
                        </div>
                    </form>
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
                        <th scope="col">Email</th>
                        <th scope="col">Company Name</th>
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
        $('#employeetable').DataTable({
            processing:true,
            serverSide:true,
            ajax: {
                url: "{{route('employees.getEmployeeData')}}",
                data: function (d) {
                d.firstname = $('input[name=firstname]').val();
                d.lastname = $('input[name=lastname]').val();
                d.email = $('input[name=email]').val();
                d.company = $('input[name=company]').val();
            }

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

        $('#search-form').on('submit', function(e) {
        oTable.draw();
        e.preventDefault();

});


    });

</script>

@endsection
