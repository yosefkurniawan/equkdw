<div id="ip_form">

	<div class="page-header">
	    <h1><strong>Konfigurasi IP Dosen</strong><small> &nbsp;&nbsp; <?php echo $periode['thn_ajaran']?> <?php echo $periode['semester']?></small></h1>
	</div>
	<ol class="breadcrumb">
	    <li><a href="<?= base_url() ?>">Dashboard</a></li>
	    <li class="active">Konfigurasi IP Dosen</li>
	</ol>

	<div class="panel-body">
		
		<!-- Periode -->
		<div class="panel section periode">

			<div class="col-md-12">
				<select id="id_paket">
					<?php foreach($paket_list as $item) : ?>
						<option value="<?php echo $item['id_paket']?>" 
							<?php if($item['thn_ajaran'] == $periode['thn_ajaran'] AND $item['semester'] == $periode['semester']  ) : echo "selected"; endif; ?> >
							<?php echo $item['thn_ajaran']?> <?php echo $item['semester']?></option>
					<?php endforeach; ?>
				</select>				
				<br/> Terdapat <strong><?php echo count($kelas_all_check) ?> Kelas </strong> yang Bermasalah (nik dosen tidak dikenali / kelas tidak memiliki pengajar)
				<br/> Terdapat <strong><?php echo count($kelas_all) ?> Kelas </strong> yang Diselenggarakan pada Semester ini (memiliki kuisioner)
				<br/> Terdapat <strong><?php echo count($o2_persenbaik) ?> o2 </strong>
				<br/> Terdapat <strong><?php echo count($o5_data) ?> o5 </strong>
			</div>

		</div>

		 <!-- O1 - Presensi -->
		<form method="post" action="" id="upload_file">		
		<div class="panel section presensi">
			<input type="hidden" id="semesteran" value="<?php echo $periode['semester']?>"/>
			<input type="hidden" id="thnajaran" value="<?php echo $periode['thn_ajaran']?>"/>
			<div class="panel colored col-md-12 form-box">
				<div class="panel-heading red-bg">
					<h4 class="panel-title">
						O1 - Presensi
					</h4>
				</div>
				<div class="panel-body">
					<br/> Terdapat <strong><span id="o1_raw_count"><?php echo count($o1_raw) ?></span> o1 </strong> 
							<a href="#" data-toggle="modal" data-target="#o1_modal" id="o1_modal_show">Lihat Detail</a>
					<br/>
					<br/>
					<br/>
					<div class="row">
					<div class="col-lg-4">
						<label>Rencana Pertemuan</label>
					    <input type="text" id="rencana_pertemuan" name="rencana_pertemuan" class="form-control" value="14">
					</div>
					</div>
					<br/>
					<br/>
					<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
						    <input type="radio" name="methods" value="1" checked> Delete all data then Insert &nbsp;&nbsp;
						    <input type="radio" name="methods" value="0" > Replace If Existing and Insert The Unique Record<br><br>
						</div>
					</div>
					</div>
					<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<label>Upload File CSV Untuk o1 Presensi Dosen</label>
							<input id="userfile" type="file" name="userfile">
						</div>
					</div>
					</div>
			    <div id="files" class="files"></div>
			    <br>
				</div>
				<div class="panel-footer clearfix">
					<button type="submit" id="upload_o1" class="btn btn-success">Upload o1</button> &nbsp; &nbsp;
					<span id="o1_error_message" class="text text-danger"></span>
				</div>
			</div>
		</div>
		</form>

		<!-- O2 - Kuisioner -->
		<!--
		<div class="panel section kuisioner">
			<div class="panel colored col-md-10 form-box">
				<div class="panel-heading gray-bg">
					<h4 class="panel-title">
						O2 - Kuisioner
					</h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" id="form-kuisioner">
						<div class="form-group jml-kelas">
							<div class="col-lg-2"><label>Jumlah kelas</label></div>
							<div class="col-lg-6">
								#
							</div>
						</div>
						<div class="form-group jml-kelas-inputan">
							<div class="col-lg-2"><label>Jumlah kelas inputan</label></div>
							<div class="col-lg-6">
								-
							</div>
						</div>
					</form>
				</div>
			</div>
			<div id="" class="col-md-2 status-box">
				<i class="icon-check"></i>
			</div>
		</div>
		-->

		<!-- O3 - Nilai Lulus -->
		<form method="post" action="" id="upload_file_o3">		
		<div class="panel section kelulusan">
			<input type="hidden" id="semesteran" value="<?php echo $periode['semester']?>"/>
			<input type="hidden" id="thnajaran" value="<?php echo $periode['thn_ajaran']?>"/>
			<div class="panel colored col-md-12 form-box">
				<div class="panel-heading red-bg">
					<h4 class="panel-title">
						O3 - Nilai Kelulusan
					</h4>
				</div>
				<div class="panel-body">
					Terdapat <strong><span id="o3_raw_count"><?php echo count($o3_raw) ?></span> o3 </strong> 
							<a href="#" data-toggle="modal" data-target="#o3_modal" id="o3_modal_show">Lihat Detail</a>
					<br/>
					<br/>

					<div class="row">
						<div class="col-lg-4">
							<label>Prodi</label>
						    <select id="o3-prodi" name="o3-prodi" class="full-width">
						        <?php foreach ($prodi_list as $key => $prodi): ?>
						        	<option value="<?php echo $prodi['prodi'] ?>"><?php echo $prodi['nama_prodi']; ?></option>
						        <?php endforeach ?>
						    </select>
						</div>
					</div>

					<br/>

					<div class="row">
						<!-- upload 1: nilai -->
						<div class="col-lg-6">
							<h4><strong>Upload CSV Nilai</strong></h4>
							<hr/>
							<div class="row">
							<div class="col-lg-10">
								<div class="form-group">
								    <p><input type="radio" name="methods_o3_nilai" value="1" checked> Delete all data then Insert <br/></p>
								    <p><input type="radio" name="methods_o3_nilai" value="0" > Replace If Existing and Insert The Unique Record<br><br></p>
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col-lg-10">
								<div class="form-group">
									<label>Upload File CSV Nilai</label>
									<input id="userfile_o3_nilai" type="file" name="userfile_o3_nilai">
								</div>
							</div>
							</div>
						    <div id="o3_nilai_error_message" class="alert alert-danger fade in" style="display:none;">
								<button data-dismiss="alert" class="close" type="button">×</button>
								<div class="content"></div>
						    </div>
						</div>

					    <!-- upload 2: presensi -->
						<div class="col-lg-6">
							<h4><strong>Upload CSV Presensi</strong></h4>
							<hr/>
							<div class="row">
							<div class="col-lg-10">
								<div class="form-group">
								    <p><input type="radio" name="methods_o3_presensi" value="1" checked> Delete all data then Insert <br/></p>
								    <p><input type="radio" name="methods_o3_presensi" value="0" > Replace If Existing and Insert The Unique Record<br><br></p>
								</div>
							</div>
							</div>
							<div class="row">
							<div class="col-lg-10">
								<div class="form-group">
									<label>Upload File CSV Presensi</label>
									<input id="userfile_o3_presensi" type="file" name="userfile_o3_presensi">
								</div>
							</div>
							</div>

							<div id="o3_presensi_error_message" class="alert alert-danger fade in" style="display:none;">
								<button data-dismiss="alert" class="close" type="button">×</button>
								<div class="content"></div>
						    </div>
						</div>
					</div>
				</div>
				<div class="panel-footer clearfix">
					<button type="submit" id="upload_o3" class="btn btn-success">Upload o3</button> &nbsp; &nbsp;
				</div>
			</div>
		</div>
		</form>
		<!-- <div class="panel section kelulusan">
			<div class="panel colored col-md-12 form-box">
				<div class="panel-heading blue-bg">
					<h4 class="panel-title">
						O3 - Nilai Kelulusan
					</h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" id="form-kelulusan">
						<div class="form-group jml-kelas">
							<div class="col-lg-2"><label>Jumlah kelas</label></div>
							<div class="col-lg-6">
								#
							</div>
						</div>
						<div class="form-group jml-kelas-inputan">
							<div class="col-lg-2"><label>Jumlah kelas inputan</label></div>
							<div class="col-lg-6">
								-
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"><label for="file">Upload file</label></div>
							<div class="col-lg-6">
								<input type="file" name="file" class="col-md-12 styled">
							</div>
						</div>
					</form>
				</div>
				<div class="panel-footer clearfix">
					<div class="form-group">
						<a href="#" class="btn btn-med gray-bg">Simpan</a> 
					</div>
				</div>
			</div>
			<!--
			<div id="" class="col-md-2 status-box">
				<i class="icon-check"></i>
			</div>
			-->
		<!-- </div> --> 
		<!-- O4 - Tepat Waktu -->
		<!--
		<div class="panel section deadline">
			<div class="panel colored col-md-10 form-box">
				<div class="panel-heading gray-bg">
					<h4 class="panel-title">
						O4 - Ketepatan Waktu Penyerahan Berkas
					</h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" id="form-deadline">
						<div class="form-group jml-kelas">
							<div class="col-lg-2"><label>Jumlah kelas</label></div>
							<div class="col-lg-6">
								#
							</div>
						</div>
						<div class="form-group jml-kelas-inputan">
							<div class="col-lg-2"><label>Jumlah kelas inputan</label></div>
							<div class="col-lg-6">
								-
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-2"><label for="periode_semester">Input</label></div>
							<div class="col-lg-6">
                            	<a href="#o4-input-modal" class="btn btn-med gray-bg" data-toggle="modal"><i class="icon-table"></i></a>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div id="" class="col-md-2 status-box">
				<i class="icon-check"></i>
			</div>
		</div>

		<!-- o4 input modal -->		
		<div class="modal fade" id="o4-input-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title"> <strong> <span id="namaMatakuliah"> Input Tanggal Penyerahan Berkas </span> </strong>
		            </div>
		            <div class="modal-body">
		                <div class="panel colored">
		                    <div class="panel-heading blue-bg">
		                        <h3 class="panel-title">Daftar Kelas</h3>
		                    </div>
		                    <div class="panel-body">
		                        <table class="table table-hover" id="tableDaftarKelas">
		                            <thead>
		                                <tr>
		                                    <td width="5%">Kode</td>
		                                    <td width="50%">Matakuliah</td>
		                                    <td width="10%">Grup</td>
		                                    <td width="20%">Dosen</td>
		                                    <td width="15%">Status</td>
		                                </tr>
		                            </thead>
		                            <tbody>
		                            </tbody>
		                        </table>
		                    </div>                  
		                </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn gray-bg" data-dismiss="modal">Close</button>
		                <button type="button" class="btn blue-bg">Simpan</button>
		            </div>
		        </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal --><!-- Modal -->     
	</div>
</div>

<!-- MODAL FOR o1 MANAGEMENT -->
<div class="modal fade bs-example-modal-lg" id="o1_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">o1 Management</h4>
        <small><?php echo $periode['thn_ajaran']; echo $periode['semester']; ?> </small>
      </div>
      <div class="modal-body">
        <table class="table" id="table_o1">
            <thead>
                <tr>
                    <td width="10%" style="font-size:12px;text-align:center" >Id</td>
                    <td width="10%" style="font-size:12px;text-align:center">Kode</td>
                    <td width="25%" style="font-size:12px;">Nama Mtk</td>
                    <td width="5%" style="font-size:12px;text-align:center">Grup</td>
                    <td width="5%" style="font-size:12px;text-align:center">Rencana</td>
                    <td width="5%" style="font-size:12px;text-align:center">Terisi</td>
                    <td width="5%" style="font-size:12px;text-align:center"></td>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url()?>public/js/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url()?>public/js/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url()?>public/js/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>

<script src="<?php echo base_url()?>public/js/plugins/ajaxfileupload.js"></script>


<script>
    jQuery(document).ready(function() { 

    	jQuery('#id_paket').on('change',function(){
    		id_paket = jQuery(this).val();
			window.location.replace(CI_ROOT+'ip/konfigurasi/data/'+id_paket);
    	});
    }); 

</script>

<script>

var url = CI_ROOT+"ip/konfigurasi/upload_o1";


jQuery(function ($) {
    'use strict';
    // Change this to the location of your server-side upload handler:

    /* --------------------------------------------------- */
    /* O1
    /* --------------------------------------------------- */

	jQuery('#upload_file').submit(function(e) {

		document.getElementById('upload_o1').innerHTML = '<i class="icon-spinner icon-spin"></i> Uploading ... ';
		jQuery('#upload_o1').attr('disabled','disabled');

		e.preventDefault();
		$.ajaxFileUpload({
			url 			: url, 
			secureuri		: false,
			fileElementId	:'userfile',
			dataType		:'json',
			data			: {
				'rencana'		: $('#rencana_pertemuan').val(),
				'o1'			: $('#o1_raw_count').text(),
				'method'		: $('input[name="methods"]:checked').val(),
				'semester'		: $('#semesteran').val(),
				'thn_ajaran'	: $('#thnajaran').val()
			},			
			success	: function (data,status)
			{
				if(data.status != 'error')
				{
					// console.log('berhasil');					
					// console.log(data.infox);
					jQuery('#upload_o1').removeAttr('disabled');
					jQuery('#o1_error_message').removeClass('text-danger').addClass('text-success');
				}
				else {
					// console.log('gagal');					
					// console.log(data.infox);					
					jQuery('#upload_o1').removeAttr('disabled');
					jQuery('#o1_error_message').removeClass('text-success').addClass('text-danger');
				}
				document.getElementById('o1_error_message').innerHTML = data.msg;
				document.getElementById('upload_o1').innerHTML = 'Upload o1 ';
				jQuery('#userfile').val('');
				jQuery('#o1_raw_count').text(data.rowCount);
			}
		});			

		return false;
	});

	var kode,grup,tot_hadir,index,nama,rencana,kelasb;
	jQuery('#o1_modal_show').on('click',function(){

		$.ajax({
			url:CI_ROOT+'ip/konfigurasi/get_o1',
			type:"POST",
			data: {
				'semester'		: $('#semesteran').val(),
				'thn_ajaran'	: $('#thnajaran').val()
			},
			success : function(data) {
				// console.log(data);
				jQuery('#table_o1 tbody tr').remove();
				for (index = 0; index < data.length; ++index) {
					kelasb = data[index]['id_kelasb'];
					kode = data[index]['kode'];
					nama = data[index]['nama_mtk'];
					grup = data[index]['grup'];
					rencana = data[index]['rencana'];
					tot_hadir = data[index]['tot_hadir'];
					
					if (tot_hadir == null || rencana == null) {
						jQuery('#table_o1 > tbody:first').append(
							'<tr class="warning">'+
								'<td style="font-size:12px;text-align:center">'+kelasb+'</td>'+
								'<td style="font-size:12px;text-align:center">'+kode+'</td>'+
								'<td style="font-size:12px">'+nama+'</td>'+
								'<td style="font-size:12px;text-align:center">'+grup+'</td>'+
								'<td style="font-size:12px;text-align:center"><span class="rencana-mtk">'+rencana+'</span>'+
								'<input type="text" class="form-control input-sm ubah-rencana-mtk num" value="'+rencana+'" style="display:none"/>'+
								'</td>'+
								'<td style="font-size:12px;text-align:center"><span class="realisasi-mtk">'+tot_hadir+'</span>'+
								'<input type="text" class="form-control input-sm ubah-realisasi-mtk num" value="'+tot_hadir+'" style="display:none"/>'+								
								'</td>'+
								'<td style="font-size:12px">'+
								'<a href="#" class="btn btn-xs btn-info ubah-presensi">Ubah<a>'+
								'<a href="#" class="btn btn-xs btn-info batal-ubah-presensi" style="display:none">Batal<a>'+
								'</td>'+
							'</tr>'
							);						
					} else {
						jQuery('#table_o1 > tbody:first').append(
							'<tr>'+
								'<td style="font-size:12px;text-align:center">'+kelasb+'</td>'+
								'<td style="font-size:12px;text-align:center">'+kode+'</td>'+
								'<td style="font-size:12px">'+nama+'</td>'+
								'<td style="font-size:12px;text-align:center">'+grup+'</td>'+
								'<td style="font-size:12px;text-align:center"><span class="rencana-mtk">'+rencana+'</span>'+
								'<input type="text" class="form-control input-sm ubah-rencana-mtk num" value="'+rencana+'" style="display:none"/>'+
								'</td>'+
								'<td style="font-size:12px;text-align:center"><span class="realisasi-mtk">'+tot_hadir+'</span>'+
								'<input type="text" class="form-control input-sm ubah-realisasi-mtk num" value="'+tot_hadir+'" style="display:none"/>'+								
								'</td>'+
								'<td style="font-size:12px">'+
								'<a href="#" class="btn btn-xs btn-info ubah-presensi">Ubah<a>'+
								'<a href="#" class="btn btn-xs btn-info batal-ubah-presensi" style="display:none">Batal<a>'+
								'</td>'+
							'</tr>'
							);
						
					}

				};
			},
			errors : function(data) {
				console.log(data);
			}
		});
	}); //end of jQuery('#o1_modal_show').on('click',function(){

	jQuery('#table_o1').on('click','tbody tr td a.ubah-presensi',function(){
		if (jQuery(this).closest('tr').find('td span.rencana-mtk').text() == 'null') {
			jQuery(this).closest('tr').find('td input.ubah-rencana-mtk').val(0);			
		} if (jQuery(this).closest('tr').find('td span.realisasi-mtk').text() == 'null') {
			jQuery(this).closest('tr').find('td input.ubah-realisasi-mtk').val(0);
		}
		jQuery(this).closest('tr').find('td span.rencana-mtk').hide();
		jQuery(this).closest('tr').find('td span.realisasi-mtk').hide();
		jQuery(this).closest('tr').find('td input.ubah-rencana-mtk').show();
		jQuery(this).closest('tr').find('td input.ubah-realisasi-mtk').show();
		jQuery(this).closest('tr').find('td a.batal-ubah-presensi').show();
		jQuery(this).text('Simpan').removeClass('ubah-presensi').addClass('simpan-presensi').removeClass('btn-info').addClass('btn-danger');
		return false;
	});

	jQuery('#table_o1').on('click','tbody tr td a.simpan-presensi',function(){
		jQuery(this).closest('tr').find('td span.rencana-mtk').show().text(jQuery(this).closest('tr').find('td input.ubah-rencana-mtk').val());
		jQuery(this).closest('tr').find('td span.realisasi-mtk').show().text(jQuery(this).closest('tr').find('td input.ubah-realisasi-mtk').val());
		jQuery(this).closest('tr').find('td input.ubah-rencana-mtk').hide();
		jQuery(this).closest('tr').find('td input.ubah-realisasi-mtk').hide();
		jQuery(this).closest('tr').find('td a.batal-ubah-presensi').hide();
		jQuery(this).text('Ubah').removeClass('simpan-presensi').addClass('ubah-presensi').removeClass('btn-danger').addClass('btn-info');
		if (jQuery(this).closest('tr').find('td span.realisasi-mtk').text() != 'null' || jQuery(this).closest('tr').find('td span.rencana-mtk').text() != 'null') {
			jQuery(this).closest('tr').removeClass('warning').addClass('success');
		}
		return false;
	});

	jQuery('#table_o1').on('click','tbody tr td a.batal-ubah-presensi',function(){
		jQuery(this).closest('tr').find('td span.rencana-mtk').show();
		jQuery(this).closest('tr').find('td span.realisasi-mtk').show();
		jQuery(this).closest('tr').find('td input.ubah-rencana-mtk').hide();
		jQuery(this).closest('tr').find('td input.ubah-realisasi-mtk').hide();
		jQuery(this).closest('tr').find('td input.ubah-rencana-mtk').val(jQuery(this).closest('tr').find('td span.rencana-mtk').text());
		jQuery(this).closest('tr').find('td input.ubah-realisasi-mtk').val(jQuery(this).closest('tr').find('td span.realisasi-mtk').text());
		jQuery(this).closest('tr').find('td a.simpan-presensi').text('Ubah').removeClass('simpan-presensi').addClass('ubah-presensi')		
		.removeClass('btn-danger').addClass('btn-info');;
		jQuery(this).hide();
		return false;
	});

    jQuery('#table_o1').on('keydown','.num',function (e) {
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

    jQuery('#table_o1').on('blur','.num',function() {
    	$(this).val(parseInt($(this).val(), 10));
    });   	


    /* --------------------------------------------------- */
    /* O3
    /* --------------------------------------------------- */

	jQuery('#upload_file_o3').submit(function(e) {

		/* Description: 
		 * - There will be 2 uploadin proccess.
		 * 		1. upload nilai
		 * 		2. upload presensi
		 * - The 2nd proccess will be done once the 1st one is complete.
		 */
		jQuery('#upload_o3').html('<i class="icon-spinner icon-spin"></i> Uploading ... ');
		jQuery('#upload_o3').attr('disabled','disabled');

		e.preventDefault();

		$.ajaxFileUpload({
			url 			: CI_ROOT+"ip/konfigurasi/upload_o3_nilai", 
			secureuri		: false,
			fileElementId	:'userfile_o3_nilai',
			dataType		:'json',
			data			: {
				'prodi'			: $('#o3-prodi').val(),
				'o3'			: $('#o3_raw_count').text(),
				'method'		: $('input[name="methods_o3_nilai"]:checked').val(),
				'semester'		: $('#semesteran').val(),
				'thn_ajaran'	: $('#thnajaran').val()
			},			
			success	: function (data,status)
			{
				console.log(data);
				console.log(data.msg);
				if(data.status != 'error')
				{
					// console.log('berhasil');					
					// console.log(data.infox);
					// jQuery('#upload_o3').removeAttr('disabled');
					jQuery('#o3_nilai_error_message').removeClass('alert-danger').addClass('alert-success').show();

					// do the 2nd upload.
					upload_o3_presensi();
				}
				else {
					// console.log('gagal');					
					// console.log(data.infox);					
					// jQuery('#upload_o3').removeAttr('disabled');
					jQuery('#upload_o3').removeAttr('disabled');
					jQuery('#o3_nilai_error_message').removeClass('alert-success').addClass('alert-danger').show();
				}
				jQuery('#o3_nilai_error_message .content').html(data.msg);
				// jQuery('#upload_o3').html('Upload o3');
				jQuery('#userfile_o3_nilai').val('');
				jQuery('#o3_raw_count').text(data.rowCount);
			},
			errors: function(data) {
				console.log(data);
			}

		});			

		return false;
	});    

	function upload_o3_presensi() {
		$.ajaxFileUpload({
			url 			: CI_ROOT+"ip/konfigurasi/upload_o3_presensi", 
			secureuri		: false,
			fileElementId	:'userfile_o3_presensi',
			dataType		:'json',
			data			: {
				'prodi'			: $('#o3-prodi').val(),
				'o3'			: $('#o3_raw_count').text(),
				'method'		: $('input[name="methods_o3_presensi"]:checked').val(),
				'semester'		: $('#semesteran').val(),
				'thn_ajaran'	: $('#thnajaran').val()
			},			
			success	: function (data,status)
			{
				console.log(data);
				console.log(data.msg);
				if(data.status != 'error')
				{
					jQuery('#o3_presensi_error_message').removeClass('alert-danger').addClass('alert-success').show();
				}
				else {
					jQuery('#o3_presensi_error_message').removeClass('alert-success').addClass('alert-danger').show();
				}
				jQuery('#o3_presensi_error_message .content').html(data.msg);

				jQuery('#upload_o3').removeAttr('disabled');
				jQuery('#upload_o3').html('Upload o3');
				jQuery('#userfile_o3_presensi').val('');
				jQuery('#o3_raw_count').text(data.rowCount);
			},
			errors: function(data) {
				console.log(data);
			}

		});	
	}


});

</script>