<div class="page-header">
	<h1>
		Hasil Evaluasi
		<small>Periode <?= $periode['semester'].' - '.$periode['thn_ajaran'] ?> &nbsp; <a href="" id="change-period"> <i class="icon-cog"></i></a> &nbsp;
		<input type="hidden" id="nik" value="<?php echo $dosen->nik?>" />
		
		<select id="id_paket" style="width:160px;display:none">
			<?php foreach($paket_list as $item) : ?>
				<option value="<?php echo $item['id_paket']?>">
					<?php echo $item['thn_ajaran']?> <?php echo $item['semester']?></option>
			<?php endforeach; ?>
		</select>
		&nbsp;&nbsp;<a href="#" id="change_period_process" style="display:none"><i class='icon-save'> </i></a>
		&nbsp;&nbsp;<a href="#" id="tutup_period_form" style="display:none"><i class='icon-remove'> </i></a>
		</small> 
	<div class="pull-right">
		<?php if ($admin == 'ya') : ?>
			<a href="<?php echo base_url() ?>laporan/pdf_hasil_evaluasi_dosen/<?php echo $dosen->nik?>
					<?php if ($id_paket != '') : echo '/'.$id_paket; endif; ?>" 
					class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Cetak</a>		
			<a href="<?php echo base_url() ?>laporan/hasil_evaluasi
					<?php if ($id_paket != '') : echo '/'.$id_paket; endif; ?>" 
			 class="btn btn-danger"><i class='icon-undo'> </i>Kembali</a>
		<?php else : ?>
			<a href="<?php echo base_url() ?>laporan/dosen/pdf_hasil_evaluasi_dosen/<?php echo $dosen->nik?>
					<?php if ($id_paket != '') : echo '/'.$id_paket; endif; ?>" 
					class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Cetak</a>		
		<?php endif; ?>		
	</div>
		
	</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li class="active">Laporan</li>
	<li><a href="<?= base_url().'laporan/dosen/hasil_evaluasi/'.$dosen->nik ?>">Hasil Evaluasi</a></li>
	<li class="active"><?= $dosen->nama ?></li>
</ol>

<h4>Dosen : <?= $dosen->gelar_prefix.$dosen->nama.$dosen->gelar_suffix ?> / <?= $dosen->nik ?> &nbsp;&nbsp;&nbsp;</h4>

<!-- Hasil evaluasi kelas -->
<div class="panel colored">
	<div class="panel-heading green-bg"><h3 class="panel-title">Hasil kuisioner kelas</h3></div>
	<div class="panel-body table-responsive">
		<table class="table table-hover" id="hasil-evaluasi-dosen">
			<thead>
				<tr>
					<td colspan='6'></td>
					<td colspan='12' class="grup-pertanyaan">Index Atas Kuisioner 1 s/d 12</td>
				</tr>
				<tr>
					<th>Kode</th>
					<th>Matakuliah</th>
					<th>Kuisioner</th>
					<th>Grup</th>
					<th>Terisi</th>
					<th>Pengisi</th>
					<th>% Baik</th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[0]->pertanyaan))?$pertanyaan[0]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q1</i> </th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[1]->pertanyaan))?$pertanyaan[1]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q2</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[2]->pertanyaan))?$pertanyaan[2]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q3</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[3]->pertanyaan))?$pertanyaan[3]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q4</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[4]->pertanyaan))?$pertanyaan[4]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q5</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[5]->pertanyaan))?$pertanyaan[5]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q6</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[6]->pertanyaan))?$pertanyaan[6]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q7</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[7]->pertanyaan))?$pertanyaan[7]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q8</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[8]->pertanyaan))?$pertanyaan[8]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q9</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[9]->pertanyaan))?$pertanyaan[9]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q10</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[10]->pertanyaan))?$pertanyaan[10]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q11</i> </th></th>
					<th><i class="tooltip-demo"
	                            data-original-title="<?=(isset($pertanyaan[11]->pertanyaan))?$pertanyaan[11]->pertanyaan:''?>"
	                            data-placement="left" data-toggle="tooltip" href="#"
	                            title="">Q12</i> </th></th>
				</tr>
			</thead>
			<tbody>
				<?php if (empty($hasil_evaluasi)): ?>
					<tr><td colspan="18" class="center"><span class="italic">Belum ada hasil evaluasi</span></td></tr>
				<?php endif ?>
				<?php foreach ($hasil_evaluasi as $key => $hasil): ?>
					<tr>
						<td><?= $hasil['kode'] ?></td>
						<td><?= $hasil['nama'] ?></td>
						<td><span class="label <?php 
							if ($hasil['status_kuisioner'] == 'Ada') : echo "label-success"; 
							elseif ($hasil['status_kuisioner'] == 'Ada Tidak Wajib') : echo "label-info"; 
							else : echo 'label-danger'; 
							endif; ?>
							">
							<?= $hasil['status_kuisioner'] ?></span></td>
						<td><?= $hasil['grup'] ?></td>
						<td><?= $hasil['terisi'] ?></td>
						<td><?= $hasil['pengisi'] ?></td>
						<td><?= $hasil['baik'] ?></td>
						<td><?= $hasil['Q1'] ?></td>
						<td><?= $hasil['Q2'] ?></td>
						<td><?= $hasil['Q3'] ?></td>
						<td><?= $hasil['Q4'] ?></td>
						<td><?= $hasil['Q5'] ?></td>
						<td><?= $hasil['Q6'] ?></td>
						<td><?= $hasil['Q7'] ?></td>
						<td><?= $hasil['Q8'] ?></td>
						<td><?= $hasil['Q9'] ?></td>
						<td><?= $hasil['Q10'] ?></td>
						<td><?= $hasil['Q11'] ?></td>
						<td><?= $hasil['Q12'] ?></td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Masukan Dosen -->
<div class="panel colored">
	<div class="panel-heading green-bg"><h3 class="panel-title">Masukan Untuk Dosen</h3></div>
	<div class="panel-body">
		<dl>
			<?php foreach ($hasil_evaluasi as $key => $value): ?>
				<dt><?= $value['nama'] ?></dt>
				<dd><?= $value['masukan_dosen'] ?></dd>
			<?php endforeach ?>
		</dl>
	</div>
</div>

<!-- Masukan Matkul -->
<div class="panel colored">
	<div class="panel-heading green-bg"><h3 class="panel-title">Masukan Untuk Matakuliah</h3></div>
	<div class="panel-body">
		<dl>
			<?php foreach ($hasil_evaluasi as $key => $value): ?>
				<dt><?= $value['nama'] ?></dt>
				<dd><?= $value['masukan_matkul'] ?></dd>
			<?php endforeach ?>
		</dl>
	</div>
</div>

<script>
	CI_ROOT = "<?php echo base_url() ?>";

    jQuery(document).ready(function() {   
		jQuery('#change-period').on('click',function(){
			jQuery('#id_paket').show();
			jQuery('#change_period_process').show();
			jQuery('#tutup_period_form').show();
			return false;
		});	    
		jQuery('#tutup_period_form').on('click',function(){
			jQuery(this).hide();
			jQuery('#change_period_process').hide();
			jQuery('#id_paket').hide();
			return false;
		});	    
		jQuery('#change_period_process').on('click',function(){
			var nik = jQuery('#nik').val();
			var id_paket = jQuery('#id_paket').val();
			var admin = jQuery('#isAdmin').val();
			if (admin == 'tidak') {			
				window.location.replace(CI_ROOT+'laporan/dosen/hasil_evaluasi/'+nik+'/'+id_paket);
			} else {			
				window.location.replace(CI_ROOT+'laporan/hasil_evaluasi_dosen/'+nik+'/'+id_paket);			
			}
			return false;
		});	    
    });
    
</script>
