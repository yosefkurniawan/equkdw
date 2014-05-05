/*
 * JS for Mahasiswa module
 * author 	: bimo
 * date		: 2014-03-29
 */

$(document).ready(function(){


	// Navbar Scroll To
	$('#nav-dosen-1').click(function(){
		$('html, body').animate({
	        scrollTop: $('#box-form-dosen-1').offset().top-80
	    }, 'slow');
	});
	$('#nav-dosen-2').click(function(){
		$('html, body').animate({
	        scrollTop: $('#box-form-dosen-2').offset().top-80
	    }, 'slow');
	});
	$('#nav-dosen-3').click(function(){
		$('html, body').animate({
	        scrollTop: $('#box-form-dosen-3').offset().top-80
	    }, 'slow');
	});
	$('#nav-dosen-4').click(function(){
		$('html, body').animate({
	        scrollTop: $('#box-form-dosen-3').offset().top-80
	    }, 'slow');
	});
	$('#nav-dosen-5').click(function(){
		$('html, body').animate({
	        scrollTop: $('#box-form-dosen-3').offset().top-80
	    }, 'slow');
	});


	$('#save-jawaban').click(function(){
		$('#save-jawaban-loading').css('display', 'inline');
		$('#save-jawaban').hide();
		submit_jawaban();
	});

});

function submit_jawaban(){
	var is_validate = true;

	// validate
	var is_scrolled = false;


	var r=confirm("Anda yakin dengan isian anda?");
	if (r==true)
	{
		$('.form-kuisioner').each(function(){
			var id_form = '#'+$(this).attr('id');
			for (var i = 1; i <= 12; i++) {
				$(id_form+' .q'+i+' .pertanyaan-error-notif').hide();
				$(id_form+' .q'+i).css('background','inherit');

				var filled = false;
				$(id_form+' .q'+i+' input[type=radio].a'+i).each(function () {
					if ($(this).is(':checked')) {
						filled = true;
					}
				});
				if (!filled) {
					is_validate = false;
					$(id_form+' .q'+i+' .pertanyaan-error-notif').show();
					$(id_form+' .q'+i).css('background','rgb(255, 244, 244)');
					$('#save-jawaban-loading').css('display', 'none');
					$('#save-jawaban').show();
					is_validate = false;
				}
			};
		});

		// goes to first answer wich is not  filled
		if (!is_scrolled) {
			$('.pertanyaan-error-notif').each(function(){
				if ($(this).css('display') != 'none') {
					$('html, body').animate({
				        scrollTop: $(this).first().offset().top-100
				    }, 'slow');
				    $(this).focus();
					is_scrolled = true;
					return false;
				};
			});
		}
		
		$('.isi_masukan').each(function(){
			$(this).css('border','1px solid #ccc');
			$(this).next('.pertanyaan-error-notif').fadeOut();
			if ($(this).val()=='') {
				$(this).css('border','1px solid rgb(231, 49, 15)');
				$(this).next('.pertanyaan-error-notif').fadeIn();
				$(this).next('.pertanyaan-error-notif').html('Masukan tidak boleh kosong!');
				if (!is_scrolled) {
					$('html, body').animate({
				        scrollTop: $(this).offset().top-100
				    }, 'slow');
				    $(this).focus();
					is_scrolled = true;
				}
				$('#save-jawaban-loading').css('display', 'none');
				$('#save-jawaban').show();
				is_validate = false;
			}
		});			

		if (is_validate) {
			// Get data of each form
			var items =	{}; 
			var jumlah_dosen= $('#jumlah_dosen').val();
			for (var number = 1; number <= jumlah_dosen; number++) {
				form		= '#form-kuisioner-'+number;

				items[number] = {};
				items[number]['presensi'] 	= $(form+' .presensi').val();
				items[number]['nik'] 		= $(form+' .nik').val();
				items[number]['id_kelasb'] 	= $(form+' .id_kelasb').val();
				items[number]['id_paket'] 	= $(form+' .id_paket').val();
				items[number]['nim'] 		= $(form+' .nim').val();

				for (var num = 1; num <= 12; num++) {
					$(form+' input[type=radio].a'+num).each(function () {
						if ($(this).is(':checked')) {
							var nama = 'a'+num;
							items[number][nama] 		= $(this).val();
						}
					});
				}
				items[number]['masukan_dosen'] 			= $(form+' .masukan_dosen').val();
				items[number]['masukan_matkul'] 		= $(form+' .masukan_matkul').val();
			};

			// Send the AJAX request
			$.ajax({
			   url : CI_ROOT+"mahasiswa/kuisioner/save_jawaban_kuisioner",
			   type: "POST",
			   data : items,
			   success: function(data, textStatus, jqXHR)
			   {
			$('#save-jawaban-loading').css('display', 'none');
			$('#save-jawaban').show();
			        window.location.replace(CI_ROOT + 'mahasiswa/dashboard');
			   },

			   error: function (jqXHR, textStatus, errorThrown)
			   {
			$('#save-jawaban-loading').css('display', 'none');
			$('#save-jawaban').show();

			/* show message */
			$('#soal-alert').fadeIn(400);
			$('#soal-alert').addClass('alert-danger');
			$('#soal-alert p').html('Terjadi kesalahan saat menyimpan data.');

			$('html,body').animate({ scrollTop: 0 }, 'slow');
			   }
			});


		} //end of validation

	}else{
		$('#save-jawaban-loading').css('display', 'none');
		$('#save-jawaban').show();
	} //end of confirmation
	
}
