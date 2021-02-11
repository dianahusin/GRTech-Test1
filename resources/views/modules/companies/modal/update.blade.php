<!-- Modal -->

@foreach ($companies as $company)
<div class="modal fade" id="update-{{$company->id}}" tabindex="-1" role="dialog" aria-labelledby="updatemodal"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatemodal">Update Company Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('companies.update', $company->id)}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="{{$company->name}}">
                                </div>
                            </div>
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$company->email}}"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class=" col-sm-3 form-label">Logo</label>
                                    <div class="col-sm-4">
                                        @if ($company->logo)
                                            <img src="{{asset('storage/'. $company->logo)}}" alt="logo"
                                                style="width: 100px; height:100px">
                                            @else
                                            <i class="fas fa-portrait" style="font-size: 80px"></i>
                                            @endif
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="file" class="form-control" name="logo"
                                        value="{{$company->logo}}" accept="image/*">
                                    </div>

                                </div>
                            </div>
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Website</label>
                                    <input type="text" class="form-control" name="website"
                                        value="{{$company->website}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success"> <i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
