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
            @include('modules.companies.modal.create')
            <table class="table table-striped" id="companytable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Website</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
            </table>
            @include('modules.companies.modal.update')
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).ready(function(){
        $('#companytable').DataTable({
            processing:true,
            serverSide:true,
            ajax: {
                url: "{{route('companies.getCompanyData')}}",

            },
            columns: [
                {
                    name:'DT_RowIndex',
                    data:'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    name:'name',
                    data:'name'
                },
                {
                    name:'email',
                    data:'email'
                },
                {
                    name:'logo',
                    data:'logo'
                },

                {
                    name:'website',
                    data:'website',
                },
                {
                    name:'action',
                    data:'action',
                    orderable:false

                },

            ]
        });


    $('.btn-submit').on('click',function(e){
                e.preventDefault();
                swalconfirm()
                .then(result => {
            if (result.value) {
                    e.target.form.submit();
         }
        });
    });

    });

</script>
@endsection
