<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                <button type="button" class="btn-close"></button>
            </div>
            <form method="post">
                @csrf
                {{method_field('PUT')}}
                <input type="hidden" name="id" id="edit-id-input">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit-title-input">Title</label>
                        <input type="text" name="title" class="form-control" id="edit-title-input"
                               placeholder="Title">
                    </div>

                    <div class="form-group mt-3">
                        <label for="edit-project-input">Project</label>
                        <select name="project_id" class="form-control" id="edit-project-input">
                            <option value="">Select Project</option>
                            @foreach($projects as $project_id => $title)
                                <option value="{{$project_id}}">{{$title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
