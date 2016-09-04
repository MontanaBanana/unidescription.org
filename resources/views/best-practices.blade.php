@extends('layouts.app')

@section('content')

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Best Practices
                    <small>UniDescription Best Practices</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ SITEROOT }}/">Home</a>
                    </li>
                    <li class="active">Best Practices</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
                    
 

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
					
					$( "#email_search" ).autocomplete({
					  source: window.name_email
					});
                });
            }
          }
		});
        </script>
        <script src="https://apis.google.com/js/client.js"></script>
        <button class="googleContactsButton">Get my contacts</button>

		<input type="text" id="email_search" />
 
        </div>
        <!-- End the content -->

@endsection
