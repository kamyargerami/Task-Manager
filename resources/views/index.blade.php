@extends('layout')

@section('title','Task Management System')

@section('style')
    <style>
        #sortable {
            padding-left: 0;
            margin-bottom: 0;
        }

        #sortable li {
            list-style-type: none;
        }
    </style>
@endsection

@section('content')
    <div class="container mt-5">
        <div class="justify-content-center d-flex">
            <div class="col-md-9 card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="/" class="text-muted text-decoration-none">
                                <h3 class="mt-2 mb-2">Task Management System</h3>
                            </a>
                        </div>
                        <div class="col-md-3">
                            <form id="filter-project-form">
                                <select name="project_id" id="filter-project-select" class="form-control mt-1">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project_id => $title)
                                        <option value="{{$project_id}}"
                                                @if (request('project_id') == $project_id) selected @endif>
                                            {{$title}}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('alerts')
                    <ul id="sortable" class="mt-3">
                        <li class="mb-2 fw-bold">
                            <div class="row">
                                <div class="col-9">
                                    Title
                                </div>

                                <div class="col-1">
                                    Priority
                                </div>

                                <div class="col-2">
                                    Action
                                </div>
                            </div>
                        </li>
                        @foreach($tasks as $task)
                            <li class="mb-3 border p-2" data-id="{{$task->id}}">
                                <div class="row">
                                    <div class="col-9">
                                        {{$task->title}}
                                    </div>

                                    <div class="col-1">
                                        {{$task->priority}}
                                    </div>

                                    <div class="col-2">
                                        <a data-bs-toggle="modal" data-bs-target="#editModal"
                                           class="edit-icon text-dark"
                                           data-title="{{$task->title}}" data-project="{{$task->project_id}}"
                                           data-priority="{{$task->priority}}" data-id="{{$task->id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                            </svg>
                                        </a>

                                        <a href="{{route('task.delete', $task->id)}}" class="text-danger ms-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                 fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                <path fill-rule="evenodd"
                                                      d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <form method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6" required>
                                <input type="text" name="title" placeholder="Enter Task Title" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <select name="project_id" class="form-control">
                                    <option value="">Select Project</option>
                                    @foreach($projects as $project_id => $title)
                                        <option value="{{$project_id}}">{{$title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-dark w-100">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>

                    <button class="btn btn-success w-100 mt-3" style="display: none" id="sort-btn">
                        Change Order
                    </button>
                </div>
                <div class="card-footer pb-0">
                    <div class="d-flex justify-content-center pt-2">
                        {{$tasks->appends(request()->all())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <label for="edit-priority-input">Priority</label>
                            <input type="number" name="priority" class="form-control" id="edit-priority-input"
                                   placeholder="Priority" min="0" max="500">
                        </div>

                        <div class="form-group mt-3">
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

@endsection

@section('script')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
            integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>

    <script>
        $("#sortable").sortable({
            change: function () {
                $('#sort-btn').show('slow');
            }
        });
        $("#sortable").disableSelection();

        $('#sort-btn').click(function () {
            let sortedIds = [];
            $('#sortable li').each(function (key, element) {
                sortedIds.push($(element).data('id'));
            });


            $.ajax({
                method: "POST",
                url: '/sort',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'sortedIds': sortedIds
                }
            }).done(function (result) {
                if (typeof result.status !== 'undefined' && result.status == 'success') {
                    $('#sort-btn').hide('slow');
                    window.location.reload();
                } else
                    alert('Update sort failed')
            });
        });

        $('.edit-icon').click(function () {
            $('#edit-id-input').val($(this).data('id'));
            $('#edit-title-input').val($(this).data('title'));
            $('#edit-priority-input').val($(this).data('priority'));
            $('#edit-project-input').val($(this).data('project'));
        });

        $('#filter-project-select').change(function () {
            $('#filter-project-form').submit();
        });
    </script>
@endsection