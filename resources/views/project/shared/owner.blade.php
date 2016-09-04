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
				<input type="text" class="form-control" id="share-email" placeholder="Email" aria-describedby="share-button" />
				<span class="btn input-group-addon" id="share-button"><i id="share-icon" class="fa fa-plus fa-fw"></i> Share</span>
			</div>
			<span class="btn googleContactsButton"><i class="fa fa-envelope fa-fw"></i> Authorize searching Google contacts</span>
			<p id="googleContactSuccess" style="display: none;">Alright! Now, you can just start typing email addresses or names of your contacts.</p>
        @endif

    </div>
</div>

    <script type="text/javascript">
        var clientId = '1024439531736-nmgb80hc0oi8i0d938a37u2d6ev68jgc.apps.googleusercontent.com';
        var apiKey = 'AIzaSyCpU-RMg5M0HABTwFc5UQsHnGvoqBPBguk';
        var scopes = 'https://www.googleapis.com/auth/contacts.readonly';
		window.name_email = [];
		  
		Array.prototype.findReg = function(match) {
			var reg = new RegExp(match);

			return this.filter(function(item){
				//console.log(item);
				return typeof item == 'string' && item.match(reg);
			});
		}
		
		$(document).ready(function() {
		
          $(document).on("click",".googleContactsButton", function(){
            gapi.client.setApiKey(apiKey);
            window.setTimeout(authorize);
          });
		  
		  $(document).on("click" ,"#email_search", function() {
		    search_list = name_email.findReg( $('#email_search').val() );
		  });
          
		  function authorize() {
            gapi.auth.authorize({client_id: clientId, scope: scopes, immediate: false}, handleAuthorization);
          }
		  
          function handleAuthorization(authorizationResult) {
            if (authorizationResult && !authorizationResult.error) {
              $.get("https://www.google.com/m8/feeds/contacts/default/thin?alt=json&access_token=" + authorizationResult.access_token + "&max-results=500&v=3.0",
                function(result){
				    $.each( result.feed.entry, function( i, entry ){
						var name = 'undefined';
						if (typeof entry.gd$name !== 'undefined' && typeof entry.gd$name.gd$fullName.$t !== 'undefined') {
							var name = entry.gd$name.gd$fullName.$t;
						}
						
						//console.log( entry );
						if (typeof entry.gd$email !== 'undefined') {
							$.each( entry.gd$email, function( j, address ){
								//console.log(name + ' = ' + address.address);
								window.name_email.push( name + ' <' + address.address + '>' );
							});
						}
					});
					
					$( "#share-email" ).autocomplete({
					  source: window.name_email
					});
					
					$( '#googleContactSuccess' ).show();
                });
            }
          }
		});
    </script>
    <script src="https://apis.google.com/js/client.js"></script>

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
