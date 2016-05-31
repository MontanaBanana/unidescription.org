function validateEmail(email) { 
  // http://stackoverflow.com/a/46181/11236
  
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
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
	
	// Table of contents toggles
	$( ".table-of-contents ul li ul" ).hide();
	
	//$(".table-of-contents .toggle").on("click", function(e){
	//$(".table-of-contents .toggle").on("tap", function(){
	//$( ".table-of-contents .toggle" ).click(function(){
	$(document).on("touchstart click", ".table-of-contents .toggle", function(e){
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
	
	$( "#sortable" ).nestedSortable({
		forcePlaceholderSize: true,
		handle: 'div',
		helper:	'clone',
		items: 'li',
		opacity: .6,
		placeholder: 'placeholder',
		revert: 250,
		tabSize: 25,
		tolerance: 'pointer',
		toleranceElement: '> div',
		maxLevels: 2,
		isTree: true,
		expandOnHover: 700,
		listType: 'ul',
		startCollapsed: false
	});
	$( "#sortable" ).disableSelection();
	//Refresh list to the end of sort to have a correct display
	//$( "#sortable" ).bind( "sortstop", function(event, ui) {
	//	$('#sortable').listview('refresh');
	//});
});
