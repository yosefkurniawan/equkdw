
        <!-- rata-rata prodi p1 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o1 = 0 ?>
        <?php if ( count($prodi_o1) > 0 ) : ?>
        <?php foreach ($prodi_o1 as $pro_o1) : ?>
            
            <?php $pp1 = 0 ; ?>
            <?php if ($pro_o1->persen_hadir > 90) : ?>
                <?php $pp1 = 4 ; ?>
            <?php elseif ($pro_o1->persen_hadir <= 90 AND $pro_o1->persen_hadir > 80) : ?>
                <?php $pp1 = 3 ; ?>
            <?php elseif ($pro_o1->persen_hadir <= 80) : ?>
                <?php $pp1 = 2 ; ?>
            <?php endif ?>
        <?php $jmlh_prodi_o1 = $jmlh_prodi_o1 + $pp1 ?>

        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_prodi_o1 = round($jmlh_prodi_o1 / count($prodi_o1),2) ?>

        <?php else: ?>
            <?php $avg_prodi_o1 = 2 ?>
        <?php endif; ?>
        
        <!-- rata-rata prodi p2 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o2 = 0 ?>
        <?php if ( count($prodi_o2) > 0 ) : ?>
        <?php foreach ($prodi_o2 as $pro_o2) : ?>
            
            <?php $pp2 = 0 ; ?>
            <?php if ($pro_o2->baik > 90) : ?>
                <?php $pp2 = 4 ; ?>
            <?php elseif ($pro_o2->baik <= 90 AND $pro_o2->baik > 80) : ?>
                <?php $pp2 = 3 ; ?>
            <?php elseif ($pro_o2->baik <= 80) : ?>
                <?php $pp2 = 2 ; ?>
            <?php endif ?>
        <?php $jmlh_prodi_o2 = $jmlh_prodi_o2 + $pp2 ?>

        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_prodi_o2 = round($jmlh_prodi_o2 / count($prodi_o2),2) ?>
        <?php else: ?>
        <?php $avg_prodi_o2 = 2 ?>
        <?php endif; ?>

        <!-- rata-rata prodi p3 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o3 = 0 ?>
        <?php if ( count($prodi_o3) > 0 ) : ?>

        <?php foreach ($prodi_o3 as $pro_o3) : ?>            
            <?php $pp3 = 0 ; ?>
            <?php if ($pro_o3->persen_lulus > 60) : ?>
                <?php $pp3 = 4 ; ?>
            <?php elseif ($pro_o3->persen_lulus <= 60 AND $pro_o3->persen_lulus > 50) : ?>
                <?php $pp3 = 3 ; ?>
            <?php elseif ($pro_o3->persen_lulus <= 50) : ?>
                <?php $pp3 = 2 ; ?>
            <?php endif ?>
        <?php $jmlh_prodi_o3 = $jmlh_prodi_o3 + $pp3 ?>

        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_prodi_o3 = round($jmlh_prodi_o3 / count($prodi_o3),2) ?>
        <?php else : ?>
        <?php $avg_prodi_o3 = 2 ?>
        <?php endif; ?>


        <!-- rata-rata prodi p4 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o4 = 0 ?>
        <?php if ( count($prodi_o4) > 0 ) : ?>

        <?php foreach ($prodi_o4 as $pro_o4) : ?>

            <?php $pp4 = 0 ; ?>
            <?php if ($pro_o4->flag_tepat == 'T') : ?>
                <?php $pp4 = 4 ; ?>
            <?php elseif ($pro_o4->flag_tepat == 'F') : ?>
                <?php $pp4 = 2 ; ?>
            <?php endif ?>                        
            
        <?php $jmlh_prodi_o4 = $jmlh_prodi_o4 + $pp4 ?>

        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_prodi_o4 = round($jmlh_prodi_o4 / count($prodi_o4),2) ?>
        <?php else : ?>
        <?php $avg_prodi_o4 = 2 ?>
        <?php endif; ?>

        <!-- rata-rata prodi p5 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o5 = 0 ?>
        <?php if ( count($prodi_o5) > 0 ) : ?>
        <?php foreach ($prodi_o5 as $pro_o5) : ?>
            <?php $jmlh_prodi_o5 = $jmlh_prodi_o5 + $pro_o5->eclass ?>
        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_prodi_o5 = round($jmlh_prodi_o5 / count($prodi_o5),2) ?>
        <?php else: ?>
        <?php $avg_prodi_o5 = 2 ?>
        <?php endif; ?>


        <!-- SUM UNIVERSITAS -->

        <!-- rata-rata prodi p1 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o1 = 0 ?>
        <?php if ( count($uni_o1) > 0 ) : ?>
        <?php foreach ($uni_o1 as $pro_o1) : ?>
            
            <?php $pp1 = 0 ; ?>
            <?php if ($pro_o1->persen_hadir > 90) : ?>
                <?php $pp1 = 4 ; ?>
            <?php elseif ($pro_o1->persen_hadir <= 90 AND $pro_o1->persen_hadir > 80) : ?>
                <?php $pp1 = 3 ; ?>
            <?php elseif ($pro_o1->persen_hadir <= 80) : ?>
                <?php $pp1 = 2 ; ?>
            <?php endif ?>
        <?php $jmlh_prodi_o1 = $jmlh_prodi_o1 + $pp1 ?>

        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_uni_o1 = round($jmlh_prodi_o1 / count($uni_o1),2) ?>
        <?php else: ?>
        <?php $avg_uni_o1 = 2 ?>
        <?php endif ?>
       <!-- rata-rata prodi p2 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o2 = 0 ?>
        <?php if ( count($uni_o2) > 0 ) : ?>
        <?php foreach ($uni_o2 as $pro_o2) : ?>
            
            <?php $pp2 = 0 ; ?>
            <?php if ($pro_o2->baik > 90) : ?>
                <?php $pp2 = 4 ; ?>
            <?php elseif ($pro_o2->baik <= 90 AND $pro_o2->baik > 80) : ?>
                <?php $pp2 = 3 ; ?>
            <?php elseif ($pro_o2->baik <= 80) : ?>
                <?php $pp2 = 2 ; ?>
            <?php endif ?>
        <?php $jmlh_prodi_o2 = $jmlh_prodi_o2 + $pp2 ?>

        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_uni_o2 = round($jmlh_prodi_o2 / count($uni_o2),2) ?>
        <?php else: ?>
        <?php $avg_uni_o2 = 2 ?>
        <?php endif ?>
        <!-- rata-rata prodi p3 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o3 = 0 ?>
        <?php if ( count($uni_o3) > 0 ) : ?>
        <?php foreach ($uni_o3 as $pro_o3) : ?>
            
            <?php $pp3 = 0 ; ?>
            <?php if ($pro_o3->persen_lulus > 60) : ?>
                <?php $pp3 = 4 ; ?>
            <?php elseif ($pro_o3->persen_lulus <= 60 AND $pro_o3->persen_lulus > 50) : ?>
                <?php $pp3 = 3 ; ?>
            <?php elseif ($pro_o3->persen_lulus <= 50) : ?>
                <?php $pp3 = 2 ; ?>
            <?php endif ?>
        <?php $jmlh_prodi_o3 = $jmlh_prodi_o3 + $pp3 ?>

        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_uni_o3 = round($jmlh_prodi_o3 / count($uni_o3),2) ?>
        <?php else: ?>
        <?php $avg_uni_o3 = 2 ?>
        <?php endif; ?>
        <!-- rata-rata prodi p4 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o4 = 0 ?>
        <?php if ( count($uni_o4) > 0 ) : ?>
        <?php foreach ($uni_o4 as $pro_o4) : ?>

            <?php $pp4 = 0 ; ?>
            <?php if ($pro_o4->flag_tepat == 'T') : ?>
                <?php $pp4 = 4 ; ?>
            <?php elseif ($pro_o4->flag_tepat == 'F') : ?>
                <?php $pp4 = 2 ; ?>
            <?php endif ?>                        
            
        <?php $jmlh_prodi_o4 = $jmlh_prodi_o4 + $pp4 ?>

        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_uni_o4 = round($jmlh_prodi_o4 / count($uni_o4),2) ?>
        <?php else: ?>
        <?php $avg_uni_o4 = 2 ?>
        <?php endif; ?>

        <!-- rata-rata prodi p5 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o5 = 0 ?>
        <?php if ( count($uni_o4) > 0 ) : ?>
        <?php foreach ($uni_o5 as $pro_o5) : ?>
            <?php $jmlh_prodi_o5 = $jmlh_prodi_o5 + $pro_o5->eclass ?>
        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_uni_o5 = round($jmlh_prodi_o5 / count($uni_o5),2) ?>
        <?php else: ?>
        <?php $avg_uni_o5 = 2; ?>
        <?php endif; ?>

<script type="text/javascript">
	var chart_count = 0;
</script>

<?php foreach ($dsn as $data_dosen_key => $data_dosen): ?>
<div class="printable-area" sytle="font-type:calibri">
    
    <!-- box left -->
	<div class="left box-panduan-perhitungan">
        <h4 class="title">PARAMETER/INDIKATOR YANG DIGUNAKAN DALAM EVALUASI</h4>
		<table class="table table-bordered table-panduan-perhitungan">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Indikator</th>
                    <th rowspan="2">Perhitungan</th>
                    <th colspan="3">Sebutan</th>
                </tr>
                <tr>
                    <th>Baik(4)</th>
                    <th>Cukup(3)</th>
                    <th>Kurang(2)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>P1 (20%)</td>
                    <td>Kehadiran Dosen (%)</td>
                    <td><img src="<?php echo base_url() ?>public/assets/images/pdf-ip-dosen/rumus-p1.png"></td>
                    <td>≥90%</td>
                    <td>80-90%</td>
                    <td>≤80%</td>
                </tr>
                <tr>
                    <td>P2 (35%)</td>
                    <td>Kualitas Pengajaran (%)</td>
                    <td><img src="<?php echo base_url() ?>public/assets/images/pdf-ip-dosen/rumus-p2-baru.png"></td>
                    <td>≥90%</td>
                    <td>80-90%</td>
                    <td>≤80%</td>
                </tr>
                <tr>
                    <td>P3 (10%)</td>
                    <td>Kelulusan Mahasiswa (%)</td>
                    <td><img src="<?php echo base_url() ?>public/assets/images/pdf-ip-dosen/rumus-p3-baru.png"></td>
                    <td>≥60%</td>
                    <td>50-60%</td>
                    <td>≤50%</td>
                </tr>
                <tr>
                    <td>P4 (15%)</td>
                    <td>Ketepatan Waktu Penyerahan Nilai</td>
                    <td>Diserahkan sebelum atau setelah tanggal <?php echo date('d-M-Y',strtotime($periode['deadline'])) ?></td>
                    <td>Sebelum atau tepat tanggal <?php echo date('d-M-Y',strtotime($periode['deadline'])) ?></td>
                    <td></td>
                    <td>Setelah <?php echo date('d-M-Y',strtotime($periode['deadline'])) ?></td>
                </tr>
                <tr>
                    <td>P5 (20%)</td>
                    <td>Pemanfaatan e-Class</td>
                    <td>Silabus (1 point) <br> Materi (1 point) <br> Tugas (1 point) <br> Nilai (1 point)</td>
                    <td>4</td>
                    <td>3</td>
                    <td>2</td>
                </tr>
            </tbody>
        </table>
	</div>
    

    <?php $i = 1; ?>
    <?php $ips_tot = 0; ?>
    <?php $p1_tot = 0; ?>
    <?php $p2_tot = 0; ?>
    <?php $p3_tot = 0; ?>
    <?php $p4_tot = 0; ?>
    <?php $p5_tot = 0; ?>
    <?php foreach ($ajar[$data_dosen_key] as $mtk) : ?>
                <?php $p1 = 0 ; ?>
                <!-- p1 -->
                <?php if ($mtk->persen_hadir > 90) : ?>
                    <?php $p1 = 4 ; ?>
                <?php elseif ($mtk->persen_hadir <= 90 AND $mtk->persen_hadir > 80) : ?>
                    <?php $p1 = 3 ; ?>
                <?php elseif ($mtk->persen_hadir <= 80) : ?>
                    <?php $p1 = 2 ; ?>
                <?php endif ?>
                <?php $p2 = 0 ; ?>

                <!-- p2 -->
                <?php if ($mtk->baik > 90) : ?>
                    <?php $p2 = 4 ; ?>
                <?php elseif ($mtk->baik <= 90 AND $mtk->baik > 80) : ?>
                    <?php $p2 = 3 ; ?>
                <?php elseif ($mtk->baik <= 80) : ?>
                    <?php $p2 = 2 ; ?>
                <?php endif ?>

                <?php $p3 = 0 ; ?>
                <!-- p3 -->
                <?php if ($mtk->persen_lulus > 60) : ?>
                    <?php $p3 = 4 ; ?>
                <?php elseif ($mtk->persen_lulus <= 60 AND $mtk->persen_lulus > 50) : ?>
                    <?php $p3 = 3 ; ?>
                <?php elseif ($mtk->persen_lulus <= 50) : ?>
                    <?php $p3 = 2 ; ?>
                <?php endif ?>

                <?php $p4 = 0 ; ?>
                <!-- p4 -->
                <?php if ($mtk->flag_tepat == 'T') : ?>
                    <?php $p4 = 4 ; ?>
                <?php elseif ($mtk->flag_tepat == 'F') : ?>
                    <?php $p4 = 2 ; ?>
                <?php else : ?>
                    <?php $p4 = 2 ; ?>
                <?php endif ?>                        
                
                <?php $p5 = $mtk->eclass ?>

            <?php $ip_mtk = (0.2 * $p1) + (0.35 * $p2) + (0.10 * $p3) + (0.15 * $p4) + (0.20 * $p5) ?>
            <?php $i++ ?>
            <?php $ips_tot = $ips_tot + $ip_mtk ?>
    <?php endforeach; ?>

<?php $i-- ?>
<?php $ipk = 0; ?>
<?php $ipk = round($ips_tot / $i, 2); ?>
<?php $ipk; ?>

    <!-- box right -->
	<div class="right box-description">
        <h3>INDEKS PRESTASI (IP) DOSEN</h3>
        <div class="left">
            <dl class="periode">
                <dt>Semester</dt>
                <dd><?php echo $periode['semester'] ?></dd>
                <dt>echo</dt>
                <dd><?php echo $periode['thn_ajaran'] ?></dd>
            </dl>
            <dl>

                <?php
                    $nama = '';
                    if (str_replace(" ", "",$data_dosen->gelar_prefix) != '' AND str_replace(" ", "",$data_dosen->gelar_prefix) != NULL) {
                        $nama = $data_dosen->gelar_prefix . ' ';
                    }
                    $nama = $nama . $data_dosen->nama_dsn;
                    if ($data_dosen->gelar_suffix != '' AND $data_dosen->gelar_suffix != NULL) {
                        $nama = $nama . ' ' . $data_dosen->gelar_suffix ;
                    }
                ?>


                <dt>Program Studi</dt>
                <dd><?php echo $data_dosen->unit ?></dd>
                <dt>NIK</dt>
                <dd><?php echo $data_dosen->nik ?></dd>
                <dt>Nama</dt>
                <dd><?php echo $data_dosen->nama ?></dd>
                <dt>IPK</dt>
                <dd><?php echo number_format($ipk,2); ?></dd>
            </dl>
        </div>
        <div class="right logo-ukdw">
            <img src="<?php echo base_url() ?>public/assets/images/logo-UKDW.png">
        </div>
        <div class="clear"></div>

        <div class="clear"></div>

        <div class="box-chart">
            <div id="container-<?php echo $data_dosen->nik ?>" style="width: 450px; height: 280px;"></div>
            <div id="imgContainer"></div>
            <div class="keterangan">
                <div>P1 = Kehadiran Dosen,</div>
                <div>P2 = Kualitas Pengajaran,</div>
                <div>P3 = Kelulusan Mahasiswa,</div>
                <div>P4 = Waktu Penyerahan Nilai,</div>
                <div>P5 = e-Class</div>
            </div>
        </div>

	</div>
	
	<div class="clear"></div>

    <div class="page-break"></div>

    <!-- Tabel detail perhitungan -->
    <div class="detail-perhitungan">
        <h3>INDEKS PRESTASI (IP) DOSEN</h3>
        <dl class="periode">
            <dt>Semester</dt>
            <dd><?php echo $periode['semester'] ?></dd>
            <dt>Tahun Ajaran</dt>
            <dd><?php echo $periode['thn_ajaran'] ?></dd>
        </dl>
        <dl>
            <dt>Program Studi</dt>
            <dd><?php echo $data_dosen->unit ?></dd>
            <dt>NIK</dt>
            <dd><?php echo $data_dosen->nik ?></dd>
            <dt>Nama</dt>
            <dd><?php echo $data_dosen->nama_dsn ?></dd>
        </dl>
        <div class="clear"></div>
        <br><br>
        <table class="table table-bordered table-detail-perhitungan">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Kode</th>
                    <th rowspan="2">Nama Matakuliah</th>
                    <th rowspan="2">Grup</th>
                    <th colspan="2">Kehadiran Dosen</th>
                    <th colspan="2">Kualitas Pengajaran</th>
                    <th colspan="2">Kelulusan Mhs</th>
                    <th colspan="2">Nilai Tepat Waktu</th>
                    <th colspan="5">e-Class</th>
                    <th rowspan="2">IPS</th>
                </tr>
                <tr>
                    <th>%P1</th>
                    <th>P1</th>
                    <th>%P2</th>
                    <th>P2</th>
                    <th>%P3</th>
                    <th>P3</th>
                    <th>Y/T</th>
                    <th>P4</th>
                    <th>S</th>
                    <th>M</th>
                    <th>T</th>
                    <th>N</th>
                    <th>PS</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            <?php $ips_tot = 0; ?>
            <?php $p1_tot = 0; ?>
            <?php $p2_tot = 0; ?>
            <?php $p3_tot = 0; ?>
            <?php $p4_tot = 0; ?>
            <?php $p5_tot = 0; ?>
            <?php foreach ($ajar[$data_dosen_key] as $mtk) : ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $mtk->kode ?></td>
                    <td><?php echo $mtk->nama_mtk ?></td>
                    <td style="text-align:center"><?php echo $mtk->grup ?></td>
                    <td style="text-align:right">
                    	<?php if ($mtk->persen_hadir > 100): ?>
                    		100%
                    	<?php else: ?>
                    		<?php echo $mtk->persen_hadir; ?>%
                    	<?php endif ?>
                    </td>
                    <td style="text-align:right">
                        <?php $p1 = 0 ; ?>
                        <!-- p1 -->
                        <?php if ($mtk->persen_hadir > 90) : ?>
                            <?php $p1 = 4 ; ?>
                            <?php echo $p1; ?>
                        <?php elseif ($mtk->persen_hadir <= 90 AND $mtk->persen_hadir > 80) : ?>
                            <?php $p1 = 3 ; ?>
                            <?php echo $p1; ?>
                        <?php elseif ($mtk->persen_hadir <= 80) : ?>
                            <?php $p1 = 2 ; ?>
                            <?php echo $p1; ?>
                        <?php endif ?>
                    </td>
                    <td style="text-align:right"><?php echo $mtk->baik ?>%</td>
                    <td style="text-align:right">
                        <?php $p2 = 0 ; ?>
                        <!-- p2 -->
                        <?php if ($mtk->baik > 90) : ?>
                            <?php $p2 = 4 ; ?>
                            <?php echo $p2; ?>
                        <?php elseif ($mtk->baik <= 90 AND $mtk->baik > 80) : ?>
                            <?php $p2 = 3 ; ?>
                            <?php echo $p2; ?>
                        <?php elseif ($mtk->baik <= 80) : ?>
                            <?php $p2 = 2 ; ?>
                            <?php echo $p2; ?>
                        <?php endif ?>
                    </td>
                    <td style="text-align:right"><?php echo $mtk->persen_lulus ?>%</td>
                    <td style="text-align:right">
                        <?php $p3 = 0 ; ?>
                        <!-- p3 -->
                        <?php if ($mtk->persen_lulus > 60) : ?>
                            <?php $p3 = 4 ; ?>
                            <?php echo $p3; ?>
                        <?php elseif ($mtk->persen_lulus <= 60 AND $mtk->persen_lulus > 50) : ?>
                            <?php $p3 = 3 ; ?>
                            <?php echo $p3; ?>
                        <?php elseif ($mtk->persen_lulus <= 50) : ?>
                            <?php $p3 = 2 ; ?>
                            <?php echo $p3; ?>
                        <?php endif ?>
                    </td>
                    <td style="text-align:center">
                        <!-- p4 -->
                        <?php if ($mtk->flag_tepat == 'T') : ?>
                            Y
                        <?php elseif ($mtk->flag_tepat == 'F') : ?>
                            T
                        <?php else : ?>
                            -
                        <?php endif ?>                                                
                    </td>
                    <td style="text-align:right">
                        <?php $p4 = 0 ; ?>
                        <!-- p4 -->
                        <?php if ($mtk->flag_tepat == 'T') : ?>
                            <?php $p4 = 4 ; ?>
                            <?php echo $p4; ?>
                        <?php elseif ($mtk->flag_tepat == 'F') : ?>
                            <?php $p4 = 2 ; ?>
                            <?php echo $p4; ?>
                        <?php else : ?>
                            <?php $p4 = 2 ; ?>
                            <?php echo $p4; ?>
                        <?php endif ?>                        
                    </td>
                    <td style="text-align:center"><?php echo $mtk->silabus ?></td>
                    <td style="text-align:center"><?php echo $mtk->materi ?></td>
                    <td style="text-align:center"><?php echo $mtk->tugas ?></td>
                    <td style="text-align:center"><?php echo $mtk->nilai ?></td>
                    <td style="text-align:center">
                        <?php $p5 = $mtk->eclass ?>
                        <?php echo $mtk->eclass ?>
                    </td>
                    <td style="text-align:right">
                        <?php $ip_mtk = (0.2 * $p1) + (0.35 * $p2) + (0.10 * $p3) + (0.15 * $p4) + (0.20 * $p5) ?>
                        <?php echo number_format($ip_mtk,2) ?>
                    </td>


                    <?php $i++ ?>
                    <?php $ips_tot = $ips_tot + $ip_mtk ?>
                    <?php $p1_tot = $p1_tot + $p1 ?>
                    <?php $p2_tot = $p2_tot + $p2 ?>
                    <?php $p3_tot = $p3_tot + $p3 ?>
                    <?php $p4_tot = $p4_tot + $p4 ?>
                    <?php $p5_tot = $p5_tot + $p5 ?>
                </tr>                
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php $i-- ?>
        <?php $p1_avg = round($p1_tot / $i, 2); ?>
        <?php $p2_avg = round($p2_tot / $i, 2); ?>
        <?php $p3_avg = round($p3_tot / $i, 2); ?>
        <?php $p4_avg = round($p4_tot / $i, 2); ?>
        <?php $p5_avg = round($p5_tot / $i, 2); ?>
        <table class="table table-resume">
            <tbody>
                <tr>
                        <td style="text-align:right">Total IPS : </td>
                        <td style="text-align:right"><?php echo number_format($ips_tot,2) ?></td>
                </tr>
                <tr>
                        <td style="text-align:right">Jumlah Kelas : </td>
                        <td style="text-align:right"><?php echo $i ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                        <td style="text-align:right">IPK : </td>
                        <td style="text-align:right"><?php echo number_format(round((float)$ips_tot / $i, 2),2); ?></td>
                </tr>
            </tfoot>
        </table>
        <div class="clear"></div>


        <div class="box-pengesahan">
            <p>Disahkan oleh :</p>
            <table class="table table-bordered">
                <thead>
                    <th width="80px">Biro 1</th>
                    <th width="80px">InQA</th>
                    <th width="100px">Pejabat Prodi/Departemen</th>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- JS for graphic -->
	<script type="text/javascript">

	var CI_ROOT = '<?php echo base_url(); ?>';

	jQuery(document).ready(function($j){
		if (!jQuery('.loading').length) {
			$j('body').append('<div class="loading"><div>Loading...</div></div>');
		};
	    $j('#container-<?php echo $data_dosen->nik ?>').highcharts({
	        xAxis: {
	            categories: ['p1', 'p2', 'p3', 'p4', 'p5']
	        },
	        yAxis:{
	            max: 4,
	            tickInterval: 0.2
	        },       
	        series: [{
	            type: 'column',
	            name: 'Saya',
	            data: [ <?php echo $p1_avg ?>, <?php echo $p2_avg ?>, <?php echo $p3_avg ?>, <?php echo $p4_avg ?>, <?php echo $p5_avg ?> ],
	            color: '#297fd3',
	            animation: {
	                complete: function () {
	                	chart_count++;

					    if (chart_count == <?php echo count($dsn) ?>) {
						    $j('text:contains("Highcharts.com")').remove();
					        $j('.loading > div').remove();
					        window.print();
					        window.history.back();  
					    };
	                }
	            }
	        }, {
	            type: 'spline',
	            name: 'Rata-rata Prodi',
	            data: [<?php echo $avg_prodi_o1 ?>, <?php echo $avg_prodi_o2 ?>, <?php echo $avg_prodi_o3 ?>, <?php echo $avg_prodi_o4 ?>, <?php echo $avg_prodi_o5 ?>],
	            marker: {
	            	lineWidth: 2,
	            	lineColor: Highcharts.getOptions().colors[3],
	            	fillColor: 'white'
	            }
	        }, {
	            type: 'spline',
	            name: 'Rata-rata Universitas',
	            data: [<?php echo $avg_uni_o1 ?>, <?php echo $avg_uni_o2 ?>, <?php echo $avg_uni_o3 ?>, <?php echo $avg_uni_o4 ?>, <?php echo $avg_uni_o5 ?>],
	            marker: {
	            	lineWidth: 2,
	            	lineColor: Highcharts.getOptions().colors[4],
	            	fillColor: 'white'
	            }
	        }]
	            
	    });
	});

	</script>
    
    <?php if ($data_dosen_key+1 != count($dsn)): ?>
	    <div class="page-break"></div>
    <?php endif ?>

</div>
<?php endforeach ?>