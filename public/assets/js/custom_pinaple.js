// Initialisation function
$(document).ready(function(){

	/* ------ drag and drop form pertanyaan ------ */
	// When "save changes" clicked, save!
	$('#save').click(function(){
		$('#loading').css('display', 'inline');
		$('#save').html('Saving...');
		$('#save').disabled = true;
		
		// Get list of item order
		var items = $('#sortable').serialize();
		alert(items);
		// Send the AJAX request
		var myRequest = new Request(
		{
			method: 'post',
			url: '<?php echo base_url() ?>soal/test',
			data: items,
			onSuccess: function(data)
			{
				alert('Server returned: ' + data);
				$('#loading').css('display', 'none');
				$('#save').html('Save changes');
				$('#save').disabled = false;
			}
		}).send();
	});
	
	// Create a new Sortables instance. Pass this the ID of your list
	mySortables = new Sortables('sortable',
	{
		// Make a clone when dragging (element "floats" from the list_
		clone: true,
		// Do fancy animation when dragging has finished
		revert: true,
		// Called when we start dragging the element
		onStart: function(element, clone)
		{
			element.setStyle('visibility', 'hidden');
			clone.addClass('clone');
		}
	});

});