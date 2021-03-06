@if ($project->id)


    <div class="row hidden-xs hidden-sm">
            <div class="panel panel-default">
                <div class="panel-heading" id="todo-header">To Do:</div>
                <div class="panel-body white unid-list todos" aria-labelledby="todo-header">

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
                <span data-todo_id="{{ $todo->id }}" class="todo-check-complete label pull-right @if ($todo->completed) label-success @else label-default @endif" data-toggle="tooltip" data-placement="left" title="Mark as complete"><span class="fa @if ($todo->completed) fa-check-square @else fa-square @endif"></span></span>
                <div class="todo-description">
                    <textarea data-todo_id="{{ $todo->id }}" class="todo-textarea" placeholder="Any other instructions to add? Type here.">{{ $todo->description }}</textarea>
                </div>
                <?php if (strlen($todo->url)): ?>
                    <a href="{{ $todo->url }}" target="_blank">Click for activity</a>
                <?php endif; ?>
            </div>
        </li>
    <?php
        endforeach;
    ?>

        <li class="new-component">
            <div class="input-group">
                <input type="text" class="form-control" id="todo-new" name="todo-new" onKeyPress="addOnEnter(event, this);" placeholder="Add a new To Do..." aria-describedby="todo-add" />
                <span class="btn btn-sm btn-primary btn-inline add-todo" id="todo-add"><i id="plus-icon" class="fa fa-plus fa-fw"></i> ADD</span>
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

        var submitted = false;
        $('#todo-add').on('click', function() {
            if (submitted) {
               return; 
            }
            submitted = true;

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

                $(todo).children().removeClass('fa-square');
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
                            $(todo).children().addClass('fa-check-square');

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
                $(todo).children().removeClass('fa-check-square');
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
                            $(todo).children().addClass('fa-square');

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

        $('i.toggle', '#todo-sortable').click();
    });
    </script>

                </div>
            </div>
    </div>

@endif
