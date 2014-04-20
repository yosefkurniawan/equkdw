<?php
  (isset($active) && empty($active))? $active = '': $active=$active;
?>

<div class="slimScrollDiv">
  <aside id="left_panel">
    <nav id="aside_nav">
      <ul>
        <li <?= ($active=='hasil evaluasi')? 'class="active"':'' ?>><a href="<?= base_url().'laporan/hasil_evaluasi' ?>">Hasil Evaluasi</a></li>
        <li <?= ($active=='laporan umum')? 'class="active"':'' ?>><a href="<?= base_url().'laporan/umum' ?>">Laporan Umum</a></li>
      </ul>
    </nav>
  </aside>
</div>