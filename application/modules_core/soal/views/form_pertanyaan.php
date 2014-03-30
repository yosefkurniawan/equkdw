<div class="panel colored box-form-pertanyaan">
	<div class="panel-heading green-bg">
		<h3 class="panel-title">Pertanyaan</h3>
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
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label>Aspek</label>
								<select name="aspek" class="form-control">
									<?php foreach ($list_aspek as $aspek) {
										echo "<option value='".$aspek['id_aspek']."'>".$aspek['keterangan']."</option>";
									} ?>
								</select>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label>Pertanyaan</label>
								<textarea class="form-control" name="isi_pertanyaan"></textarea>
							</div>
						</div>
					</div>
				</form>
			</li>
		<?php } ?>
		</ul>

	</div>
	<div class="panel-footer">
		<a href="javascript:void(0)" class="blue-bg btn" id="save-paket">Simpan</a>
		<div id="save-paket-loading">
			<img src="/public/assets/images/spinner.gif" alt="Saving..." title="Saving..." />Saving...
		</div>
	</div>
</div>
