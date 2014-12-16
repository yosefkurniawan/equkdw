<?php
  (isset($active) && empty($active))? $active = '': $active=$active;
?>

<div class="slimScrollDiv">
  <aside id="left_panel">
    <nav id="aside_nav">
      <ul>
        <li <?= ($active=='rangkuman evaluasi')? 'class="active"':'' ?>><a href="<?= base_url().'laporan/rangkuman_evaluasi' ?>">Rangkuman Evaluasi<span>BARU</span></a></li>
        <li <?= ($active=='hasil evaluasi')? 'class="active"':'' ?>><a href="<?= base_url().'laporan/hasil_evaluasi' ?>">Hasil Evaluasi</a></li>
        <li <?= ($active=='status pengisian')? 'class="active"':'' ?>><a href="<?= base_url().'laporan/status_pengisian' ?>">Monitoring by Mahasiswa <span>BARU</span></a>
          </li>
        <li <?= ($active=='matakuliah')? 'class="active"':'' ?>><a href="<?= base_url().'laporan/matakuliah' ?>">Monitoring by Matakuliah<span>BARU</span></a></li>
      </ul>
    </nav>
  </aside>
</div>