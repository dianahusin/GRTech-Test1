@extends('layouts.app')

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
            <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target="#create"> <i
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

        $('.btn-submit').on('click', function(e){
        e.preventDefault();
        swal.fire({
        title: 'Are you sure?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
           if(result.isConfirmed == true){
            e.target.form.submit();
           }
        })
    });
    });

</script>
@endsection
