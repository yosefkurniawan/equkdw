           <?php $i = 1; ?>
            <?php $ips_tot = 0; ?>
            <?php $p1_tot = 0; ?>
            <?php $p2_tot = 0; ?>
            <?php $p3_tot = 0; ?>
            <?php $p4_tot = 0; ?>
            <?php $p5_tot = 0; ?>
            <?php foreach ($ajar as $mtk) : ?>
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

        <!-- rata-rata prodi p1 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o1 = 0 ?>
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

        <!-- rata-rata prodi p2 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o2 = 0 ?>
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
  
        <!-- rata-rata prodi p3 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o3 = 0 ?>
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

        <!-- rata-rata prodi p4 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o4 = 0 ?>
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
        <?php echo "jumlah hitungan : " . $jmlh_prodi_o4 ?>
        <?php echo "rata-rata : " . $avg_prodi_o4 ?>

        <!-- rata-rata prodi p5 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o5 = 0 ?>
        <?php foreach ($prodi_o5 as $pro_o5) : ?>
            <?php $jmlh_prodi_o5 = $jmlh_prodi_o5 + $pro_o5->eclass ?>
        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_prodi_o5 = round($jmlh_prodi_o5 / count($prodi_o5),2) ?>



        <!-- SUM UNIVERSITAS -->

        <!-- rata-rata prodi p1 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o1 = 0 ?>
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

       <!-- rata-rata prodi p2 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o2 = 0 ?>
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
  
        <!-- rata-rata prodi p3 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o3 = 0 ?>
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


        <!-- rata-rata prodi p4 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o4 = 0 ?>
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

        <!-- rata-rata prodi p5 -->
        <!-- foreach where prodi = prodi dosennya -->
        <?php $jmlh_prodi_o5 = 0 ?>
        <?php foreach ($uni_o5 as $pro_o5) : ?>
            <?php $jmlh_prodi_o5 = $jmlh_prodi_o5 + $pro_o5->eclass ?>
        <?php endforeach ?>
        <!-- rata rata : jumlah / count -->
        <?php $avg_uni_o5 = round($jmlh_prodi_o5 / count($uni_o5),2) ?>

<div class="printable-area">
    
    <!-- box left -->
	<div class="left box-panduan-perhitungan">
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
                    <td>jumlah kehadiran dosen di kelas selama 1 semester / jmlah pertemuan yang tersedia selama 1 semester * 100%</td>
                    <td>≥91%</td>
                    <td>81-90%</td>
                    <td>≤80%</td>
                </tr>
                <tr>
                    <td>P2 (35%)</td>
                    <td>Kualitas Pengajaran (%)</td>
                    <td>total % baik / jumlah kelas</td>
                    <td>≥91%</td>
                    <td>81-90%</td>
                    <td>≤80%</td>
                </tr>
                <tr>
                    <td>P3 (10%)</td>
                    <td>Kelulusan Mahasiswa (%)</td>
                    <td>jumlah dengan nilai <= C / total jumlah mahasiswa peserta * 100%</td>
                    <td>≥91%</td>
                    <td>81-90%</td>
                    <td>≤80%</td>
                </tr>
                <tr>
                    <td>P4 (15%)</td>
                    <td>Waktu Penyerahan Nilai</td>
                    <td>Sebelum atau setelah tanggal 25 Juli 2014</td>
                    <td>Sebelum atau tepat tanggal 25 Juli 2014</td>
                    <td></td>
                    <td>Setelah 3 Januari 2012</td>
                </tr>
                <tr>
                    <td>P5 (20%)</td>
                    <td>e-Class</td>
                    <td>Silabus (1 point) + Materi (1 point) + Tugas (1 point) + Nilai (1 point)</td>
                    <td>4</td>
                    <td>3</td>
                    <td>2</td>
                </tr>
            </tbody>
        </table>
	</div>
    
    <!-- box right -->
	<div class="right box-description">
        <dl class="periode">
            <h3>INDEKS PRESTASI (IP) DOSEN</h3>
            <dt>Semester</dt>
            <dd>GENAP</dd>
            <dt>Tahun Ajaran</dt>
            <dd>2013/2014</dd>
        </dl>
        <div class="logo-ukdw">
            <img src="<?php echo base_url() ?>public/assets/images/logo-UKDW.png">
        </div>
        <div class="clear"></div>
        <dl>
            <dt>Program Studi</dt>
            <dd><?php echo $dsn->nama_prodi ?></dd>
            <dt>NIK</dt>
            <dd><?php echo $dsn->nik_baru?> / <?php echo $dsn->nik?>  </dd>
            <dt>Nama</dt>
            <dd><?php echo $dsn->nama_dsn?></dd>
            <dt>IPK</dt>
            <dd><?php echo $ipk; ?></dd>
        </dl>

        <div class="clear"></div>

        <div class="box-chart">
            <div id="container" style="width: 450px; height: 280px;"></div>
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
            <dd>GENAP</dd>
            <dt>Tahun Ajaran</dt>
            <dd>2013/2014</dd>
        </dl>
        <dl>
            <dt>Program Studi</dt>
            <dd><?php echo $dsn->nama_prodi ?></dd>
            <dt>NIK</dt>
            <dd><?php echo $dsn->nik_baru?> / <?php echo $dsn->nik?> </dd>
            <dt>Nama</dt>
            <dd><?php echo $dsn->nama_dsn?></dd>
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
            <?php foreach ($ajar as $mtk) : ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $mtk->kode ?></td>
                    <td><?php echo $mtk->nama_mtk ?></td>
                    <td><?php echo $mtk->grup ?></td>
                    <td><?php echo $mtk->persen_hadir ?></td>
                    <td>
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
                    <td><?php echo $mtk->baik ?></td>
                    <td>
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
                    <td><?php echo $mtk->persen_lulus ?></td>
                    <td>
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
                    <td>
                        <!-- p4 -->
                        <?php if ($mtk->flag_tepat == 'T') : ?>
                            Y
                        <?php elseif ($mtk->flag_tepat == 'F') : ?>
                            T
                        <?php endif ?>                                                
                    </td>
                    <td>
                        <?php $p4 = 0 ; ?>
                        <!-- p4 -->
                        <?php if ($mtk->flag_tepat == 'T') : ?>
                            <?php $p4 = 4 ; ?>
                            <?php echo $p4; ?>
                        <?php elseif ($mtk->flag_tepat == 'F') : ?>
                            <?php $p4 = 2 ; ?>
                            <?php echo $p4; ?>
                        <?php endif ?>                        
                    </td>
                    <td><?php echo $mtk->silabus ?></td>
                    <td><?php echo $mtk->materi ?></td>
                    <td><?php echo $mtk->tugas ?></td>
                    <td><?php echo $mtk->nilai ?></td>
                    <td>
                        <?php $p5 = $mtk->eclass ?>
                        <?php echo $mtk->eclass ?>
                    </td>
                    <td><?php echo $ip_mtk = (0.2 * $p1) + (0.35 * $p2) + (0.10 * $p3) + (0.15 * $p4) + (0.20 * $p5) ?></td>


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
                        <td>Total IPS</td>
                        <td>: <?php echo $ips_tot ?></td>
                </tr>
                <tr>
                        <td>Jumlah Kelas</td>
                        <td>: <?php echo $i ?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                        <td>IPK</td>
                        <td>: <?php echo round($ips_tot / $i, 2); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<script type="text/javascript">

var CI_ROOT = '<?php echo base_url(); ?>';

jQuery(document).ready(function($j){
    $('body').append('<div class="loading"><div>Loading...</div></div>');
    $j('#container').highcharts({
        xAxis: {
            categories: ['p1', 'p2', 'p3', 'p4', 'p5']
        },
        series: [{
            type: 'column',
            name: 'Saya',
            data: [ <?php echo $p1_avg ?>, <?php echo $p2_avg ?>, <?php echo $p3_avg ?>, <?php echo $p4_avg ?>, <?php echo $p5_avg ?> ],
            animation: {
                complete: function () {
                    $('.loading > div').remove();
                    window.print();
                    window.history.back();  
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
