/*
 * JS for Soal module
 * author 	: jojo
 * date		: 2014-03-29
 */

$(document).ready(function(){

	// Init
	$('#box-form-pertanyaan').hide();
	$('#box-form-jadwal').hide();

	$('#step .step-1').css({'color':'rgb(48, 170, 97)','font-weight':'bold'});
	$('#step .step-1 span').css('border','solid 2px rgb(48, 170, 97)');


	// Button save info paket CLICKED
	$('#save-info').click(function(){
		$('#save-info-loading').css('display', 'inline');;
		$('#save-info').hide();
		
		// Get data of form
		var items 	= $('#form-info').serialize();
		
		// Send the AJAX request
		$.ajax({
		    url : CI_ROOT+"soal/save_info",
		    type: "POST",
		    data : items,
		    dataType : "JSON",
		    success: function(data, textStatus, jqXHR)
		    {
				if (data.success) {$('.id_paket').val(data.inserted_id)};

				$('#save-info-loading').css('display', 'none');
				$('#save-info').show();

				/* update progress bar */
				$('#step .line-1').css('border-left','solid 2px rgb(48, 170, 97)');
				$('#step .step-2').css({'color':'rgb(48, 170, 97)','font-weight':'bold'});
				$('#step .step-2 span').css('border','solid 2px rgb(48, 170, 97)');

				/* hide/show form*/
				$('#box-form-info').fadeOut(400);
				$('#box-form-pertanyaan').delay(400).fadeIn();
				
				/* show message */
				$('#soal-alert').fadeIn(400);
				$('#soal-alert').addClass('alert-success');
				$('#soal-alert p').html('Data informasi paket berhasil disimpan.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
				$('#save-info-loading').css('display', 'none');
				$('#save-info').show();

				/* show message */
				$('#soal-alert').fadeIn(400);
				$('#soal-alert').addClass('alert-danger');
				$('#soal-alert p').html('Terjadi kesalahan saat menyimpan data.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    }
		});
	});

	// Button save pertanyaan CLICKED
	$('#save-pertanyaan').click(function(){
		$('#save-pertanyaan-loading').css('display', 'inline');;
		$('#save-pertanyaan').hide();
		
		// Get data of each form
		var items = {};
		for (var number = 1; number <= 12; number++) {
			var id 		= '#list-pertanyaan li:nth-child('+number+') form';
			items[number] 	= {}
			items[number]['id_paket'] 		= $(id+' .id_paket').val()
			items[number]['isi_pertanyaan'] = $(id+' .isi_pertanyaan').val()
			items[number]['aspek'] 			= $(id+' .aspek').val()
			items[number]['urutan']			= number;

		};

		// Send the AJAX request
		$.ajax({
		    url : CI_ROOT+"soal/save_pertanyaan",
		    type: "POST",
		    data : items,
		    success: function(data, textStatus, jqXHR)
		    {
				$('#save-pertanyaan-loading').css('display', 'none');
				$('#save-pertanyaan').show();

				/* hide/show form*/
				$('#box-form-pertanyaan').fadeOut(400);
				$('#box-form-jadwal').delay(400).fadeIn();

				/* update progress bar */
				$('#step .step-3').css({'color':'rgb(48, 170, 97)','font-weight':'bold'});
				$('#step .step-3 span').css('border','solid 2px rgb(48, 170, 97)');
				$('#step .line-2').css('border-left','solid 2px rgb(48, 170, 97)');

				/* show message */
				$('#soal-alert').fadeIn(400);
				$('#soal-alert').addClass('alert-success');
				$('#soal-alert p').html('Data pertanyaan berhasil disimpan.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
				$('#save-pertanyaan-loading').css('display', 'none');
				$('#save-pertanyaan').show();

				/* show message */
				$('#soal-alert').fadeIn(400);
				$('#soal-alert').addClass('alert-danger');
				$('#soal-alert p').append('Terjadi kesalahan saat menyimpan data.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    }
		});
	});
	
	// Button save penjadwalan CLICKED
	$('#save-jadwal').click(function(){
		$('#save-jadwal-loading').css('display', 'inline');;
		$('#save-jadwal').hide();

		// Get data of each form
		var items =	{};
		var jumlah_prodi= $('#jumlah_prodi').val();
		for (var number = 1; number <= jumlah_prodi; number++) {
			form		= '#form-jadwal-'+number;
			items[number] = {};
			items[number]['id_paket'] 	= $(form+' .id_paket').val();
			items[number]['id_unit'] 	= $(form+' .id_unit').val();
			items[number]['tgl_mulai'] 	= $(form+' .tgl_mulai').val();
			items[number]['tgl_akhir'] 	= $(form+' .tgl_akhir').val();
		};

		// Send the AJAX request
		$.ajax({
		    url : CI_ROOT+"soal/save_jadwal",
		    type: "POST",
		    data : items,
		    success: function(data, textStatus, jqXHR)
		    {
				$('#save-jadwal-loading').css('display', 'none');
				$('#save-jadwal').show();

				/* hide/show form*/
				$('#box-form-jadwal').fadeOut(400);

				/* show message */
				$('#soal-alert').fadeIn(400);
				$('#soal-alert').addClass('alert-success');
				$('#soal-alert p').html('Data penjadwalan berhasil disimpan.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
				$('#save-jadwal-loading').css('display', 'none');
				$('#save-jadwal').show();

				/* show message */
				$('#soal-alert').fadeIn(400);
				$('#soal-alert').addClass('alert-danger');
				$('#soal-alert p').html('Terjadi kesalahan saat menyimpan data.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    }
		});
	});

});

$(function() {
	$('.sortable').sortable();
});