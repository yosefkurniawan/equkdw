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
										if (isset($list_pertanyaan[$i-1]['id_aspek']) && $list_pertanyaan[$i-1]['id_aspek']==$aspek['id_aspek']) 
											$selected = 'selected';
										else
											$selected = '';
										echo "<option value='".$aspek['id_aspek']."' $selected>".$aspek['keterangan']."</option>";
									} ?>
								</select>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label>Pertanyaan</label>
								<textarea class="form-control isi_pertanyaan" name="isi_pertanyaan"><?=(isset($list_pertanyaan[$i-1]['isi_pertanyaan']))? $list_pertanyaan[$i-1]['isi_pertanyaan'] : '' ?></textarea>
								<span class="pertanyaan-error-notif"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Keterangan</label>
								<textarea rows="1" class="form-control keterangan" name="keterangan"><?=(isset($list_pertanyaan[$i-1]['keterangan']))? $list_pertanyaan[$i-1]['keterangan'] : '' ?></textarea>
							</div>
						</div>
					</div>
				</form>
			</li>
		<?php } ?>
		</ul>

	</div>
	<?php if ($form_type != "view"): ?>
		<div class="panel-footer">
			<a href="javascript:void(0)" class="blue-bg btn" id="save-pertanyaan">Simpan</a>
			<div id="save-pertanyaan-loading">
				<img src="<?=base_url() ?>public/assets/images/spinner.gif" alt="Menyimpan..." title="Menyimpan..." />Menyimpan...
			</div>
		</div>
	<?php endif ?>
</div>
