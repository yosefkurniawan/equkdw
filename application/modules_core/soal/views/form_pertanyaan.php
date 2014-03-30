<div class="panel colored" id="box-form-pertanyaan">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Susunan Pertanyaan</h3>
	</div>
	<div class="panel-body">
		<ul id="number">
			<?php for ($i=1; $i <=12 ; $i++) { 
				echo "<li><span>$i</span></li>";
			} ?>
		</ul>

		<ul class="sortable" id="list-pertanyaan">
		<?php for ($i=1; $i <=12 ; $i++) {?> 
			<li id="pertanyaan<?php echo $i ?>">
				<form role="form">
					<input type="hidden" value="<?= $kode ?>" name="id_paket" class="id_paket">
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Aspek</label>
								<select name="aspek" class="form-control aspek">
									<?php foreach ($list_aspek as $aspek) {
										echo "<option value='".$aspek['id_aspek']."'>".$aspek['keterangan']."</option>";
									} ?>
								</select>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label>Pertanyaan</label>
								<textarea class="form-control isi_pertanyaan" name="isi_pertanyaan"></textarea>
							</div>
						</div>
					</div>
				</form>
			</li>
		<?php } ?>
		</ul>

	</div>
	<div class="panel-footer">
		<a href="javascript:void(0)" class="blue-bg btn" id="save-pertanyaan">Simpan</a>
		<div id="save-pertanyaan-loading">
			<img src="<?=base_url() ?>public/assets/images/spinner.gif" alt="Menyimpan..." title="Menyimpan..." />Menyimpan...
		</div>
	</div>
</div>
