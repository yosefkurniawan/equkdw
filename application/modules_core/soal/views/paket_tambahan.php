<div class="page-header">
	<h1>Kuisioner</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li class="active">Kuisioner</li>
</ol>

<div class="alert fade in <?php echo $this->session->flashdata('message_class'); ?>" id="soal-alert" <?php echo ($this->session->flashdata('message_class'))? 'style="display:block"':''; ?>>
	<button data-dismiss="alert" class="close" type="button">×</button>
	<p><?php echo $this->session->flashdata('message'); ?></p>
</div>

<a href="<?=base_url() ?>soal/soal_tambahan/baru" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Buat Paket Baru</a>

<table class="metro-table">
	<thead>
	  <tr>
	    <td width="40%">Judul</td>
	    <td width="20%">Mulai</td>
	    <td width="20%">Akhir</td>
	    <td width="10%">Status</td>
	    <td width="10%">Action</td>
	  </tr>
	</thead>
	<tbody>
	<?php if (count($list_paket)>0): ?>
		<?php foreach ($list_paket as $paket): ?>
		  <tr>
		    <td><?php echo $paket['judul'] ?></td>
		    <td><?php echo $paket['tgl_mulai'] ?></td>
		    <td><?php echo $paket['tgl_akhir'] ?></td>
		    <td><?php echo $paket['status'] ?></td>
		    <td>
		    	<?php if (strtoupper($paket['status']) == 'DRAFT'): ?>
			    	<td><a href="<?=base_url() ?>soal/soal_tambahan/edit/<?php echo $paket['id_paket'] ?>" class="btn btn-med yellow-bg"><i class="icon-">&#xf0ad;</i></a>
			    		<a href="<?=base_url() ?>soal/soal_tambahan/delete/<?php echo $paket['id_paket'] ?>" onclick="return confirm('Anda yakin ingin menghapus paket?')" class="btn btn-med red-bg"><i class="icon-trash"></i></a></td>
			    <?php else: ?>
			    	<td><a href="<?=base_url() ?>soal/soal_tambahan/view/<?php echo $paket['id_paket'] ?>" class="btn btn-med green-bg"><i class="icon-eye-open"></i></a></td>
			    <?php endif ?>
		    </td>
		  </tr>
		<?php endforeach ?>
	<?php else: ?>
		<tr><td colspan="5" class="italic center no-border"> Anda belum memiliki paket</td></tr>
	<?php endif ?>
	</tbody>
	<tfoot>
	  <tr>
	    <td colspan="2">
	      <!-- <?php echo $this->pagination->create_links(); ?> -->
	  	</td>
	  </tr>
	</tfoot>
</table>