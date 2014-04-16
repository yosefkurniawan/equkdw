/*
 * JS for Soal module
 * author 	: jojo
 * date		: 2014-03-29
 */

$(document).ready(function(){
	var form_type = $('#form_type').val();

	// Set Form pertanyaan as sortable list
	$('.sortable').sortable();

	// Check whether view mode or not
	if (form_type=="view") {
		$(":input").attr("disabled","disabled");
	};

	// Init
	if (form_type=='new') {
		$('#box-form-pertanyaan').hide();
		$('#box-form-jadwal').hide();
		$('#step .step-1').css({'color':'rgb(48, 170, 97)','font-weight':'bold'});
		$('#step .step-1 span').css('border','solid 2px rgb(48, 170, 97)');
	};

	// Button save info paket CLICKED
	$('#save-info').click(function(){
		$('#save-info-loading').css('display', 'inline');
		$('#save-info').hide();
		if (form_type=='new') {
			if($('input:radio[name=pilih_paket]:checked').val() == 'salin'){
				getLatestQuestions();
			}else{
				save_new_paket_info();
			}
		}else{
			save_edit_paket_info();
		}
	});

	// Button save pertanyaan CLICKED
	$('#save-pertanyaan').click(function(){
		$('#save-pertanyaan-loading').css('display', 'inline');
		$('#save-pertanyaan').hide();
		if (form_type=='new') {
			save_new_pertanyaan();
		}else{
			save_edit_pertanyaan();
		}
	});
	
	// Button save penjadwalan CLICKED
	$('#save-jadwal').click(function(){
		$('#save-jadwal-loading').css('display', 'inline');;
		$('#save-jadwal').hide();
		if (form_type=='new') {
			save_new_jadwal();
		}else{
			save_edit_jadwal();
		}
	});

	// set date all as date picker
	$('#tgl_mulai_all').datetimepicker({
		lang:'de',
		 i18n:{
		  de:{
		   months:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
		   dayOfWeek:['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']
		  }
		 },
		 timepicker:false,
		 format:'d/m/Y',
		 minDate:Date(),
		 onShow:function( ct ){
		 	maxDate 	= $('#tgl_akhir_all').val();
		 	arrMaxDate 	= maxDate.split('/');
		 	newMaxDate 	= arrMaxDate[2]+'/'+arrMaxDate[1]+'/'+arrMaxDate[0];
		   	this.setOptions({
		   		maxDate:$('#tgl_akhir_all').val()?newMaxDate:false
		   	});
		 }
	});
	$('#tgl_akhir_all').datetimepicker({
			lang:'de',
		 i18n:{
		  de:{
		   months:['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'],
		   dayOfWeek:['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']
		  }
		 },
		 timepicker:false,
		 format:'d/m/Y',
		 onShow:function( ct ){
		 	minDate 	= $('#tgl_mulai_all').val();
		 	arrMinDate 	= minDate.split('/');
		 	newMinDate 	= arrMinDate[2]+'/'+arrMinDate[1]+'/'+arrMinDate[0];
		   	this.setOptions({
		   		minDate:$('#tgl_mulai_all').val()?newMinDate:false
		   	})
		 }
	});

	// Navbar Scroll To
	$('#nav-info-paket').click(function(){
		$('html, body').animate({
	        scrollTop: $('#box-form-info').offset().top-55
	    }, 'slow');
	});
	$('#nav-pertanyaan').click(function(){
		$('html, body').animate({
	        scrollTop: $('#box-form-pertanyaan').offset().top-55
	    }, 'slow');
	});
	$('#nav-jadwal').click(function(){
		$('html, body').animate({
	        scrollTop: $('#box-form-jadwal').offset().top-55
	    }, 'slow');
	});
});


function getLatestQuestions(){
	$.ajax({
		    url : CI_ROOT+"soal/getLatestQuestions",
		    type: "GET",
	    	dataType : "JSON",
		    success: function(data, textStatus, jqXHR)
		    {
		    		$('list-pertanyaan option.aspek:selected', 'select').removeAttr('selected');

		    		$('#pertanyaan1 .aspek').val(data[0].id_aspek);
		    		$('#pertanyaan1 .isi_pertanyaan').val(data[0].isi_pertanyaan);
		    		$('#pertanyaan2 .aspek').val(data[1].id_aspek);
		    		$('#pertanyaan2 .isi_pertanyaan').val(data[1].isi_pertanyaan);
		    		$('#pertanyaan3 .aspek').val(data[2].id_aspek);
		    		$('#pertanyaan3 .isi_pertanyaan').val(data[2].isi_pertanyaan);
		    		$('#pertanyaan4 .aspek').val(data[3].id_aspek);
		    		$('#pertanyaan4 .isi_pertanyaan').val(data[3].isi_pertanyaan);
		    		$('#pertanyaan5 .aspek').val(data[4].id_aspek);
		    		$('#pertanyaan5 .isi_pertanyaan').val(data[4].isi_pertanyaan);
		    		$('#pertanyaan6 .aspek').val(data[5].id_aspek);
		    		$('#pertanyaan6 .isi_pertanyaan').val(data[5].isi_pertanyaan);
		    		$('#pertanyaan7 .aspek').val(data[6].id_aspek);
		    		$('#pertanyaan7 .isi_pertanyaan').val(data[6].isi_pertanyaan);
		    		$('#pertanyaan8 .aspek').val(data[7].id_aspek);
		    		$('#pertanyaan8 .isi_pertanyaan').val(data[7].isi_pertanyaan);
		    		$('#pertanyaan9 .aspek').val(data[8].id_aspek);
		    		$('#pertanyaan9 .isi_pertanyaan').val(data[8].isi_pertanyaan);
		    		$('#pertanyaan10 .aspek').val(data[9].id_aspek);
		    		$('#pertanyaan10 .isi_pertanyaan').val(data[9].isi_pertanyaan);
		    		$('#pertanyaan11 .aspek').val(data[10].id_aspek);
		    		$('#pertanyaan11 .isi_pertanyaan').val(data[10].isi_pertanyaan);
		    		$('#pertanyaan12 .aspek').val(data[11].id_aspek);
		    		$('#pertanyaan12 .isi_pertanyaan').val(data[11].isi_pertanyaan);
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
				$('#save-info-loading').css('display', 'none');
				$('#save-info').show();

				/* show message */
				$('#soal-alert').fadeIn(400);
				$('#soal-alert').addClass('alert-danger');
				$('#soal-alert p').html('Terjadi kesalahan saat mengambil data pertanyaan semester sebelumnya.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    }
		}).done(function(){
			save_new_paket_info();
		});
}

function save_new_paket_info(){
	// Get data of form
	var items 		= $('#form-info').serialize();
	var items		= items+'&thn_ajaran='+$('#thn_ajaran').val()+'&semester='+$('#semester').val();
	
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
}

function save_edit_paket_info(){
	// Get data of form
	var items 		= $('#form-info').serialize();
	var items		= items+'&thn_ajaran='+$('#thn_ajaran').val()+'&semester='+$('#semester').val();

	// Send the AJAX request
	$.ajax({
	    url : CI_ROOT+"soal/save_edit_info",
	    type: "POST",
	    data : items,
	    success: function(data, textStatus, jqXHR)
	    {
			$('#save-info-loading').css('display', 'none');
			$('#save-info').show();

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
}


function save_new_pertanyaan(){
	var is_validate = true;

	// validate
	var is_scrolled = false;
	$('.isi_pertanyaan').each(function(){
		$(this).css('border','1px solid #ccc');
		$(this).next('.pertanyaan-error-notif').fadeOut();
		if ($(this).val()=='') {
			$(this).css('border','1px solid rgb(231, 49, 15)');
			$(this).next('.pertanyaan-error-notif').fadeIn();
			$(this).next('.pertanyaan-error-notif').html('Pertanyaan tidak boleh kosong!');
			if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: $(this).offset().top-100
			    }, 'slow');
			    $(this).focus();
				is_scrolled = true;
			}
			$('#save-pertanyaan-loading').css('display', 'none');
			$('#save-pertanyaan').show();
			is_validate = false;
		}
	});
	

	if (is_validate) {
		// Get data of each form
		var items = {};
		for (var number = 1; number <= 12; number++) {
			var id 		= '#list-pertanyaan li:nth-child('+number+') form';
			items[number] 	= {}
			items[number]['id_paket'] 		= $(id+' .id_paket').val()
			items[number]['isi_pertanyaan'] = $(id+' .isi_pertanyaan').val()
			items[number]['aspek'] 			= $(id+' .aspek').val()
			items[number]['keterangan']		= $(id+' .keterangan').val()
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
				$('#soal-alert p').html('Terjadi kesalahan saat menyimpan data.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    }
		});
	}
}

function save_edit_pertanyaan(){
	var is_validate = true;

	// validate
	var is_scrolled = false;
	$('.isi_pertanyaan').each(function(){
		$(this).css('border','1px solid #ccc');
		$(this).next('.pertanyaan-error-notif').fadeOut();
		if ($(this).val()=='') {
			$(this).css('border','1px solid rgb(231, 49, 15)');
			$(this).next('.pertanyaan-error-notif').fadeIn();
			$(this).next('.pertanyaan-error-notif').html('Pertanyaan tidak boleh kosong!');
			if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: $(this).offset().top-100
			    }, 'slow');
			    $(this).focus();
				is_scrolled = true;
			}
			$('#save-pertanyaan-loading').css('display', 'none');
			$('#save-pertanyaan').show();
			is_validate = false;
		}
	});

	if (is_validate) {
		// Get data of each form
		var items = {};
		for (var number = 1; number <= 12; number++) {
			var id 		= '#list-pertanyaan li:nth-child('+number+') form';
			items[number] 	= {}
			items[number]['id_paket'] 		= $(id+' .id_paket').val()
			items[number]['isi_pertanyaan'] = $(id+' .isi_pertanyaan').val()
			items[number]['aspek'] 			= $(id+' .aspek').val()
			items[number]['keterangan']		= $(id+' .keterangan').val()
			items[number]['urutan']			= number;

		};

		// Send the AJAX request
		$.ajax({
		    url : CI_ROOT+"soal/save_edit_pertanyaan",
		    type: "POST",
		    data : items,
		    success: function(data, textStatus, jqXHR)
		    {
				$('#save-pertanyaan-loading').css('display', 'none');
				$('#save-pertanyaan').show();

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
				$('#soal-alert p').html('Terjadi kesalahan saat menyimpan data.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
		    }
		});
	}
}

function save_new_jadwal(){
	var is_validate = true;

	// validate
	var is_scrolled = false;
	$('.tgl_mulai').each(function(){
		$(this).css('border','1px solid #ccc');
		$(this).parent().next('.jadwal-tglmulai-error-notif').fadeOut();
		if ($(this).val()=='') {
			$(this).css('border','1px solid rgb(231, 49, 15)');
			$(this).parent().next('.jadwal-tglmulai-error-notif').fadeIn();
			$(this).parent().next('.jadwal-tglmulai-error-notif').html('Tanggal mulai tidak boleh kosong!');
			if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: $(this).offset().top-100
			    }, 'slow');
			    $(this).focus();
				is_scrolled = true;
			}
			$('#save-jadwal-loading').css('display', 'none');
			$('#save-jadwal').show();
			is_validate = false;
		}
	});
	$('.tgl_akhir').each(function(){
		$(this).css('border','1px solid #ccc');
		$(this).parent().next('.jadwal-tglakhir-error-notif').fadeOut();
		if ($(this).val()=='') {
			$(this).css('border','1px solid rgb(231, 49, 15)');
			$(this).parent().next('.jadwal-tglakhir-error-notif').fadeIn();
			$(this).parent().next('.jadwal-tglakhir-error-notif').html('Tanggal akhir tidak boleh kosong!');
			if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: $(this).offset().top-100
			    }, 'slow');
			    $(this).focus();
				is_scrolled = true;
			}
			$('#save-jadwal-loading').css('display', 'none');
			$('#save-jadwal').show();
			is_validate = false;
		}
	});

	if (is_validate) {
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
	}
}

function save_edit_jadwal(){
	var is_validate = true;

	// validate
	var is_scrolled = false;
	$('.tgl_mulai').each(function(){
		$(this).css('border','1px solid #ccc');
		$(this).parent().next('.jadwal-tglmulai-error-notif').fadeOut();
		if ($(this).val()=='') {
			$(this).css('border','1px solid rgb(231, 49, 15)');
			$(this).parent().next('.jadwal-tglmulai-error-notif').fadeIn();
			$(this).parent().next('.jadwal-tglmulai-error-notif').html('Tanggal mulai tidak boleh kosong!');
			if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: $(this).offset().top-100
			    }, 'slow');
			    $(this).focus();
				is_scrolled = true;
			}
			$('#save-jadwal-loading').css('display', 'none');
			$('#save-jadwal').show();
			is_validate = false;
		}
	});
	$('.tgl_akhir').each(function(){
		$(this).css('border','1px solid #ccc');
		$(this).parent().next('.jadwal-tglakhir-error-notif').fadeOut();
		if ($(this).val()=='') {
			$(this).css('border','1px solid rgb(231, 49, 15)');
			$(this).parent().next('.jadwal-tglakhir-error-notif').fadeIn();
			$(this).parent().next('.jadwal-tglakhir-error-notif').html('Tanggal akhir tidak boleh kosong!');
			if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: $(this).offset().top-100
			    }, 'slow');
			    $(this).focus();
				is_scrolled = true;
			}
			$('#save-jadwal-loading').css('display', 'none');
			$('#save-jadwal').show();
			is_validate = false;
		}
	});

	if (is_validate) {
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
		    url : CI_ROOT+"soal/save_edit_jadwal",
		    type: "POST",
		    data : items,
		    success: function(data, textStatus, jqXHR)
		    {
				$('#save-jadwal-loading').css('display', 'none');
				$('#save-jadwal').show();

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
	}
}


// Confirmation delete paket
function delPaket(id_paket){
	if (confirm('Anda yakin ingin menghapus paket?')) {
		window.location.replace(CI_ROOT+'soal/delete/'+id_paket);
	}
}

function setAllDate(){
	$('#set-all-date').slideToggle();
	
	if ($('#set-all-date-link i').hasClass('icon-angle-up')) {
		$('#set-all-date-link i').removeClass();
		$('#set-all-date-link i').addClass('icon-angle-down');
	}
	else{
		$('#set-all-date-link i').removeClass();
		$('#set-all-date-link i').addClass('icon-angle-up');
	}
}

function setAllDateClick(){
	var tgl_mulai = $('#tgl_mulai_all').val();
	var tgl_akhir = $('#tgl_akhir_all').val();
	$('.tgl_mulai').each(function(){
		$(this).val(tgl_mulai);
	});
	$('.tgl_akhir').each(function(){
		$(this).val(tgl_akhir);
	});
}