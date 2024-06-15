@extends("layouts.app")
@section("title", "Edit Project")

@section("content")
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Edit Project</h4>
        </div>
    </div>
    @include("main.util.alerts")
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <span class="preview-title-lg overline-title">Research Project Form</span>
                <form action="{{ route("projects.update", $project) }}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="row g-4">
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
                                           value="{{ $project->title }}"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="project_members">Project Members</label>
                                <div class="form-control-wrap">
                                    <div class="form-icon form-icon-left">
                                        <em class="icon ni ni-user-list"></em>
                                    </div>
                                    <select
                                           multiple="true"
                                           class="form-control"
                                           id="project_members"
                                           name="project_members"
                                           required="true"
                                           >
                                           @foreach ($students as $student)
                                                @php
                                                    $selected = in_array($student->id, $project->project_member_ids) ? "selected" : "";
                                                @endphp
                                               <option value="{{ $student->id }}" {{ $selected }}>
                                                {{ $student->fullname }}
                                                </option>
                                           @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
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
                                           >{{ $project->description }}</textarea>
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
