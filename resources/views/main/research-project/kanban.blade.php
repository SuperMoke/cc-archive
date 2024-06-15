@extends("layouts.app")
@section("title", "Kanban Project")

@section("content")
<div class="nk-block nk-block-lg">
    @include("main.util.alerts")
    <div class="nk-block-head nk-block-head-sm">
        <div class="nk-block-between">
            <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">{{ $project->title }} Kanban Board</h3>
            </div><!-- .nk-block-head-content -->
            <div class="nk-block-head-content">
                <div class="toggle-wrap nk-block-tools-toggle">
                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-menu-alt-r"></em></a>
                    <div class="toggle-expand-content" data-content="pageMenu">
                        <ul class="nk-block-tools g-3">
                            <li><a href="{{ route("tasks.create") }}?project_id={{$project->id}}" class="btn btn-white btn-outline-light"><em class="icon ni ni-plus"></em><span>Add Task</span></a></li>
                        </ul>
                    </div>
                </div><!-- .toggle-wrap -->
            </div><!-- .nk-block-head-content -->
        </div><!-- .nk-block-between -->
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div id="kanban" class="nk-kanban"></div>
    </div>
</div>
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@push('scripts')
<script src="{{ asset("be/assets/js/libs/jkanban.js?ver=3.2.2") }}"></script>
<script>
    function titletemplate(title, count) {
      var optionicon = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : "more-h";
      return "\n                <div class=\"kanban-title-content\">\n                    <h6 class=\"title\">".concat(title, "</h6>\n                    <span class=\"badge rounded-pill bg-outline-light text-dark\">").concat(count, "</span>\n                </div>\n                <div class=\"kanban-title-content\">\n                    <div class=\"drodown\ d-none\">\n                        <a href=\"#\" class=\"dropdown-toggle btn btn-sm btn-icon btn-trigger me-n1\" data-bs-toggle=\"dropdown\"><em class=\"icon ni ni-").concat(optionicon, "\"></em></a>\n                        <div class=\"dropdown-menu dropdown-menu-end\">\n                            <ul class=\"link-list-opt no-bdr\">\n                                <li><a href=\"#\"><em class=\"icon ni ni-edit\"></em><span>Edit Board</span></a></li>\n                                <li><a href=\"#\"><em class=\"icon ni ni-plus-sm\"></em><span>Add Task</span></a></li>\n                                <li><a href=\"#\"><em class=\"icon ni ni-plus-sm\"></em><span>Add Option</span></a></li>\n                            </ul>\n                        </div>\n                    </div>\n                </div>\n            ");
    }
    function itemTitleTemplate(id, title, description, user, date, percentage, url) {
        return `
        <input hidden name="task_id" value="${id}">
        <div class="kanban-item-title">
            <h6 class="title">${title}</h6>
            <a href="${url}" onclick="navigate('${url}')"><em class="icon ni ni-edit"></em></a>
        </div>
        <div class="kanban-item-text">
            <p>${description}</p>
        </div>
        <div class="kanban-item-meta">
            <ul class="kanban-item-meta-list">
                <li class="text-info"><em class="icon ni ni-user"></em><span>${user}</span></li>
                <li class="text-danger"><em class="icon ni ni-calendar"></em><span>${date}</span></li>
            </ul>
            <ul class="kanban-item-meta-list">
                <li><em class="icon ni ni-percent"></em><span>${percentage}</span></li>
            </ul>
        </div>`;
    }

    var stages = @json($stages);
    var tasks = @json($project->tasks);
    var projectId = @json($project->id);
    var boards = [];


    for (var i = 0; i < stages.length; i++) {
        var stage = stages[i];
        var board = {
            id: stage.j_kanban_id,
            title: titletemplate(stage.name, "0"),
            class: stage.class,
            item: []
        };

        for (var j = 0; j < tasks.length; j++) {
            var task = tasks[j];
            if (task.stage_id == stage.id) {
                board.item.push({
                    id: task.id,
                    drop: function(el) {
                        var id = el.getAttribute("data-eid");
                        var jkanban_id = el.parentElement.parentElement.getAttribute("data-id");
                        // route("tasks.changeStage")
                        var formData = new FormData();
                        formData.append('stage_id', jkanban_id);
                        formData.append('task_id', id);

                        fetch('/admin/tasks/change-stage', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            }
                        })
                        .then(response => {
                            // Handle the response
                            console.log(response);
                        })
                        .then(data => {
                            // Handle successful response
                            console.log(data);
                        })
                        .catch(error => {
                            // Handle error
                            console.error('There was a problem with the fetch operation:', error);
                        });
                    },
                    title: itemTitleTemplate(task.id,task.title, task.description, task.user_name, task.deadline, task.percentage, "/admin/tasks/" + task.id + "/edit" + "?project_id=" + projectId),
                });
            }
        }
        // for (var j = 0; j < stage.tasks.length; j++) {
        //     var task = titletemplate(stage.tasks[j], "0");
        //     board.item.push({
        //         id: task.id,
        //         title: task.title,
        //         details: {
        //             description: task.description,
        //             user: task.user,
        //             date: task.date,
        //             percentage: task.percentage
        //         }
        //     });
        // }
        boards.push(board);
    }

    function navigate(url) {
        window.location.href = url
    }

    var kanban = new jKanban({
      element: '#kanban',
      gutter: '0',
      widthBoard: '420px',
      responsivePercentage: false,
      boards: boards,

        // dropEl           : function (el, target, source, sibling) {console.log(target, source, sibling)},
         // callback when any board's item drop in a board
    });
    // for (var i = 0; i < kanban.options.boards.length; i++) {
    //   var board = kanban.findBoard(kanban.options.boards[i].id);
    //   $(board).find("footer").html("<button class=\"kanban-add-task btn btn-block\"><em class=\"icon ni ni-plus-sm\"></em><span>Add another task</span></button>");
    // }


</script>
@endpush
