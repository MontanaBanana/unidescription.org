@if ($project->id)

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Project Todos:</div>
                <div class="panel-body white unid-list todos">

<div data-role="content" data-theme="c">
    <ul data-role="listview" data-inset="true" data-theme="d" id="todo-sortable" class="sortable ui-sortable">
    <?php 
        $todos = $project->project_todos;
        foreach ($todos as $todo):
            if ($todo->deleted) {
                continue;
            }
    ?>

        <li id="todo-{{ $todo->id }}" data-todo_id="{{ $todo->id }}" data-title="{{ $todo->title }}" class="li-section">
            <div>
                <span class="fa fa-bars" style="cursor: move;"></span>
                <i class="fa fa-chevron-right toggle"></i> <input type="text" data-todo_id="{{ $todo->id }}" class="todo-title" name="todo-title-{{ $todo->id }}" value="{{ $todo->title }}" />
                <span data-todo_id="{{ $todo->id }}" class="toc-icon todo-delete label pull-right label-danger" data-toggle="tooltip" data-placement="left" title="Delete"><span class="fa @if ($todo->deleted) fa-undo @else fa-times @endif"></span></span>
                <span data-todo_id="{{ $todo->id }}" class="todo-check-complete label pull-right @if ($todo->completed) label-success @else label-default @endif" data-toggle="tooltip" data-placement="left" title="Mark as complete"><span class="fa @if ($todo->completed) fa-check-square-o @else fa-square-o @endif"></span></span>
                <div class="todo-description">
                    <textarea data-todo_id="{{ $todo->id }}" class="todo-textarea">{{ $todo->description }}</textarea>
                </div>
            </div>
        </li>
    <?php
        endforeach;
    ?>

        <li class="new-component">
            <div class="input-group">
                <input type="text" class="form-control" id="todo-new" name="todo-new" onKeyPress="addOnEnter(event, this);" placeholder="Add a new todo..." aria-describedby="todo-add" />
                <span class="btn input-group-addon add-todo" id="todo-add">ADD</span>
            </div>
        </li>
    </ul>
</div>


    <script type="text/javascript">
    function addOnEnter(e, textarea){

        var code = (e.keyCode ? e.keyCode : e.which);
        if(code == 13) {
            $('#todo-add').click();
            e.preventDefault();
        }
    }

    $(document).ready(function() {

        $('#todo-add').on('click', function() {

            var new_todo = $('#todo-new').val();

            var formData = {
                _token: $('input[name=_token]').val(),
                project_id: {{ $project->id }},
                user_id: {{ Auth::user()->id }},
                <?php if (isset($section)) { echo "project_section_id: ".$section->id.","; } ?> 
                title: new_todo
            };
            console.log(formData);

            $.ajax({
                url : "/account/project/todo/add",
                type: "POST",
                data : formData,
                success: function(data, textStatus, jqXHR)
                {
                    if (data.status) {
                        location.reload();
                    }
                    else {
                        alert('Error: contact the site admin.');
                    }
                }
            });
            
        });

        $('.todo-title').blur(function() {

            var todo_id = $(this).data('todo_id');

            var formData = {
                _token: $('input[name=_token]').val(),
                title: $(this).val(),
                id: todo_id
            };
            console.log(formData);

            $.ajax({
                url : "/account/project/todo/update",
                type: "POST",
                data : formData,
                success: function(data, textStatus, jqXHR)
                {
                    if (data.status) {
                        // nothing
                    }
                    else {
                        alert('Error: contact the site admin.');
                    }
                }
            });
            
        });


        $('.todo-textarea').blur(function() {

            var todo_id = $(this).data('todo_id');

            var formData = {
                _token: $('input[name=_token]').val(),
                description: $(this).val(),
                id: todo_id
            };
            console.log(formData);

            $.ajax({
                url : "/account/project/todo/update",
                type: "POST",
                data : formData,
                success: function(data, textStatus, jqXHR)
                {
                    if (data.status) {
                        // nothing 
                    }
                    else {
                        alert('Error: contact the site admin.');
                    }
                }
            });
            
        });

        $('.todo-check-complete').on('click', function(event) {

            if ($(this).hasClass('label-default')) {

                var todo_id = $(this).data('todo_id');
                var todo = $(this);

                $(todo).children().removeClass('fa-square-o');
                $(todo).children().addClass("fa-spinner fa-spin");

                var formData = {
                    _token: $('input[name=_token]').val(),
                    completed: 1,
                    id: todo_id
                };

                // Set it completed
                $.ajax({
                    url : "/account/project/todo/completed",
                    type: "POST",
                    data : formData,
                    success: function(data, textStatus, jqXHR)
                    {
                        if (data.status) {
                            $(todo).children().removeClass("fa-spinner fa-spin");
                            $(todo).removeClass('label-default');
                            $(todo).addClass('label-success');
                            $(todo).children().addClass('fa-check-square-o');

                        }
                        else {
                            alert('Error: contact the site admin.');
                        }
                    }
                });
            }
            else {
                var todo_id = $(this).data('todo_id');
                var todo = $(this);

                //$(todo).addClass('label-success');
                //$(todo).removeClass('label-default');
                $(todo).children().removeClass('fa-check-square-o');
                $(todo).children().addClass("fa-spinner fa-spin");

                var formData = {
                    _token: $('input[name=_token]').val(),
                    completed: 0,
                    id: todo_id
                };

                // Set it completed
                $.ajax({
                    url : "/account/project/todo/completed",
                    type: "POST",
                    data : formData,
                    success: function(data, textStatus, jqXHR)
                    {
                        if (data.status) {
                            $(todo).children().removeClass("fa-spinner fa-spin");
                            $(todo).removeClass('label-success');
                            $(todo).addClass('label-default');
                            $(todo).children().addClass('fa-square-o');

                        }
                        else {
                            alert('Error: contact the site admin');
                        }
                    }
                });
                // Set it not completed
            }

        });


       $('.todo-delete').on('click', function(event) {

            var todo_id = $(this).data('todo_id');
            var todo = $(this);

            //$(todo).addClass('label-success');
            //$(todo).removeClass('label-default');

            var deleted = 0;
            if ($(todo).children().hasClass("fa-times")) {
                $(todo).children().removeClass('fa-times');
                deleted = 1;
            }
            else {
                $(todo).children().removeClass('fa-undo');
            }

            $(todo).children().addClass("fa-spinner fa-spin");


            var formData = {
                _token: $('input[name=_token]').val(),
                deleted: deleted,
                id: todo_id
            };

            // Set it completed
            $.ajax({
                url : "/account/project/todo/deleted",
                type: "POST",
                data : formData,
                success: function(data, textStatus, jqXHR)
                {
                    if (data.status) {
                        $(todo).children().removeClass("fa-spinner fa-spin");
                        //$(todo).removeClass('label-success');
                        //$(todo).addClass('label-default');
                        //location.reload();
                        $(todo).parent().parent().hide();
                        //console.log( $(todo).parent().parent() );
                    }
                    else {
                        alert('Error: contact the site admin');
                    }
                }
            });
        });


    });
    </script>

                </div>
            </div>
        </div>
    </div>

@endif
