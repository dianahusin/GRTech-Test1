
@foreach ($employees as $employee)
<div class="modal fade" id="update-{{$employee->id}}" tabindex="-1" role="dialog" aria-labelledby="updatemodal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updatemodal">Delete Employee Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('employees.destroy', $employee->id) }}" method="post">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <h5 class="text-center">Are you sure you want to delete {{ $employee->name }} ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete Project</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
