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
							<a href="#" data-toggle="modal" data-target="#o1_modal" id="o1_modal_show">Lihat Detail</a>&nbsp;|&nbsp;
							<a href="<?php echo base_url() ?>ip/konfigurasi/get_excel_o1/35">Download Excel</a>
					<br/>
					<br/>
					<br/>
					<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<b>Penggunaan Template</b><br>
						    <input type="radio" name="methodsTerisi" value="1" checked> Template Excel dari Foxpro
						    	<i class="tooltip-demo"
	                            data-original-title="Semua rencana pertemuan pada data yang diupload akan diisi dengan nilai dibawah
	                            ...... template ini diambil dari tabel foxpro"
	                            data-placement="right" data-toggle="tooltip" href="#"
	                            title=""><i class="icon-question-sign"></i></i> 	
	                        <br>					    
						    <input type="radio" name="methodsTerisi" value="0" > Template Excel dari Sistem
						    	<i class="tooltip-demo"
	                            data-original-title="Semua rencana pertemuan pada data yang diupload sesuai dengan yang diisikan pada kolom rencana, apabila ada kolom rencana yang dikosongkan maka akan diisi dengan nilai dibawah"
	                            data-placement="right" data-toggle="tooltip" href="#"
	                            title=""><i class="icon-question-sign"></i></i> 						    
						</div>
						<br/>
						<label>Rencana Pertemuan</label>
					    <input type="text" id="rencana_pertemuan" name="rencana_pertemuan" class="form-control" value="14">
					</div>
					</div>
					<br/>
					<br/>
					<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							<b>Metode pengisian data</b><br>
						    <input type="radio" name="methods" value="1" checked> Delete all + Insert 
						    	<i class="tooltip-demo"
	                            data-original-title="Semua data pada tahun ajaran yang dipilih akan dihapus, kemudian diisi dengan data yang diunggah"
	                            data-placement="right" data-toggle="tooltip" href="#"
	                            title=""><i class="icon-question-sign"></i></i> 
						     &nbsp;&nbsp; <br>
						    <input type="radio" name="methods" value="0" > Replace Existing + Insert 
						    	<i class="tooltip-demo"
	                            data-original-title="Data pertemuan pada matakuliah yang sudah ada akan diperbarui, sedangkan data baru akan ditambahkan"
	                            data-placement="right" data-toggle="tooltip" href="#"
	                            title=""><i class="icon-question-sign"></i></i> 
						</div>
					</div>
					</div>
					<br><br>
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
					<div id="o3_nilai_error_message" class="alert alert-danger fade in" style="display:none;">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<div class="content"></div>
				    </div>
					<div id="o3_presensi_error_message" class="alert alert-danger fade in" style="display:none;">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<div class="content"></div>
				    </div>
				    <div id="o3_olah_error_message" class="alert alert-danger fade in" style="display:none;">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<div class="content"></div>
				    </div>

					<div class="row">
						<div class="col-lg-4">
							<label>Prodi</label>
						    <select id="o3-prodi" name="o3-prodi" class="full-width">
						        <option value="">-- Pilih Prodi --</option>
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
							<div id="o3_nilai_error_message" class="alert alert-warning">
								<strong>Catatan:</strong>
								<p>Format CSV: nim, kode, sks, harga, grup, nilai, semester, dan thn ajaran</p>
								<p>Format nama file: khs_[prodi]. Misal: khs_23.csv</p>
							</div>
							<div class="row">

							<?php /* disable mode since updating mode need more extra time */ ?>
							<input type="hidden" name="methods_o3_nilai" value="1"> 
							<!-- <div class="col-lg-10">
								<div class="form-group">
									<label>Mode:</label>
								    <p><input type="radio" name="methods_o3_nilai" value="1" checked> Delete all data then Insert <br/></p>
								    <p><input type="radio" name="methods_o3_nilai" value="0" > Replace If Existing and Insert The Unique Record<br><br></p>
								</div>
							</div> -->
							</div>
							<div class="row">
							<div class="col-lg-10">
								<div class="form-group">
									<label>Pilih File:</label>
									<input id="userfile_o3_nilai" type="file" name="userfile_o3_nilai">
								</div>
							</div>
							</div>
						</div>

					    <!-- upload 2: presensi -->
						<div class="col-lg-6">
							<h4><strong>Upload CSV Presensi</strong></h4>
							<hr/>
							<div id="o3_nilai_error_message" class="alert alert-warning">
								<strong>Catatan:</strong>
								<p>Format CSV: nim, kode, grup, absen, semester, dan thn ajaran.</p>
								<p>Format nama file: kehadiran_[prodi]. Misal: kehadiran_23.csv</p>
							</div>
							<div class="row">

							<?php /* disable mode since updating mode need more extra time */ ?>
							<input type="hidden" name="methods_o3_presensi" value="1"> 
							<!-- <div class="col-lg-10">
								<div class="form-group">
									<label>Mode:</label>
								    <p><input type="radio" name="methods_o3_presensi" value="1" checked> Delete all data then Insert <br/></p>
								    <p><input type="radio" name="methods_o3_presensi" value="0" > Replace If Existing and Insert The Unique Record<br><br></p>
								</div>
							</div> -->
							</div>
							<div class="row">
							<div class="col-lg-10">
								<div class="form-group">
									<label>Pilih File:</label>
									<input id="userfile_o3_presensi" type="file" name="userfile_o3_presensi">
								</div>
							</div>
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
      	<input type="text" id="keyword-o1" class="form-control" placeholder="kata kunci pencarian"></input> <br/>
      	<!-- <a id="keyword-o1-btn" class="btn btn-info">Cari</a> -->
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

<!-- MODAL FOR o3 MANAGEMENT -->
<div class="modal fade bs-example-modal-lg" id="o3_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Daftar Prodi yang Telah Diinputkan </h4>
        <small><?php echo $periode['thn_ajaran']; echo $periode['semester']; ?> </small>
      </div>
      <div class="modal-body">
        <table class="table" id="table_o3_insertedProdi">
            <thead>
                <tr>
                    <td width="10%" style="font-size:12px;text-align:center" >Kode</td>
                    <td width="10%" style="font-size:12px;text-align:center">Nama Prodi</td>
                    <td width="10%" style="font-size:12px;text-align:center">Total Baris</td>
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

<!-- uploading popup -->
<div id="popup-uploading" class="popup">
	<div class="background"></div>
	<div class="content">
		<div style="margin-bottom:10px; text-align:center;"><i class="icon-spinner icon-spin"></i></div>
		<p class="alert alert-warning">Proses dapat memakan beberapa menit. Mohon bersabar.</p>
		<p><strong>Status:</strong></p>
		<ul class="status">
			<li class="uploadnilai">
				Mengupload data KHS...<span class="done">(Selesai)</span>
			</li>
			<li class="uploadpresensi">
				Mengupload data kehadiran...<span class="done">(Selesai)</span>
			</li>
			<li class="mengolah">
				Mengolah data KHS dan kehadiran...<span class="done">(Selesai)</span>
			</li>
		</ul>
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
				'methodTerisi'	: $('input[name="methodsTerisi"]:checked').val(),
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

	var kode,grup,tot_hadir,index,nama,rencana,kelasb,prodi;
	var kodebaru='',kodelama='',grupbaru='',gruplama='';
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
					prodi = data[index]['prodi'];
					
					kodebaru = data[index]['kode'];
					grupbaru = data[index]['grup'];
					if (tot_hadir == null || rencana == null) {
						jQuery('#table_o1 > tbody:first').append(
							'<tr class="warning">'+
								'<td style="font-size:12px;text-align:center">'+kelasb+'</td>'+
								'<td class="o1-kode" style="font-size:12px;text-align:center">'+kode+'</td>'+
								'<td style="font-size:12px"><span class="nama-mtk">'+nama+'</span></td>'+
								'<td class="o1-grup" style="font-size:12px;text-align:center">'+grup+'</td>'+
								'<td style="font-size:12px;text-align:center"><span class="rencana-mtk">'+rencana+'</span>'+
								'<input type="text" class="form-control input-sm ubah-rencana-mtk num" value="'+rencana+'" style="display:none"/>'+
								'</td>'+
								'<td style="font-size:12px;text-align:center"><span class="realisasi-mtk">'+tot_hadir+'</span>'+
								'<input type="text" class="form-control input-sm ubah-realisasi-mtk num" value="'+tot_hadir+'" style="display:none"/>'+								
								'</td>'+
								'<td style="font-size:12px">'+
								'<a href="#" class="btn btn-xs btn-info ubah-presensi">Ubah<a>'+
								'<a href="#" class="btn btn-xs btn-info batal-ubah-presensi" style="display:none">Batal<a>'+
								'<a href="#" class="btn btn-xs btn-danger hapus-ubah-presensi" style="display:none">Hapus<a>'+
								'</td>'+
							'</tr>'
							);						
					} else {
						if (kodelama == kodebaru && gruplama == grupbaru) {
							jQuery('#table_o1 > tbody:first').append(
									'<tr class="danger">'+
										'<td style="font-size:12px;text-align:center">'+kelasb+'</td>'+
										'<td class="o1-kode" style="font-size:12px;text-align:center">'+kode+'</td>'+
										'<td style="font-size:12px"><span class="nama-mtk">'+nama+'</span> <span class="info-prodi">('+prodi+')</span></td>'+
										'<td class="o1-grup" style="font-size:12px;text-align:center">'+grup+'</td>'+
										'<td style="font-size:12px;text-align:center"><span class="rencana-mtk">'+rencana+'</span>'+
										'<input type="text" class="form-control input-sm ubah-rencana-mtk num" value="'+rencana+'" style="display:none"/>'+
										'</td>'+
										'<td style="font-size:12px;text-align:center"><span class="realisasi-mtk">'+tot_hadir+'</span>'+
										'<input type="text" class="form-control input-sm ubah-realisasi-mtk num" value="'+tot_hadir+'" style="display:none"/>'+								
										'</td>'+
										'<td style="font-size:12px">'+
										'<a href="#" class="btn btn-xs btn-info ubah-presensi">Ubah<a>'+
										'<a href="#" class="btn btn-xs btn-info batal-ubah-presensi" style="display:none">Batal<a>'+
										'<a href="#" class="btn btn-xs btn-danger hapus-ubah-presensi" style="display:none">Hapus<a>'+
										'</td>'+
									'</tr>'
									);
						} else {
							jQuery('#table_o1 > tbody:first').append(
								'<tr>'+
									'<td style="font-size:12px;text-align:center">'+kelasb+'</td>'+
									'<td class="o1-kode" style="font-size:12px;text-align:center">'+kode+'</td>'+
									'<td style="font-size:12px"><span class="nama-mtk">'+nama+'</span> <span class="info-prodi">('+prodi+')</span></td>'+
									'<td class="o1-grup" style="font-size:12px;text-align:center">'+grup+'</td>'+
									'<td style="font-size:12px;text-align:center"><span class="rencana-mtk">'+rencana+'</span>'+
									'<input type="text" class="form-control input-sm ubah-rencana-mtk num" value="'+rencana+'" style="display:none"/>'+
									'</td>'+
									'<td style="font-size:12px;text-align:center"><span class="realisasi-mtk">'+tot_hadir+'</span>'+
									'<input type="text" class="form-control input-sm ubah-realisasi-mtk num" value="'+tot_hadir+'" style="display:none"/>'+								
									'</td>'+
									'<td style="font-size:12px">'+
									'<a href="#" class="btn btn-xs btn-info ubah-presensi">Ubah<a>'+
									'<a href="#" class="btn btn-xs btn-info batal-ubah-presensi" style="display:none">Batal<a>'+
									'<a href="#" class="btn btn-xs btn-danger hapus-ubah-presensi" style="display:none">Hapus<a>'+
									'</td>'+
								'</tr>'
								);
						}

					}
					kodelama = kodebaru;
					gruplama = grupbaru;

				};
			},
			errors : function(data) {
				console.log(data);
			}
		});
	}); //end of jQuery('#o1_modal_show').on('click',function(){

	jQuery('#table_o1').on('click','tbody tr td a.ubah-presensi',function(){
		if (jQuery(this).closest('tr').find('td.o1-kode').text() == jQuery(this).closest('tr').next().find('td.o1-kode').text()
			&& jQuery(this).closest('tr').find('td.o1-grup').text() == jQuery(this).closest('tr').next().find('td.o1-grup').text()) 
		{
			console.log('duplikat');
			jQuery(this).closest('tr').find('td a.hapus-ubah-presensi').show();
		} else if (jQuery(this).closest('tr').find('td.o1-kode').text() == jQuery(this).closest('tr').prev().find('td.o1-kode').text()
			&& jQuery(this).closest('tr').find('td.o1-grup').text() == jQuery(this).closest('tr').prev().find('td.o1-grup').text()) 
		{
			console.log('duplikat');
			jQuery(this).closest('tr').find('td a.hapus-ubah-presensi').show();
		}

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
		jQuery(this).text('Simpan').removeClass('ubah-presensi').addClass('simpan-presensi').removeClass('btn-info').addClass('btn-success');
		return false;
	});

	var dethis;
	jQuery('#table_o1').on('click','tbody tr td a.simpan-presensi',function(){

		dethis = jQuery(this);

		var item = {};
		var num = 1;
		item[num] = {};
		item[num]['kode'] = jQuery(this).closest('tr').find('td.o1-kode').text();
		item[num]['grup'] = jQuery(this).closest('tr').find('td.o1-grup').text();
		item[num]['tot_hadir'] = jQuery(this).closest('tr').find('td input.ubah-realisasi-mtk').val();
		item[num]['rencana'] = jQuery(this).closest('tr').find('td input.ubah-rencana-mtk').val();
		item[num]['semester'] = $('#semesteran').val();
		item[num]['th_ajaran'] = $('#thnajaran').val();
		// console.log(item[num]);
		// return false;
		//simpan
		$.ajax({
			url:CI_ROOT+'ip/konfigurasi/save_input_sistem_o1',
			type:"POST",
			data:item,
			success : function(data) {

				console.log(data);

				if (data == true) {

					dethis.closest('tr').find('td span.rencana-mtk').show().text(dethis.closest('tr').find('td input.ubah-rencana-mtk').val());
					dethis.closest('tr').find('td span.realisasi-mtk').show().text(dethis.closest('tr').find('td input.ubah-realisasi-mtk').val());
					dethis.closest('tr').find('td input.ubah-rencana-mtk').hide();
					dethis.closest('tr').find('td input.ubah-realisasi-mtk').hide();
					dethis.closest('tr').find('td a.batal-ubah-presensi').hide();
					dethis.text('Ubah').removeClass('simpan-presensi').addClass('ubah-presensi').removeClass('btn-success').addClass('btn-info');
					if (dethis.closest('tr').find('td span.realisasi-mtk').text() != 'null' || jQuery(this).closest('tr').find('td span.rencana-mtk').text() != 'null') {
						dethis.closest('tr').removeClass('warning').addClass('success');
					}	

				} else {
					console.log('something has gone wrong');
				}

			},
			errors : function(data) {
				console.log(data);
			}
		});

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
		.removeClass('btn-success').addClass('btn-info');;
		jQuery(this).hide();
		return false;
	});

	jQuery('#table_o1').on('click','tbody tr td a.hapus-ubah-presensi',function(){



		dethis = jQuery(this);

		var item = {};
		var num = 1;
		item[num] = {};		
		item[num]['kode'] = jQuery(this).closest('tr').find('td.o1-kode').text();
		item[num]['grup'] = jQuery(this).closest('tr').find('td.o1-grup').text();
		item[num]['semester'] = $('#semesteran').val();
		item[num]['th_ajaran'] = $('#thnajaran').val();


		$.ajax({
			url:CI_ROOT+'ip/konfigurasi/hapus_sistem_o1',
			type:"POST",
			data:item,
			success : function(data) {
				console.log(data);

				if (data == true) {
					dethis.closest('tr').fadeOut(800, function(){
						dethis.closest('tr').remove();	
					});
				} else {
					console.log('something has gone wrong');
				}

			},
			errors : function(data) {
				console.log(data);
			}
		});		
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
		 * - There will be 2 uploading proccess.
		 * 		1. upload nilai
		 * 		2. upload presensi
		 * - The 2nd proccess will be done once the 1st one is complete.
		 */
		
		e.preventDefault();

		// upload status
		var uploadNilaiComplete 	= false;
		var uploadPresensiComplete 	= false;

		// hide all message 
		$('#o3_presensi_error_message').hide();
		$('#o3_nilai_error_message').hide();
		$('#o3_olah_error_message').hide();

		// start: validation

		if($('select#o3-prodi').val() == "") {
			alert('Silakan pilih prodi terlebih dahulu.');
			return false;
		}
		if($('#userfile_o3_nilai').val() == '' || $('#userfile_o3_presensi').val() == ''){
			alert('Input file CSV nilai dan presensi wajib diisi.');
			return false;
		}else {
			var fileNameNilai 		= $('#userfile_o3_nilai').val().replace(/^.*[\\\/]/, '').split('.')[0];
			var fileNamePresensi 	= $('#userfile_o3_presensi').val().replace(/^.*[\\\/]/, '').split('.')[0];
			var prodiNilai			= fileNameNilai.substr(4,fileNameNilai.length);
			var prodiPresensi		= fileNamePresensi.substr(10,fileNamePresensi.length);

			if (prodiNilai != prodiPresensi) {
				alert('Format penamaan file tidak tepat. Pastikan pula file yang diinputkan untuk data prodi yang sama.');
				return false;
			};
		}
		// end: validation

		jQuery('#upload_o3').html('<i class="icon-spinner icon-spin"></i> Uploading ... ');
		jQuery('#upload_o3').attr('disabled','disabled');
		
		// show uploading popup 
		jQuery('#popup-uploading').show();

		// upload nilai
		$.ajaxFileUpload({
			url 			: CI_ROOT+"ip/konfigurasi/upload_o3_nilai", 
			secureuri		: false,
			fileElementId	:'userfile_o3_nilai',
			dataType		:'json',
			data			: {
				'prodi'			: $('#o3-prodi').val(),
				'o3'			: $('#o3_raw_count').text(),
				'method'		: $('input[name="methods_o3_nilai"]').val(),
				'semester'		: $('#semesteran').val(),
				'thn_ajaran'	: $('#thnajaran').val()
			},			
			success	: function (data,status)
			{
				if(data.status != 'error')
				{
					jQuery('#o3_nilai_error_message').removeClass('alert-danger').addClass('alert-success').show();
					jQuery('#popup-uploading .content .status .uploadnilai').addClass('text-success');
					jQuery('#popup-uploading .content .status .uploadnilai .done').show();
				}
				else {
					jQuery('#o3_nilai_error_message').removeClass('alert-success').addClass('alert-danger').show();
					jQuery('#popup-uploading .content .status .uploadnilai').addClass('text-danger');
				}
				jQuery('#o3_nilai_error_message .content').html(data.msg);
				jQuery('#userfile_o3_nilai').val('');
			},
			errors: function(data) {
				console.log(data);
			},
			complete: function() {
				uploadNilaiComplete = true;
			}

		});			

		// upload presensi
		$.ajaxFileUpload({
			url 			: CI_ROOT+"ip/konfigurasi/upload_o3_presensi", 
			secureuri		: false,
			fileElementId	:'userfile_o3_presensi',
			dataType		:'json',
			data			: {
				'prodi'			: $('#o3-prodi').val(),
				'o3'			: $('#o3_raw_count').text(),
				'method'		: $('input[name="methods_o3_presensi"]').val(),
				'semester'		: $('#semesteran').val(),
				'thn_ajaran'	: $('#thnajaran').val()
			},			
			success	: function (data,status)
			{
				if(data.status != 'error')
				{
					jQuery('#o3_presensi_error_message').removeClass('alert-danger').addClass('alert-success').show();
					jQuery('#popup-uploading .content .status .uploadpresensi').addClass('text-success');
					jQuery('#popup-uploading .content .status .uploadpresensi .done').show();
				}
				else {
					jQuery('#o3_presensi_error_message').removeClass('alert-success').addClass('alert-danger').show();
					jQuery('#popup-uploading .content .status .uploadpresensi').addClass('text-danger');
				}
				jQuery('#o3_presensi_error_message .content').html(data.msg);
				jQuery('#userfile_o3_presensi').val('');
			},
			errors: function(data) {
				console.log(data);
			},
			complete: function() {
				uploadPresensiComplete = true;
			}

		});	
	
		jQuery(document).ajaxStop(function() {

			if (uploadPresensiComplete && uploadNilaiComplete) {
				
				// change loading status as 'saving'
				jQuery('#popup-uploading .content .status .mengolah').show();

				// olah data
				$.ajax({
					url 			: CI_ROOT+"ip/konfigurasi/o3_olah",
					dataType		:'json',
					data			: {
						'o3'			: $('#o3_raw_count').text(),
						'semester'		: $('#semesteran').val(),
						'thn_ajaran'	: $('#thnajaran').val(),
					},			
					success	: function (data,status)
					{
						if(data.status != 'error')
						{
							jQuery('#o3_olah_error_message').removeClass('alert-danger').addClass('alert-success').show();
						}
						else {
							jQuery('#o3_olah_error_message').removeClass('alert-success').addClass('alert-danger').show();
						}
						jQuery('#o3_olah_error_message .content').html(data.msg);
						
						jQuery('#o3_raw_count').text(data.rowCount);
						jQuery('#upload_o3').removeAttr('disabled');
						jQuery('#upload_o3').html('Upload o3');
						jQuery('#o3-prodi').val("");
					},
					errors: function(data) {
						console.log(data);
					},
					complete: function() {
						uploadPresensiComplete = false;
						uploadNilaiComplete = false;
						
						jQuery('#popup-uploading .content .status .uploadpresensi').removeClass('text-success text-danger');
						jQuery('#popup-uploading .content .status .uploadnilai').removeClass('text-success text-danger');
						jQuery('#popup-uploading .content .status .uploadnilai .done').hide();
						jQuery('#popup-uploading .content .status .uploadpresensi .done').hide();
						jQuery('#popup-uploading').delay(1000).hide();

						// scroll to result msg
						$('html,body').animate({
				        	scrollTop: $("#upload_file_o3").offset().top},
				        'slow');

					}
				});
			}
		});

		return false;
	}); 

	jQuery('#o3_modal_show').on('click',function(){
		$.ajax({
			url:CI_ROOT+'ip/konfigurasi/get_o3_insertedProdi',
			type:"POST",
			data: {
				'semester'		: $('#semesteran').val(),
				'thn_ajaran'	: $('#thnajaran').val()
			},
			success : function(data) {
				jQuery('#table_o3_insertedProdi tbody tr').remove();

				data = JSON.parse(data);
				jQuery.each(data, function() {
				  	jQuery('#table_o3_insertedProdi > tbody:first').append(
					'<tr>'+
						'<td style="font-size:12px;text-align:center">'+this.prodi+'</td>'+
						'<td style="font-size:12px;text-align:center">'+this.nama_prodi+'</td>'+
						'<td style="font-size:12px;text-align:center">'+this.total_row+'</td>'+
					'</tr>'
					);	
				});
			},
			errors : function(data) {
				console.log(data);
			}
		});
	});

	var keyword;
	var recent;
	// jQuery('#keyword-o1-btn').on('click',function(){
	jQuery('#keyword-o1').on('keyup',function(){
		keyword = jQuery('#keyword-o1').val().toLowerCase();

		console.log(jQuery(this).val());
		if (keyword == "") {
			jQuery('#table_o1 tbody tr').each(function(){
				jQuery(this).show();								
			});
			return false;
		}

		jQuery('#table_o1 tbody tr').each(function(){
			recent = jQuery(this).find('td span.nama-mtk').text().toLowerCase();;
			// console.log(recent);
			// console.log(recent.indexOf(keyword));
			if (recent.indexOf(keyword) > -1) {
				jQuery(this).show();								
			} else {
				jQuery(this).hide();				
			}
		});
		return false;

	});

});

</script>