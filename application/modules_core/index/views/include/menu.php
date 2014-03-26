<!-- VERTICAL NAVBAR -->
<nav id="main_topnav">
  <div class="container-fluid"><a href="javascript:;" class="pull-left toggle-aside"><i class="icon-">&#xf0a9; </i></a><a href="javascript:;" class="pull-right toggle-topmenu">
  	<i class="icon-">&#xf0c9; </i></a>
    <ul>
	<?php if ($this->session->userdata['is_super_admin']): ?>
	<li>
		Super Admin
		<ul>
			<li><a href="superadmin">Hak Akses</a></li>
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
	<?php if ($this->session->userdata['is_kepala_unit'] || $this->session->userdata['status'] == 'Dosen'): ?>
	<li>Other
		<ul>
			<li><a href="#">Buat Kuisioner Tambahan</a></li>
		</ul>
	</li>
	<?php endif ?>
	<?php if ($this->session->userdata['status'] == 'Dosen'): ?>
	<li>
		Dosen
		<ul>
			<li><a href="#">lorem</a></li>
			<li><a href="#">lorem</a></li>
		</ul>
	</li>
	<?php endif ?>
	<?php if ($this->session->userdata['status'] == 'Mahasiswa'): ?>
			<li><a href="#" title="Dashboard" ><i class="icon-">&#xf0ac;</i>Dashboard</a></li>
	<?php endif ?>
    </ul>
  </div>
</nav>




<!--TOP NAV ENDS-->
<!-- 
<ul class="menu">
      <li><a href="#" title="Dashboard"><i class="icon-">&#xf0ac;</i> Dashboard</a></li>
      <li><a href="#" title="UI Elements"><i class="icon-">&#xf02e;</i> UI Elements</a></li>
      <li><a href="#" title="Form Stuff"><i class="icon-">&#xf02d;</i> Form Stuff</a></li>
      <li><a href="#" title="Plugins"><i class="icon-">&#xf085;</i> Plugins</a></li>
      <li><a href="#" title="Data Tables"><i class="icon-">&#xf0c9;</i> Data Tables</a></li>
      <li><a href="#" title="Additional"><i class="icon-">&#xf07c;</i> Additional</a></li>
</ul>
 -->