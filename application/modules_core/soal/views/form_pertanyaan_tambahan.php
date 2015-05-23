<div class="page-header">
	<h1>Kuisioner</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li><a href="<?= base_url() ?>soal/soal_tambahan">Kuisioner</a></li>
	<li class="active">Buat Baru</li>
</ol>

<div class="alert fade in" id="soal-alert">
	<button data-dismiss="alert" class="close" type="button">×</button>
	<p></p>
</div>

<input type="hidden" id="form_type" value="<?php echo $form_type; ?>">
<?php if ($form_type=="edit"): ?>
<input type="hidden" id="edit_id_paket" value="<?php echo $id_paket; ?>">
<?php endif ?>

<!-- Form Info -->
<div class="panel colored" id="box-form-info-paket">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Pengaturan Paket</h3>
	</div>
	<form role="form" id="form-info" method="POST">
	<div class="panel-body">
		<div class="row">
			<div class="col-md-2"><label>Judul</label></div>
			<div class="col-md-10">
				<input type="text" class="form-control judul required" name="judul" id="judul" placeholder="Judul">
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><label>Masa Berlaku</label></div>
			<div class="col-md-3">
				<div class="input-group">
					<input type="text" class="form-control tgl_mulai required" name="tgl_mulai" id="tgl_mulai" placeholder="Awal">
					<span class="input-group-addon  accordion-toggle">
						<i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i>
					</span>
				</div>
			</div>
			<div class="col-md-3">
				<div class="input-group">
					<input type="text" class="form-control tgl_akhir required" name="tgl_akhir" id="tgl_akhir" placeholder="Akhir">
					<span class="input-group-addon  accordion-toggle">
						<i data-time-icon="icon-time" data-date-icon="icon-calendar" class="icon-calendar"></i>
					</span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><label>Unit</label></div>
			<div class="col-md-10">
				<div id="select-unit">
					<div class="tagsinput col-lg-12" style="min-height: 100px; height: 100%;">
						<div class="addTag">
							<select name="unit[]" style="display:none" class="input select2">
								<option value="">-- Pilih --</option>
								<?php foreach ($listUnit as $value): ?>
									<option value="<?=$value['id_unit'] ?>"><?=$value['unit'] ?></option>
								<?php endforeach ?>
							</select>
							<span class="tambah">Tambah...</span>
						</div>
						<div class="tags_clear">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><label>Angkatan</label></div>
			<div class="col-md-10">
				<div id="select-angkatan">
					<div class="tagsinput col-lg-12" style="min-height: 100px; height: 100%;">
						<div class="addTag">
							<input name="angkatan[]" value="" class="input mask-number" data-default="add a tag" style="color: rgb(102, 102, 102); width: 68px;display:none;" maxlength="4">
							<span class="tambah">Tambah...</span>
						</div>
						<div class="tags_clear">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><label>Kelas</label></div>
			<div class="col-md-10">
				<div id="select-kelas">
					<div class="tagsinput col-lg-12" style="min-height: 100px; height: 100%;">
						<div class="addTag">
							<select name="kelas[]" style="display:none" class="input select2">
								<option value="">-- Pilih --</option>
								<?php foreach ($listMatkul as $matkul): ?>
									<option value="<?= $matkul['kode'] ?>"><?= $matkul['kode'] ?>-<?= $matkul['nama'] ?></option>
								<?php endforeach ?>
							</select>
							<span class="tambah">Tambah...</span>
						</div>
						<div class="tags_clear">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2"><label>Mahasiswa</label></div>
			<div class="col-md-10">
				<div id="select-mahasiswa">
					<div class="tagsinput col-lg-12" style="min-height: 100px; height: 100%;">
						<div class="addTag">
							<input name="mahasiswa[]" value="" class="input mask-number" data-default="add a tag" style="color: rgb(102, 102, 102); width: 68px;display:none;" maxlength="8">
							<span class="tambah">Tambah...</span>
						</div>
						<div class="tags_clear">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<label for="status">Status</label>
			</div>
			<div class="col-md-3">
				<select class="form-control" name="status" id="status">
					<option value="draft">DRAFT</option>
					<option value="public">PUBLIC</option>
				</select>
			</div>
		</div>
	</div>
	</form>
</div>

<!-- Form Pertanyaan -->
<div class="panel colored">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Susunan Pertanyaan</h3>
	</div>
	<form role="form" id="form-pertanyaan-tambahan" method="POST">
	<div class="panel-body">
		<div class="labels-set">
			<div class="col-md-7">Isi Pertanyaan</div>
			<div class="col-md-2">Jenis</div>
			<div class="col-md-1">Harus diisi</div>
			<div class="col-md-2 buttons-set last">Opsi</div>
		</div>
			<ul class="sortable col-md-12" id="list-pertanyaan">
				<!-- <li class="pertanyaan">
						<div class="col-md-7">
							<textarea class="form-control isi_pertanyaan required" name="isi_pertanyaan[]" rows="1" placeholder="isi pertanyaan..."></textarea>
						</div>
						<div class="col-md-2">
							<select name="jenis[]" class="form-control required jenis">
								<option value="">-- Jenis --</option>
								<option value="text">Teks</option>
								<option value="paragraph">Paragraf</option>
								<option value="multiple choice">Pilihan Banyak</option>
								<option value="single choice">Pilihan Tunggal</option>
								<option value="scale">Skala</option>
								<option value="date">Tanggal</option>
								<option value="time">Waktu</option>
								<option value="datetime">Tanggal &amp; Waktu</option>
							</select>
						</div>
						<div class="col-md-1">
							<input type="checkbox" name="is_required[]" class="is_required" checked/>
						</div>
						<div class="col-md-2 buttons-set last">
							<button class="btn yellow-bg btn-config" style="display:none;" onclick="toggleDetailBox(this)"><i class="icon-cog"></i></button>
							<button class="btn red-bg btn-remove" onclick="delPertanyaan(this)"><i class="icon-trash"></i></button>
						</div>
						<input type="hidden" name="pilihan[]" class="pilihan"/>
						<div class="clearfix"></div>
						<div class="detail-box" style="display:none;">
							<div class="col-md-2">
								<label for="pilihan">Pilihan</label>
								<i class="tooltip-demo"
		                            data-original-title="Maukkan pilihan untuk jawanban. Satu baris untuk satu pilihan "
		                            data-placement="right" data-toggle="tooltip" href="#"
		                            title=""><i class="icon-question-sign"></i></i> 
							</div>
							<div class="col-md-10">
								<textarea class="pilihan-viewable" rows="4" cols="30" onchange="setPilihan(this)"></textarea>
							</div>
							<a href="javascript:void(0)" class="hide-detail-box" onclick="toggleDetailBox(this)">Sembunyikan <i class="icon-double-angle-up"></i></a>
							<div class="clearfix"></div>
						</div>
				</li> -->
			</ul>
			<a href="javascript:void(0)" class="link-tambah-pertanyaan"><i class="icon-plus"></i> Tambah Pertanyaan...</a>
	</div>

	<div class="panel-footer">
		<button type="sybmit" class="blue-bg btn" id="save-pertanyaan-tambahan" onclick="validate(<?php print_r($this->session->userdata('username')); ?>)">Simpan</button>
		<div id="save-pertanyaan-loading">
			<img src="<?=base_url() ?>public/assets/images/spinner.gif" alt="Menyimpan..." title="Menyimpan..." />Menyimpan...
		</div>
	</div>
	</form>
</div>
