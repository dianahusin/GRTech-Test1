<!-- Modal -->

@foreach ($employees as $employee)
<div class="modal fade" id="update-{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="updatemodal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatemodal">Update Employee Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('employees.update', $employee->id)}}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="firstname" value="{{$employee->firstname}}">
                                </div>
                            </div>
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Company</label>x
                                    <select name="company" class="custom-select @error('company') is-invalid @enderror">
                                        <option value="SP" selected disabled>Please Select</option>
                                        @foreach  ($companies as $company)
                                            <option value="{{$company->id}}"
                                            @if ($company->id == old('company', $employee->id))
                                                selected
                                            @endif
                                            >{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{$employee->phone}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="lastname" value="{{$employee->lastname}}">
                                </div>
                            </div>
                            <div role="group" class="form-group">
                                <div class="form-row">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$employee->email}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success btn-submit" type="submit"> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

