<h1>Pertanyaan</h1>

<ul id="number">
	<?php for ($i=1; $i <=12 ; $i++) { 
		echo "<li>$i</li>";
	} ?>
</ul>

<ul id="sortable">
<?php for ($i=1; $i <=12 ; $i++) {?> 
	<li id="pertanyaan<?php echo $i ?>">
		<form role="form">
			<div class="row">
				<div class="col-md-1">
					<strong class="blue-bg btn btn-lg"><?php echo $i ?></strong>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label>Aspek</label>
						<input type="text" class="form-control" onclick="this.focus()">
					</div>
				</div>
				<div class="col-md-8">
					<div class="form-group">
						<label>Pertanyaan</label>
						<textarea class="form-control" onclick="this.focus()">
						</textarea>
					</div>
				</div>
			</div>
		</form>
	</li>
<?php } ?>

</ul>

<div id="tools">
	<button id="save">Save changes</button>
	<img src="http://stuff.dan.cx/common/spinner.gif" id="loading" alt="Loading..." title="Loading..." />
</div>
