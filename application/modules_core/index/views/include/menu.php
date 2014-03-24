<ul class="menu">
	<?php if ($this->session->userdata['is_super_admin']): ?>
	<li>
		Super Admin
		<ul>
			<li><a href="#">Hak Akses</a></li>
			<li><a href="#">Login As</a></li>
		</ul>
	</li>
	<?php endif ?>
	<?php if ($this->session->userdata['is_admin']): ?>
	<li>
		Admin
		<ul>
			<li><a href="#">Periode dan Soal</a></li>
			<li><a href="#">Laporan</a></li>
		</ul>
	</li>
	<?php endif ?>
	<?php if ($this->session->userdata['status'] == 'Dosen'): ?>
	<li>
		Dosen
		<ul>
			<li><a href="#">lorem</a></li>
			<li><a href="#">lorem As</a></li>
		</ul>
	</li>
	<?php endif ?>
	<?php if ($this->session->userdata['status'] == 'Mahasiswa'): ?>
	<li>
		Mahasiswa
		<ul>
			<li><a href="#">lorem</a></li>
			<li><a href="#">lorem</a></li>
		</ul>
	</li>
	<?php endif ?>
	<li><a href="http://www.ukdw.ac.id/portal/mahasiswa/universitas">Kembali ke portal UKDW</a></li>
</ul>