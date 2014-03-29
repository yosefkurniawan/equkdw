<!-- VERTICAL NAVBAR -->
<nav id="main_topnav">
  <div class="container-fluid"><a href="javascript:;" class="pull-left toggle-aside"><i class="icon-">&#xf0a9; </i></a><a href="javascript:;" class="pull-right toggle-topmenu">
  	<i class="icon-">&#xf0c9; </i></a>
    <ul>
	<?php if ($this->session->userdata['is_super_admin']): ?>
			<li><a href="/privilege" title="Hak Akses" >Hak Akses</a></li>
			<li><a href="/loginas" title="Login As" >Login As</a></li>
	<?php endif ?>
	<?php if ($this->session->userdata['is_admin']): ?>
			<li><a href="/soal" title="Periode dan Soal" >Periode dan Soal</a></li>
			<li><a href="/laporan" title="Laporan" >Laporan</a></li>
	<?php endif ?>
	<?php if ($this->session->userdata['is_kepala_unit'] || ($this->session->userdata['status'] == 'Dosen')) :?>
			<li><a href="/laporan" title="Laporan" >Laporan</a></li>
			<li><a href="/kuisioner" title="Kuisioner" >Kuisioner</a></li>
	<?php endif ?>
	<?php if ($this->session->userdata['status'] == 'Mahasiswa'): ?>
			<li><a href="<?=base_url()?>mahasiswa/dashboard" title="Dashboard" ><i class="icon-">&#xf0ac;</i>Dashboard</a></li>
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