<h1>Periode dan Soal</h1>

<a href="/soal/baru" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Buat Paket Baru</a>

<table class="metro-table">
	<thead>
	  <tr>
	    <td width="32%">Kode</td>
	    <td width="32%">Periode</td>
	    <td width="32%">Status</td>
	    <td width="4%">Action</td>
	    <!-- <td class="hidden-xs">Category</td> -->
	  </tr>
	</thead>
	<tbody>
		<?php foreach ($list_paket as $paket): ?>
		  <tr>
		    <td><?php echo $paket['id_paket'] ?></td>
		    <td><?php echo strtoupper($paket['semester']).' '.$paket['thn_ajaran'] ?></td>
		    <td><?php echo strtoupper($paket['status']) ?></td>
		    <td><a href="soal/edit/<?php echo $paket['id_paket'] ?>" class="btn btn-med yellow-bg"><i class="icon-">&#xf0ad;</i></a></td>
		  </tr>
		<?php endforeach ?>
	</tbody>
	<tfoot>
	  <tr>
	    <td colspan="4"><ul class="pagination pull-right hidden-xs">
	        <li><a href="#"><i class="icon-">&#xf104;</i></a></li>
	        <li><a href="#">1</a></li>
	        <li><a href="#">2</a></li>
	        <li><a href="#">3</a></li>
	        <li><a href="#">4</a></li>
	        <li>...</li>
	        <li><a href="#">17</a></li>
	        <li><a href="#"><i class="icon-">&#xf105;</i></a></li>
	      </ul></td>
	  </tr>
	</tfoot>
</table>