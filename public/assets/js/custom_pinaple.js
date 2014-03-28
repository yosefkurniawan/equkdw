// Initialisation function
$(document).ready(function(){

	/* ------ drag and drop form pertanyaan ------ */
	// When "save changes" clicked, save!
	$('#save-paket').click(function(){
		$('#save-paket-loading').css('display', 'inline');;
		$('#save-paket').hide();
		
		// Get data of each form
		for (var number = 1; number <= 12; number++) {
			var id 		= '#list-pertanyaan li:nth-child('+number+') form';
			var items 	= $(id).serialize()+'&urutan='+number+'&id_paket=sample_id';
			alert(items);
			// Send the AJAX request
			$.ajax({
			    url : "/soal/save_pertanyaan",
			    type: "POST",
			    data : items,
			    success: function(data, textStatus, jqXHR)
			    {
			        alert('Success');
					$('#save-paket-loading').css('display', 'none');
					$('#save-paket').show();
			    },
			    error: function (jqXHR, textStatus, errorThrown)
			    {
			 		alert('Terjadi kesalahan saat menyimpan data');
					$('#save-paket-loading').css('display', 'none');
					$('#save-paket').show();
			    }
			});
		};
	});
	
});

$(function() {
	$('.sortable').sortable();
});