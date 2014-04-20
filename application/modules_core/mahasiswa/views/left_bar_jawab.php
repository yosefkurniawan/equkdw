<aside id="left_panel" class="soal-left-bar">
  <div class="container-fluid">
    <h4>Dosen Pengampu</h4>
    <ul id="nav">
    <?php $x = 1; ?>
	<?php foreach ($list_dosen as $dosen): ?>
      <li id="nav-dosen-<?=$x?>"><?=$dosen->nama_dosen?></li>
    <?php $x = $x + 1; ?>
  <?php endforeach ?>
    </ul>
  </div>
</aside>