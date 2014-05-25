<div class="page-header">
	<h1>
		Hasil Evaluasi
		<small>Periode <?= $periode['semester'].' - '.$periode['thn_ajaran'] ?></small>
	</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
	<li class="active">Hasil Evaluasi</li>
</ol>

<div class="alert fade in" id="notif-box">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<p></p>
</div>

<a data-toggle="modal" href="#modal-setPeriode" class='btn btn-med blue-bg' title='Ubah periode'><i class='icon-calendar'></i> Ubah Periode</a>
<div class="modal fade" id="modal-setPeriode" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<form id="form-setPeriode">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h4 class="modal-title">Atur Periode</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-3">
							<label for="semester">Semester</label>
						</div>
						<div class="col-md-6">
							<select class="form-control" name="semester">
								<option value="GASAL" <?= (strtoupper($periode['semester'])=='GASAL')? 'selected': '' ?>>GASAL</option>
								<option value="GENAP" <?= (strtoupper($periode['semester'])=='GENAP')? 'selected': '' ?>>GENAP</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-md-3">
							<label for="thn_ajaran">Tahun Ajaran</label>
						</div>
						<div class="col-md-6">
							<select class="form-control" name="thn_ajaran">
							<?php
								$tahun = $last_periode->thn_ajaran;
								for ($i=1; $i <=10 ; $i++) {
									$tahun_exp = explode('/', $tahun);
									$new_thn_awal = (int)$tahun_exp[0]-1;
									$new_thn_akhir= (int)$tahun_exp[1]-1;
									$tahun = $new_thn_awal.'/'.$new_thn_akhir;
									if ($tahun == $periode['thn_ajaran']) {
										$selected = 'selected';
									}
									else{
										$selected = '';
									}
									echo "<option value='$tahun' $selected>$tahun</option>";
								}
							?>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn gray-bg btn-close" data-dismiss="modal">Kembali</button>
					<button type="button" class="btn blue-bg btn-submit">Simpan</button>
					<div class="loading" style="display:none;">
						<img src="<?=base_url() ?>public/assets/images/spinner.gif" alt="Menyimpan..." title="Menyimpan..." />Menyimpan...
					</div>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</form>
</div>
<div class="panel-body">
	<div class="panel-group" id="accordion">
		<div class="panel colored" id="list_prodi">
			<?php foreach ($listDosenByProdi as $key => $prodi): ?>
			<div class="panel-heading green-bg">
				<h4 class="panel-title">
					<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $key ?>"><?= $prodi['unit'] ?></a>
				</h4>
			</div>
			<div id="collapse<?= $key ?>" class="panel-collapse collapse" style="height: 0px;">
				<div class="panel-body">
					<ul class="list_dosen list-unstyled">
						<?php foreach ($prodi['listDosen'] as $dosen): ?>
							<li class="col-md-4">
								<a href="<?= base_url().'laporan/hasil_evaluasi_dosen/'.$dosen['nik'] ?>"><?= $dosen['gelar_prefix'].$dosen['nama'].$dosen['gelar_suffix'] ?></a>
							</li>
						<?php endforeach ?>
					</ul>
					<?php echo $btn_print[$prodi['id_unit']]; ?>
				</div>
			</div>
			<?php endforeach ?>
		</div>
	</div>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#form-setPeriode .btn-submit').click(function(){
			var items 		= $('#form-setPeriode').serialize();
			
			$('#form-setPeriode .modal-footer button').hide();
			$('#form-setPeriode .loading').show();

			// Send the AJAX request
			$.ajax({
			    url : CI_ROOT+"laporan/setPeriode",
			    type: "POST",
			    data : items,
			    success: function(data, textStatus, jqXHR)
			    {
			    	/* change periode on header */
			    	$('.page-header h1 small').text('Periode '+$('#form-setPeriode select[name="semester"]').val()+' - '+$('#form-setPeriode select[name="thn_ajaran"]').val());

					/* hide modal*/
					$('#form-setPeriode .btn-close').click();

					/* show message */
					$('#notif-box').fadeIn(400);
					$('#notif-box').addClass('alert-success');
					$('#notif-box p').html('Periode berhasil diubah.');
		
					$('#form-setPeriode .modal-footer button').show();
					$('#form-setPeriode .loading').hide();

			    },
			    error: function (jqXHR, textStatus, errorThrown)
			    {
			    	console.log(jqXHR);
			    	console.log(textStatus);
			    	console.log(errorThrown);
					/* hide modal*/
					$('#form-setPeriode .btn-close').click();

					/* show message */
					$('#notif-box').fadeIn(400);
					$('#notif-box').addClass('alert-danger');
					$('#notif-box p').html('Terjadi kesalahan.');

					$('#form-setPeriode .modal-footer button').show();
					$('#form-setPeriode .loading').hide();

			    }
			});
		});
	});
</script>