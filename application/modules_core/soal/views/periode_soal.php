<div class="page-header">
	<h1>Periode &amp; Soal</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li class="active">Periode &amp; Soal</li>
</ol>

<?php if ($allowCreateNew): ?>
	<a href="<?=base_url() ?>soal/baru" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Buat Paket Baru</a>
<?php endif ?>

<table class="metro-table">
	<thead>
	  <tr>
	    <td width="64%">Periode</td>
	    <td width="32%">Status</td>
	    <td width="4%">Action</td>
	    <!-- <td class="hidden-xs">Category</td> -->
	  </tr>
	</thead>
	<tbody>
		<?php foreach ($list_paket as $paket): ?>
		  <tr>
		    <td><?php echo strtoupper($paket['semester']).' '.$paket['thn_ajaran'] ?></td>
		    <td><?php echo strtoupper($paket['status']) ?></td>
		    <?php if (strtoupper($paket['status']) == 'DRAFT'): ?>
		    	<td><a href="soal/edit/<?php echo $paket['id_paket'] ?>" class="btn btn-med yellow-bg"><i class="icon-">&#xf0ad;</i></a>
		    		<a href="javascript:void(0)?>" onclick="delPaket(<?= $paket['id_paket'] ?>)" class="btn btn-med red-bg"><i class="icon-trash"></i></a></td>
		    <?php else: ?>
		    	<td><a href="soal/view/<?php echo $paket['id_paket'] ?>" class="btn btn-med green-bg"><i class="icon-eye-open"></i></a></td>
		    <?php endif ?>
		  </tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
	  <tr>
	    <td colspan="2">
	      <?php echo $this->pagination->create_links(); ?>
	  	</td>
	  </tr>
	</tfoot>
</table>