function validateEmail(email) { 
  // http://stackoverflow.com/a/46181/11236
  
    var re = /^([^<]*<)?(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))(>?)$/;
    return re.test(email);
}

function toggleDeleted() {
	if ($('input#toggle-deleted').is(':checked')) {
		$('.deleted').show();
	}
	else {
		$('.deleted').hide();
	}
}

$(document).ready(function(){
	
	$('.pull-down').each(function() {
    	$(this).css('margin-top', $(this).parent().height()-$(this).height())
	});
	// Drag and drop
	/*$(document).bind('pageinit', function() {
		$( "#sortable" ).nestedSortable();
		$( "#sortable" ).disableSelection();
		//Refresh list to the end of sort to have a correct display
		$( "#sortable" ).bind( "sortstop", function(event, ui) {
			$('#sortable').listview('refresh');
		});
	});*/

    autosize( $('textarea', '#todo-sortable') );
	
	
	
	
	///////////////////////////////////
	//// Table of contents toggles
	///////////////////////////////////

	//$( ".table-of-contents ul li ul" ).hide();
	$(".table-of-contents .toggle").click();
	
	$(window).load(function() {
		var closed = JSON.parse(localStorage.getItem("toc_"+window.location.href));
		if(closed){
			for (var c; c = closed.pop();) {
				console.log(c);
				$("#"+c+" .toggle").click();
			}
		}
	});
	
	$(".table-of-contents .toggle").click(function(e){
		e.preventDefault();
		var parentItem = $( this ).parent().parent().get( 0 ).id;
		var is_loaded = $("#loaded" ).html();
		console.log(is_loaded);
		
		if( $( "#" + parentItem + " ul" ).length ){
			if( $( this ).hasClass( "fa-chevron-right" ) ){
				$( this ).removeClass( "fa-chevron-right" );
				$( this ).addClass( "fa-chevron-down" );
				$( "#" + parentItem + " ul" ).show();
				console.log('is opened');
				
				//remove it
				var items = JSON.parse(localStorage.getItem("toc_"+window.location.href));
				if(items){
					var removed = items.filter(function(e) { return e !== parentItem });
					console.log('removing '+parentItem+' from '+removed);
					localStorage.setItem("toc_"+window.location.href, JSON.stringify(removed));
				}
				
			} else {
				$(this).removeClass( "fa-chevron-down" );
				$(this).addClass( "fa-chevron-right" );
				$("#" + parentItem + " ul" ).hide();
						
				//add it		
				var items = JSON.parse(localStorage.getItem("toc_"+window.location.href));
				if(items){
					if(items.indexOf(parentItem) == -1){
						items.push(parentItem);
					}
				}else{
					items = [parentItem];
				}
				localStorage.setItem("toc_"+window.location.href, JSON.stringify(items));
			}
		}
		else{
			console.log('else');
		}
		
	});
	
	
	/*
	// Table of contents toggles
	$( ".table-of-contents ul li ul" ).hide();
	
	$(document).on("touchstart click", ".table-of-contents .toggle", function(e){
        //console.log('in touchstrt click');
		e.preventDefault();
		var parentItem = $( this ).parent().parent().get( 0 ).id;
		if( $( "#" + parentItem + " ul" ).length ){
			if( $( this ).hasClass( "fa-chevron-right" ) ){
				// hide all others
				//$( ".table-of-contents .toggle.fa-chevron-down" ).addClass( "fa-chevron-right" );
				//$( ".table-of-contents .toggle" ).removeClass( "fa-chevron-down" );
				//$( ".table-of-contents ul li ul" ).hide();
				
				$( this ).removeClass( "fa-chevron-right" );
				$( this ).addClass( "fa-chevron-down" );
				$( "#" + parentItem + " ul" ).show();
				
			} else {
				$( this ).removeClass( "fa-chevron-down" );
				$( this ).addClass( "fa-chevron-right" );
				$( "#" + parentItem + " ul" ).hide();
			}
		}
	});
	*/

	$(document).on("touchstart click", ".todos .toggle", function(e){
        //console.log('in touchstrt click');
		e.preventDefault();
		var parentItem = $( this ).parent().parent().get( 0 ).id;
        console.log(parentItem);
        if( $( this ).hasClass( "fa-chevron-right" ) ){
            // hide all others
            
            $( this ).removeClass( "fa-chevron-right" );
            $( this ).addClass( "fa-chevron-down" );
            $( "div.todo-description", $("#"+parentItem) ).show();
            autosize.update( $('textarea', '#todo-sortable') );
            
        } else {
            $( this ).removeClass( "fa-chevron-down" );
            $( this ).addClass( "fa-chevron-right" );
            $( "div.todo-description", $("#"+parentItem) ).hide();
            autosize.update( $('textarea', '#todo-sortable') );
        }
	});

    var todo_group = $("ul#todo-sortable").sortable({
		handle: "span.fa-bars",
		//tolerance: 6,
		//distance: 10,
		onDrop: function ($item, container, _super) {
			var data = todo_group.sortable("serialize").get();
			var jsonString = JSON.stringify(data, null, ' ');
			//console.log('onDrop');
			//console.log(jsonString);
			$('#json_todo').val(jsonString);
			//$('#serialize_output').html("<PRE>"+jsonString+"</pre>");
			_super($item, container);
			$('#todo-form').submit();
		},
		exclude: ".new-component",
		nested: false 
    });
	
    var group = $("ul#sortable").sortable({
		handle: "span.fa-bars",
	    afterMove: function ($placeholder, container, $closestItemOrContainer) {
		    //console.log('afterMove');
		    //console.log($placeholder, container, $closestItemOrContainer);
		},
		onDrop: function ($item, container, _super) {
			var data = group.sortable("serialize").get();
			var jsonString = JSON.stringify(data, null, ' ');
			//console.log('onDrop');
			console.log(jsonString);
			$('#json_toc').val(jsonString);
			//$('#serialize_output').html("<PRE>"+jsonString+"</pre>");
			_super($item, container);
			$('#toc-form').submit();
		},
		isValidTarget: function ($item, container) {
		    return true;    
		},
		//tolerance: 6,
		//distance: 10,
		exclude: ".new-component",
		nested: true
    });
    
    /* homepage featured projects */
    $('.phone-with-headphones path.st0').css('fill', 'url(#img1)');
	$('ul.featured-projects li').hover(function(){
		$('ul.featured-projects li').removeClass('selected');
		$(this).addClass('selected');
		
		var imageUrl = $(this).data('image');
		var imageRef = $(this).data('ref');
		//$('.image-behind-phone-with-headphones').css('background-image', 'url(' + imageUrl + ')');
		$('.phone-with-headphones path.st0').css('fill', 'url(#' + imageRef + ')');
	});

});
