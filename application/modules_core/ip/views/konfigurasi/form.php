<div id="ip_form">

	<div class="page-header">
	    <h1><strong>Konfigurasi IP Dosen</strong></h1>
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
						<option value="<?php echo $item['id_paket']?>">
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
		<div class="panel section presensi">
			<div class="panel colored col-md-10 form-box">
				<div class="panel-heading red-bg">
					<h4 class="panel-title">
						O1 - Presensi
					</h4>
				</div>
				<div class="panel-body">
			    <br>
			    <br>
			    <!-- The global progress bar -->
			    <div id="progress" class="progress" style="display:none">
			        <div class="progress-bar progress-bar-success"></div>
			    </div>
			    <!-- The container for the uploaded files -->
			    <div id="files" class="files"></div>

				</div>
				<div class="panel-footer clearfix">
			    <span class="btn btn-success fileinput-button">
			        <i class="icon icon-plus"></i>
			        <span>Upload File CSV Untuk o1 Presensi Dosen</span>
			        <!-- The file input field used as target for the file upload widget -->
			        <input id="fileupload" type="file" name="userfile">
			    </span>
				</div>
			</div>
			<div id="" class="col-md-2 status-box">
				<i class="icon-check"></i>
			</div>
		</div>

		<!-- O2 - Kuisioner -->
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

		<!-- O3 - Nilai Lulus -->
		<div class="panel section kelulusan">
			<div class="panel colored col-md-10 form-box">
				<div class="panel-heading gray-bg">
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
			<div id="" class="col-md-2 status-box">
				<i class="icon-check"></i>
			</div>
		</div>

		<!-- O4 - Tepat Waktu -->
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

		<!-- O5 - eClass -->
		<div class="panel section eclass">
			<div class="panel colored col-md-10 form-box">
				<div class="panel-heading gray-bg">
					<h4 class="panel-title">
						O5 - eClass
					</h4>
				</div>
				<div class="panel-body">
					<form class="form-horizontal" id="form-eclass">
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

	</div>
</div>



<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url() ?>public/js/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!-- <script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> -->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url() ?>public/js/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url() ?>public/js/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
<!-- The File Upload validation plugin -->
<!-- <script src="<?php echo base_url() ?>public/js/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script> -->


<script>
    jQuery(document).ready(function() { 

    	jQuery('#id_paket').on('change',function(){
    		id_paket = jQuery(this).val();
			window.location.replace(CI_ROOT+'ip/konfigurasi/data/'+id_paket);
    	});

    }); 

</script>

<script>
/*jslint unparam: true */
/*global window, $ */
jQuery(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = CI_ROOT+"ip/konfigurasi/upload_o1";

    jQuery('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: true,
        acceptFileTypes: /(\.|\/)(csv)$/i,
        // maxFileSize: 10000000, // 10 MB
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            jQuery('#progress').show();
            jQuery('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        done: function (e, data) {
			// data.context.text('Upload finished.');        	
            // jQuery.each(data.result.files, function (index, file) {
            //     $('<p/>').text(file.name).appendTo('#files');
            // });
            console.log(data);
            alert('berhasil');
            jQuery('#progress').hide();
            jQuery('#progress .progress-bar').css(
                'width',
                '0%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>