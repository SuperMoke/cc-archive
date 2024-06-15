@extends("layouts.app")
@section("title", "Edit Task")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Edit Task</h4>
        </div>
    </div>
    @include("main.util.alerts")
    <div class="btn-group mb-2">
        <form action="{{ route('tasks.destroy', $task) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger mx-1" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
        </form>
    </div>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Task Form</span>
                <form action="{{ route("tasks.update", $task) }}" method="post" class="row">
                    @csrf
                    @method("PUT")
                    <input type="hidden" name="project_id" value="{{ $project->id }}"/>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="title">Title</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-mail"></em>
                                </div>
                                <input type="text"
                                       class="form-control"
                                       id="title"
                                       name="title"
                                       placeholder="Enter title"
                                       required="true"
                                       value="{{ $task->title }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="percentage">Percentage</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-percent"></em>
                                </div>
                                <input type="text"
                                       class="form-control"
                                       id="percentage"
                                       name="percentage"
                                       placeholder="Enter percentage"
                                       required="true"
                                       value="{{ $task->percentage }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="deadline">Deadline</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-calendar"></em>
                                </div>
                                <input type="date"
                                       class="form-control"
                                       id="deadline"
                                       name="deadline"
                                       placeholder="Enter deadline"
                                       required="true"
                                       value="{{ $task->deadline }}"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-label" for="user_id">Assignee</label>
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-left">
                                    <em class="icon ni ni-user-list"></em>
                                </div>
                                <select
                                       class="form-control"
                                       id="user_id"
                                       name="user_id"
                                       required="true"
                                       >
                                       @foreach ($students as $student)
                                        @php
                                            $selected = $task->user_id == $student->id ? "selected" : "";
                                        @endphp
                                           <option value="{{ $student->id }}" $selected>
                                            {{ $student->fullname }}
                                            </option>
                                       @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-user-list"></em>
                                    </div>
                                    <textarea
                                           class="form-control"
                                           id="description"
                                           name="description"
                                           required="true"
                                           >{{ $task->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
