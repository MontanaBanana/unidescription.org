@if ($project->id)
<div class="panel panel-default">
    <div class="panel-heading"><h3 class="panel-title">Owner: {{ $project->user->name }}</h3></div>
    <div class="panel-body">
        Shared with:
        <ul class="list-group share-list-group">
            @foreach ($project->users as $user)
                <li class="list-group-item">
                    @if ($project->is_owner())
                        <span class="glyphicon glyphicon-trash pull-right" style="cursor: pointer;" aria-hidden="true" data-email="{{ $user->email }}"></span>
                    @endif
                    <span class="email">{{ $user->email }}</span>
                </li>
            @endforeach
        </ul>
        @if ($project->is_owner())
        <div class="input-group" id="share-input-group">
            <input type="email" class="form-control" id="share-email" placeholder="Email" aria-describedby="share-button" />
            <span class="btn input-group-addon" id="share-button"><i id="share-icon" class="fa fa-plus fa-fw"></i> Share</span>
        </div>
        @endif

    </div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('.share-list-group').on('click', 'span.glyphicon-trash', function(event) {
           console.log($(event.currentTarget).data('email'));
            $('#share-input-group').removeClass('has-error');

            $('#share-icon').removeClass("fa fa-plus fa-fw");
            $('#share-icon').addClass("fa fa-spinner fa-spin");

            var formData = {
                _token: $('input[name=_token]').val(),
                project_id: $('#id').val(),
                email: $(event.currentTarget).data('email'),
                add_or_del: 'del'
            };

            $.ajax({
                url : "/account/project/share",
                type: "POST",
                data : formData,
                success: function(data, textStatus, jqXHR)
                {
                    if (data.status) {
                        $('ul.share-list-group').empty();
                        for (var i = 0; i < data.users.length; i++) {
                            $('ul.share-list-group').append(
                                '<li class="list-group-item"><span class="glyphicon glyphicon-trash pull-right" style="cursor: pointer;" aria-hidden="true" data-email="'+ data.users[i].email +'"></span><span class="email">'+ data.users[i].email +'</span></li>'
                            );
                        }
                        $('#share-icon').removeClass("fa fa-spinner fa-spin");
                        $('#share-icon').addClass("fa fa-plus fa-fw");

                    }
                    else {

                    }
                }
            });
        });


        $('#share-button').click(function(event) {
            var email = $('#share-email').val();

            if (validateEmail(email)) {
                $('#share-input-group').removeClass('has-error');

                $('#share-icon').removeClass("fa fa-plus fa-fw");
                $('#share-icon').addClass("fa fa-spinner fa-spin");

                var formData = {
                    _token: $('input[name=_token]').val(),
                    project_id: $('#id').val(),
                    email: email,
                    add_or_del: 'add'
                };

                $.ajax({
                    url : "/account/project/share",
                    type: "POST",
                    data : formData,
                    success: function(data, textStatus, jqXHR)
                    {
                        if (data.status) {
                            $('ul.share-list-group').empty();
                            for (var i = 0; i < data.users.length; i++) {
                                $('ul.share-list-group').append(
                                    '<li class="list-group-item"><span class="glyphicon glyphicon-trash pull-right" style="cursor: pointer;" aria-hidden="true" data-email="'+ data.users[i].email +'"></span><span class="email">'+ data.users[i].email +'</span></li>'
                                );
                            }
                            $('#share-icon').removeClass("fa fa-spinner fa-spin");
                            $('#share-icon').addClass("fa fa-plus fa-fw");

                            $('#share-email').val('');
                        }
                        else {

                        }
                    }
                });
            }
            else {
                $('#share-input-group').addClass('has-error');
            }
        });
    });

</script>

@endif
