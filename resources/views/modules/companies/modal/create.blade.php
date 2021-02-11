<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createmodal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createmodal">Add Company Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('companies.create')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Name<span class="text-danger label-required">*</span></label>
                                    <input type="text" class="form-control" name="name" >
                                </div>
                            </div>
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Email<span class="text-danger label-required">*</span></label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Logo</label>
                                    <input type="file" class="form-control" name="logo" accept="image/*">
                                </div>
                            </div>
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Website<span class="text-danger label-required">*</span></label>
                                    <input type="url" class="form-control" name="website">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success btn-submit" type="submit"> <i class="fa fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
