/*
 * JS for Soal-Tambahan
 * author 	: jojo
 * date		: 2014-06-14
 */

$(document).ready(function(){
	
	// Check whether view mode or not
	if ($('#form_type').val()=="view") {
		$(":input").attr("disabled","disabled");
		$(".tagsinput").before("<span class='tagsinput-blocker'></span>");
		$(".link-tambah-pertanyaan").hide();
		$("#form-pertanyaan-tambahan .panel-footer").hide();
	};

	// grab data paket & pertanyaan
	if ($('#form_type').val()=="view" || $('#form_type').val()=="edit") {
		getDataPaket();
	}

	$('.link-tambah-pertanyaan').click(function(){
		var content = '<li class="pertanyaan">\
						<div class="col-md-7">\
							<textarea class="form-control isi_pertanyaan required" name="isi_pertanyaan[]" rows="1" placeholder="isi pertanyaan..."></textarea>\
						</div>\
						<div class="col-md-2">\
							<select name="jenis[]" class="form-control required jenis">\
								<option value="">-- Jenis --</option>\
								<option value="text">Teks</option>\
								<option value="paragraph">Paragraf</option>\
								<option value="multiple choice">Pilihan Banyak</option>\
								<option value="single choice">Pilihan Tunggal</option>\
								<option value="scale">Skala</option>\
								<option value="date">Tanggal</option>\
								<option value="time">Waktu</option>\
								<option value="datetime">Tanggal &amp; Waktu</option>\
							</select>\
						</div>\
						<div class="col-md-1">\
							<input type="checkbox" name="is_required[]" class="is_required" checked/>\
						</div>\
						<div class="col-md-2 buttons-set last">\
							<button class="btn yellow-bg btn-config" style="display:none;" onclick="toggleDetailBox(this)"><i class="icon-cog"></i></button>\
							<button class="btn red-bg btn-remove" onclick="delPertanyaan(this)"><i class="icon-trash"></i></button>\
						</div>\
						<input type="hidden" name="pilihan[]" class="pilihan"/>\
						<div class="clearfix"></div>\
						<div class="detail-box" style="display:none;">\
							<div class="col-md-2">\
								<label for="pilihan">Pilihan</label>\
								<i class="tooltip-demo"\
		                            data-original-title="Maukkan pilihan untuk jawanban. Satu baris untuk satu pilihan "\
		                            data-placement="right" data-toggle="tooltip" href="#"\
		                            title=""><i class="icon-question-sign"></i></i> \
							</div>\
							<div class="col-md-10">\
								<textarea class="pilihan-viewable" rows="4" cols="30" onchange="setPilihan(this)"></textarea>\
							</div>\
							<a href="javascript:void(0)" class="hide-detail-box" onclick="toggleDetailBox(this)">Sembunyikan <i class="icon-double-angle-up"></i></a>\
							<div class="clearfix"></div>\
						</div>\
				</li>';
		$('#list-pertanyaan').append(content);
		$('#list-pertanyaan li:last-child').slideDown().css('display','list-item');
		$('.sortable').sortable();
		
		$('select.jenis').change(function(){
			if ($(this).val()=="single choice" || $(this).val()=="multiple choice") {
				$(this).parents().children('.buttons-set').children('.btn-config').show();
				$(this).parents().children('.detail-box').slideDown();
				$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').focus();
				$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').addClass('required');
			}else{
				$(this).parents().children('.buttons-set').children('.btn-config').hide();
				$(this).parents().children('.detail-box').slideUp();
				$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').removeClass('required');
			}
		});
	});

	$('select.jenis').change(function(){
		if ($(this).val()=="single choice" || $(this).val()=="multiple choice") {
			$(this).parents().children('.buttons-set').children('.btn-config').show();
			$(this).parents().children('.detail-box').slideDown();
			$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').focus();
			$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').addClass('required');
		}else{
			$(this).parents().children('.buttons-set').children('.btn-config').hide();
			$(this).parents().children('.detail-box').slideUp();
			$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').removeClass('required');
		}
	});

	/* Custom Input Tags */
	$('.tagsinput').click(function(){hideInput(this)});
	$('.tagsinput span.tambah').click(function(){showInput(this)});
	$('.tagsinput span.tag a.hapus').click(function(){delTag(this)});
	$('.tagsinput').children().click(function(){event.stopPropagation()});
	$('.tagsinput .input').change(function(){
		var text = '';
		if ($(this).is('select')) {
			text = $(this).find('option:selected').text();
		}else{
			text = $(this).val();
		}
		addTag(this.value,text,this)
	});
	$('.select2').select2();


	// set date all as date picker
	$('#tgl_mulai').datetimepicker({
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
		 	maxDate 	= $('#tgl_akhir').val();
		 	arrMaxDate 	= maxDate.split('/');
		 	newMaxDate 	= arrMaxDate[2]+'/'+arrMaxDate[1]+'/'+arrMaxDate[0];
		   	this.setOptions({
		   		maxDate:$('#tgl_akhir').val()?newMaxDate:false
		   	});
		 }
	});
	$('#tgl_akhir').datetimepicker({
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
		 	minDate 	= $('#tgl_mulai').val();
		 	arrMinDate 	= minDate.split('/');
		 	newMinDate 	= arrMinDate[2]+'/'+arrMinDate[1]+'/'+arrMinDate[0];
		   	this.setOptions({
		   		minDate:$('#tgl_mulai').val()?newMinDate:false
		   	})
		 }
	});

	$('.mask-number').keydown(function(e){
		 // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
	});

});

function toggleDetailBox(el){
	event.preventDefault();
	$(el).parents('li.pertanyaan').find('.detail-box').slideToggle();
}

function delPertanyaan(el){
	event.preventDefault();
	if (confirm('Anda yakin akan menhapus pertanyaan ini?')){
		$(el).parents('li.pertanyaan').remove();
	}
}

function validate(nik){
	event.preventDefault();
	showLoader();
	var is_validate = true;
	var is_scrolled = false;

	// validate required field
	$('body .required').each(function(){
		$(this).css('border','1px solid #ccc');
		if($(this).next('.validation_msg').length>0 || $(this).parent().next('.validation_msg').length>0){
			$(this).next('.validation_msg').remove();
			$(this).parent().next('.validation_msg').remove();
			$(this).removeClass('not-valid');
		}
		if ($(this).val()=='') {
			$(this).css('border','1px solid rgb(231, 49, 15)');
			$(this).addClass('not-valid');
			if ($(this).parent().hasClass('input-group')) {
				$(this).parent().after('<span class="validation_msg">Masukan tidak boleh kosong!</span>');
			}else{
				$(this).after('<span class="validation_msg">Masukan tidak boleh kosong!</span>');
			}
			if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: $(this).offset().top-100
			    }, 'slow');
			    $(this).focus();
				is_scrolled = true;
			}
			is_validate = false;
		}
	});

	// dont allow char '~' in input pilihan
	$('#form-pertanyaan-tambahan .pilihan-viewable').each(function(){
		if ($(this).val().indexOf('~')>=0) {
			$(this).css('border','1px solid #ccc');
			if($(this).next('.validation_msg').length>0){
				$(this).next('.validation_msg').remove();
				$(this).removeClass('not-valid');
			}
			$(this).css('border','1px solid rgb(231, 49, 15)');
			$(this).addClass('not-valid');
			$(this).after('<span class="validation_msg">Masukan ini tidak boleh mengandung karakter "~"</span>');
			if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: $(this).offset().top-100
			    }, 'slow');
			    $(this).focus();
				is_scrolled = true;
			}
			is_validate = false;
		}
	});

	// check is filter have set
	var has_filter = false;
	$('#form-info .tagsinput').each(function(){
		if($(this).children('span.tag').length > 0){
			has_filter = true;
		}
	}); 
	if (!has_filter){
		/* show message */
		$('#soal-alert').fadeIn(400);
		$('#soal-alert').addClass('alert-danger');
		$('#soal-alert p').html('Anda harus mengisi minimal satu filter (unit, angkatan, matakuliah, dan/atau mahasiswa).');
		if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: 0
			    }, 'slow');
				is_scrolled = true;
			}
		is_validate = false;
		return false;
		hideLoader();
	}

	// check is any list of question there
	if ($('#form-pertanyaan-tambahan #list-pertanyaan li.pertanyaan').length == 0) {
		/* show message */
		$('#soal-alert').fadeIn(400);
		$('#soal-alert').addClass('alert-danger');
		$('#soal-alert p').html('Anda belum menginputkan pertanyaan.');
		if (!is_scrolled) {
				$('html, body').animate({
			        scrollTop: 0
			    }, 'slow');
				is_scrolled = true;
			}
		is_validate = false;
		return false;
		hideLoader();
	}

	if (!is_validate) {
		$('#form-pertanyaan-tambahan .detail-box').each(function(){
			if ($(this).find('textarea.pilihan-viewable').hasClass('not-valid')) {
				$(this).slideDown();
			};
		});
		return false;
		hideLoader();
	}else{
		submitForm(nik);
	}
}

function submitForm(nik){
	var form_type = $('#form_type').val();

	/* --- Grab paket info data --- */
	var items_info 		= {};
	items_info['judul'] = $('#form-info input[name="judul"]').val();
	items_info['mulai'] = $('#form-info input[name="tgl_mulai"]').val();
	items_info['akhir'] = $('#form-info input[name="tgl_akhir"]').val();
	items_info['status']= $('#form-info select[name="status"]').val();
	items_info['nik']	= nik;
	
	var _units 			= '';
	$('#select-unit .tagsinput span.tag').each(function(){
		_units += ($(this).children('span').attr('value'))+',';
	});
	if (_units.substr(_units.length-1)==',') {_units = _units.substr(0,_units.length-1)};

	var _angkatan		= '';
	$('#select-angkatan .tagsinput span.tag').each(function(){
		_angkatan += ($(this).children('span').attr('value'))+',';
	});
	if (_angkatan.substr(_angkatan.length-1)==',') {_angkatan = _angkatan.substr(0,_angkatan.length-1)};
	
	var _kelas 			= '';
	$('#select-kelas .tagsinput span.tag').each(function(){
		_kelas += ($(this).children('span').attr('value'))+',';
	});
	if (_kelas.substr(_kelas.length-1)==',') {_kelas = _kelas.substr(0,_kelas.length-1)};
	
	var _mahasiswa 		= '';
	$('#select-mahasiswa .tagsinput span.tag').each(function(){
		_mahasiswa += ($(this).children('span').attr('value'))+',';
	});
	if (_mahasiswa.substr(_mahasiswa.length-1)==',') {_mahasiswa = _mahasiswa.substr(0,_mahasiswa.length-1)};
	
	items_info['filter_unit'] 		= _units;
	items_info['filter_angkatan'] 	= _angkatan;
	items_info['filter_kelas'] 		= _kelas;
	items_info['filter_mahasiswa'] 	= _mahasiswa;

	items_info['form_type'] = form_type;
	if (form_type=="edit") {
		items_info['edit_id_paket'] = $('#edit_id_paket').val();
	};

	/* --- Grab pertanyaan-tambahan data --- */
	var items_pertanyaan = {};
	$('#form-pertanyaan-tambahan li.pertanyaan').each(function(index){
		items_pertanyaan[index] = {};
		items_pertanyaan[index]['isi_pertanyaan'] 	= $(this).find('.isi_pertanyaan').val();
		items_pertanyaan[index]['jenis'] 			= $(this).find('.jenis').val();
		items_pertanyaan[index]['is_required'] 		= ($(this).find('.is_required').prop('checked'))? "1": "0" ;
		if ($(this).find('.jenis').val()=="single choice" || $(this).find('.jenis').val()=="multiple choice") {
			items_pertanyaan[index]['pilihan'] 			= $(this).find('.pilihan').val();
		}
		else{
			items_pertanyaan[index]['pilihan'] 			= "";	
		}

		if (form_type=="edit") {
			items_pertanyaan[index]['id_pertanyaan'] = $(this).find('#id_pertanyaan').val();
		};
	});

	// Send the AJAX request for info paket
	$.ajax({
	    url : CI_ROOT+"soal/soal_tambahan/save_info",
	    type: "POST",
	    data : items_info,
	    dataType : "JSON",
	    success: function(data, textStatus, jqXHR)
	    {
			if (data.success) {
				var id_paket = '';
				if (form_type=="new") {
					id_paket = data.inserted_id;
				}else{
					id_paket = data.edited_id;
				}
				// Send the AJAX request for list pertanyaan
				$.ajax({
				    url : CI_ROOT+"soal/soal_tambahan/save_pertanyaanTambahan",
				    type: "POST",
				    data : {'form_type':form_type,'id_paket':id_paket,'listPertanyaan':items_pertanyaan},
				    dataType : "JSON",
				    success: function(data2, textStatus2, jqXHR2)
				    {
						/* show message */
						$('#soal-alert').fadeIn(400);
						$('#soal-alert').addClass('alert-success');
						$('#soal-alert p').html('Data berhasil disimpan.');

						$('html,body').animate({ scrollTop: 0 }, 'slow');
				    },
				    error: function (jqXHR, textStatus, errorThrown){
						/* show message */
						$('#soal-alert').fadeIn(400);
						$('#soal-alert').addClass('alert-danger');
						$('#soal-alert p').html('Terjadi kesalahan saat menyimpan data info paket.');

						$('html,body').animate({ scrollTop: 0 });
				    }
				});
			}else{
				/* show message */
				$('#soal-alert').fadeIn(400);
				$('#soal-alert').addClass('alert-danger');
				$('#soal-alert p').html('Terjadi kesalahan saat menyimpan data info paket.');

				$('html,body').animate({ scrollTop: 0 }, 'slow');
			}
	    },
	    error: function (jqXHR, textStatus, errorThrown)
	    {
			// $('#save-info-loading').css('display', 'none');
			// $('#save-info').show();

			/* show message */
			$('#soal-alert').fadeIn(400);
			$('#soal-alert').addClass('alert-danger');
			$('#soal-alert p').html('Terjadi kesalahan saat menyimpan data info paket.');

			$('html,body').animate({ scrollTop: 0 }, 'slow');
	    }
	}).done(function() {
	  	hideLoader();
	});

}

function setPilihan(el){
	var value = $(el).val().split('\n');
	var new_value = '';
	for (var i = 0; i < value.length; i++) {
		new_value += value[i];
		if (i<value.length-1) {new_value += '~'};
	};
	$(el).parents('li.pertanyaan').children('input.pilihan').val(new_value);
}

/* Custom Input Tags */
function delTag(el){
	$(el).parent().remove();
}
function showInput(el){
	event.stopPropagation();
	$(el).hide();
	$(el).parent().find('.input').show();
	$(el).parent().find('.input').val('');
	$(el).parents('.tagsinput').find('.select2-container .select2-choice > .select2-chosen').text('-- Pilih --');
	$(el).parent().find('.input').focus();
}
function hideInput(el){
	$(el).find('span.tambah').show();
	$(el).find('.input').hide();
}
function addTag(val,text,el){
	var is_listed = false;
	$(el).parents('.tagsinput').find('span.tag').each(function(){
		if ($(this).children('span').text().trim() == text.trim()) {is_listed = true;};
	});
	if (is_listed) {
		alert(text+" sudah terdaftar dalam list");
		$(el).parents('.tagsinput').click();
	}else{
		var content = '<span class="tag">\
								<span value="'+val+'">'+text+'&nbsp;&nbsp;\
								</span><a class="hapus" href="javascript:void(0)" title="Hapus" onclick="delTag(this)">x</a>\
							</span>';
		$(el).parents('.addTag').before(content);
		$(el).parent().find('.input').hide();
		$(el).next('.tambah').show();
	}
}

function getDataPaket(){
	var edit_id_paket = $('#edit_id_paket').val();
	$.ajax({
	    url : CI_ROOT+"soal/soal_tambahan/getDataPaket/"+edit_id_paket,
	    type: "GET",
    	dataType : "JSON",
	    success: function(data, textStatus, jqXHR)
	    {
	    	$('#judul').val(data.info.judul);
	    	$('#tgl_mulai').val(data.info.tgl_mulai);
	    	$('#tgl_akhir').val(data.info.tgl_akhir);
	    	$('#status').val(data.info.status);
	    	
	    	for(var i in data.info.unit){
	    		var content = "<span class='tag'><span value='"+data.info.unit[i].id_unit+"'>"+data.info.unit[i].unit+"&nbsp;&nbsp;</span><a class='hapus' href='javascript:void(0)'' title='Hapus' onclick='delTag(this)'>x</a></span>"
	    		$('#select-unit .tagsinput').prepend(content);
	    	}

	    	for(var i in data.info.angkatan){
	    		var content = "<span class='tag'><span value='"+data.info.angkatan[i]+"'>"+data.info.angkatan[i]+"&nbsp;&nbsp;</span><a class='hapus' href='javascript:void(0)'' title='Hapus' onclick='delTag(this)'>x</a></span>"
	    		$('#select-angkatan .tagsinput').prepend(content);
	    	}

	    	for(var i in data.info.kelas){
	    		var content = "<span class='tag'><span value='"+data.info.kelas[i].kode+"'>"+data.info.kelas[i].nama+"&nbsp;&nbsp;</span><a class='hapus' href='javascript:void(0)'' title='Hapus' onclick='delTag(this)'>x</a></span>"
	    		$('#select-kelas .tagsinput').prepend(content);
	    	}

	    	for(var i in data.info.mahasiswa){
	    		var content = "<span class='tag'><span value='"+data.info.mahasiswa[i]+"'>"+data.info.mahasiswa[i]+"&nbsp;&nbsp;</span><a class='hapus' href='javascript:void(0)'' title='Hapus' onclick='delTag(this)'>x</a></span>"
	    		$('#select-mahasiswa .tagsinput').prepend(content);
	    	}

	    	for(var i in data.listPertanyaan){
	    		var content = generateItemPertanyaan(data.listPertanyaan[i].id_pertanyaan,data.listPertanyaan[i].isi_pertanyaan,data.listPertanyaan[i].jenis,data.listPertanyaan[i].required,data.listPertanyaan[i].pilihan);
	    		$('#list-pertanyaan').append(content);

				$('select.jenis').change(function(){
					if ($(this).val()=="single choice" || $(this).val()=="multiple choice") {
						$(this).parents().children('.buttons-set').children('.btn-config').show();
						$(this).parents().children('.detail-box').slideDown();
						$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').focus();
						$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').addClass('required');
					}else{
						$(this).parents().children('.buttons-set').children('.btn-config').hide();
						$(this).parents().children('.detail-box').slideUp();
						$(this).parents().children('.detail-box').find('textarea.pilihan-viewable').removeClass('required');
					}
				});
	    	}
	    },
	    error: function (jqXHR, textStatus, errorThrown)
	    {
			/* show message */
			$('#soal-alert').fadeIn(400);
			$('#soal-alert').addClass('alert-danger');
			$('#soal-alert p').html('Terjadi kesalahan saat mengambil data pertanyaan paket.');

			$('html,body').animate({ scrollTop: 0 }, 'slow');
	    }
	});
}

function generateItemPertanyaan(id_pertanyaan,isi_pertanyaan,jenis,is_required,pilihan){
	var required = (is_required==1)? 'checked' : '';

	var br_pilihan = pilihan.replace(/~/g,'\n');

	var is_text 			= (jenis=="text")? 'selected':'';
	var is_paragraph		= (jenis=="paragraph")? 'selected':'';
	var is_multiple_choice 	= (jenis=="multiple choice")? 'selected':'';
	var is_single_choice 	= (jenis=="single choice")? 'selected':'';
	var is_scale			= (jenis=="scale")? 'selected':'';
	var is_date 			= (jenis=="date")? 'selected':'';
	var is_time				= (jenis=="time")? 'selected':'';
	var is_datetime			= (jenis=="datetime")? 'selected':'';

	var have_edit_btn 		= (jenis=="multiple choice" || jenis=="single choice")? 'style="display:inline-block"':'style="display:none"';


	var content = '<li class="pertanyaan">\
						<div class="col-md-7">\
							<textarea class="form-control isi_pertanyaan required" name="isi_pertanyaan[]" rows="1" placeholder="isi pertanyaan...">'+isi_pertanyaan+'</textarea>\
						</div>\
						<div class="col-md-2">\
							<select name="jenis[]" class="form-control required jenis">\
								<option value="">-- Jenis --</option>\
								<option '+is_text+' value="text">Teks</option>\
								<option '+is_paragraph+' value="paragraph">Paragraf</option>\
								<option '+is_multiple_choice+' value="multiple choice">Pilihan Banyak</option>\
								<option '+is_single_choice+' value="single choice">Pilihan Tunggal</option>\
								<option '+is_scale+' value="scale">Skala</option>\
								<option '+is_date+' value="date">Tanggal</option>\
								<option '+is_time+' value="time">Waktu</option>\
								<option '+is_datetime+' value="datetime">Tanggal &amp; Waktu</option>\
							</select>\
						</div>\
						<div class="col-md-1">\
							<input type="checkbox" name="is_required[]" class="is_required" '+required+'/>\
						</div>\
						<div class="col-md-2 buttons-set last">\
							<button class="btn yellow-bg btn-config" '+have_edit_btn+' onclick="toggleDetailBox(this)"><i class="icon-cog"></i></button>\
							<button class="btn red-bg btn-remove" onclick="delPertanyaan(this)"><i class="icon-trash"></i></button>\
						</div>\
						<input type="hidden" name="pilihan[]" class="pilihan" value="'+pilihan+'"/>\
						<div class="clearfix"></div>\
						<div class="detail-box" style="display:none;">\
							<div class="col-md-2">\
								<label for="pilihan">Pilihan</label>\
								<i class="tooltip-demo"\
		                            data-original-title="Maukkan pilihan untuk jawanban. Satu baris untuk satu pilihan "\
		                            data-placement="right" data-toggle="tooltip" href="#"\
		                            title=""><i class="icon-question-sign"></i></i> \
							</div>\
							<div class="col-md-10">\
								<textarea class="pilihan-viewable" rows="4" cols="30" onchange="setPilihan(this)">'+br_pilihan+'</textarea>\
							</div>\
							<a href="javascript:void(0)" class="hide-detail-box" onclick="toggleDetailBox(this)">Sembunyikan <i class="icon-double-angle-up"></i></a>\
							<div class="clearfix"></div>\
						</div>\
						<input type="hidden" name="id_pertanyaan" id="id_pertanyaan" value="'+id_pertanyaan+'">\
				</li>';
	return content;
}

function showLoader(){
	$('#save-pertanyaan-tambahan').hide();
	$('#save-pertanyaan-loading').show();
}

function hideLoader(){
	$('#save-pertanyaan-tambahan').show();
	$('#save-pertanyaan-loading').hide();
}