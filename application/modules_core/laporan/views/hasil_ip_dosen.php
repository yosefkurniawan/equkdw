<div class="page-header">
	<h1>
		Hasil IP Dosen
		<small>Periode <?= $periode['semester'].' - '.$periode['thn_ajaran'] ?> &nbsp; <a href="" id="change-period"> <i class="icon-cog"></i></a> &nbsp;

		<input type="hidden" id="nik" value="<?php echo $dsn->nik?>" />
		
		<select id="id_paket" style="width:160px;display:none">
			<?php foreach($paket_list as $item) : ?>
				<option value="<?php echo $item['id_paket']?>">
					<?php echo $item['thn_ajaran']?> <?php echo $item['semester']?></option>
			<?php endforeach; ?>
		</select>

		&nbsp;&nbsp;<a href="#" id="change_period_process" style="display:none"><i class='icon-save'> </i></a>
		&nbsp;&nbsp;<a href="#" id="tutup_period_form" style="display:none"><i class='icon-remove'> </i></a>
		</small> 

	<div class="pull-right">
		<a href="<?php echo base_url() ?>laporan/dosen/detail_dosen_pdf/<?php echo $dsn->nik?>
				<?php if ($id_paket != '') : echo '/'.$id_paket; endif; ?>" 
				class='btn btn-med blue-bg' target='_blank'><i class='icon-print'></i> Cetak</a>		
	</div>
		
	</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li class="active">Laporan</li>
	<li><a href="<?= base_url().'laporan/dosen/ip_dosen/' ?>">Laporan IP Dosen</a></li>
	<li class="active"><?= $dsn->nama_dsn ?></li>
</ol>

<h4>Dosen : <?= $dsn->nama_dsn ?> / <?= $dsn->nik ?> / <?php echo $dsn->unit ?>&nbsp;&nbsp;&nbsp;</h4>

<!-- Hasil evaluasi kelas -->
<div class="panel colored">
	<div class="panel-heading green-bg"><h3 class="panel-title">Hasil IP Dosen</h3></div>

	<div class="panel-body table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Kode</th>
                    <th rowspan="2">Nama Matakuliah</th>
                    <th rowspan="2" style="text-align:center">Grup</th>
                    <th colspan="2" style="text-align:center">Kehadiran Dosen</th>
                    <th colspan="2" style="text-align:center">Kualitas Pengajaran</th>
                    <th colspan="2" style="text-align:center">Kelulusan Mhs</th>
                    <th colspan="2" style="text-align:center">Nilai Tepat Waktu</th>
                    <th colspan="5" style="text-align:center">e-Class</th>
                    <th rowspan="2" style="text-align:center">IPS</th>
                </tr>
                <tr>
                    <th style="text-align:center">%P1</th>
                    <th style="text-align:center">P1</th>
                    <th style="text-align:center">%P2</th>
                    <th style="text-align:center">P2</th>
                    <th style="text-align:center">%P3</th>
                    <th style="text-align:center">P3</th>
                    <th style="text-align:center">Y/T</th>
                    <th style="text-align:center">P4</th>
                    <th style="text-align:center">S</th>
                    <th style="text-align:center">M</th>
                    <th style="text-align:center">T</th>
                    <th style="text-align:center">N</th>
                    <th style="text-align:center">PS</th>
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
            <?php if ($i % 2 == 0) : ?>
                <tr class="success">
            <?php else : ?>
                <tr class="warning">
           	<?php endif ?>
                    <td><?php echo $i ?></td>
                    <td><?php echo $mtk->kode ?></td>
                    <td><?php echo $mtk->nama_mtk ?></td>
                    <td style="text-align:center"><?php echo $mtk->grup ?></td>
                    <td style="text-align:right">
                    	<?php if (isset($mtk->persen_hadir)) : ?>
                    	<?php echo $mtk->persen_hadir ?>%
						<i class="tooltip-demo"
                            data-original-title="Hadir Dalam <?php echo $mtk->tot_hadir ?> Pertemuan dari Total Rencana <?php echo $mtk->rencana ?> Pertemuan"
                            data-placement="top" data-toggle="tooltip" href="#"
                            title=""><i class="icon-question-sign"></i></i> 
                        <?php else : ?>
                        -
                        <?php endif; ?>
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
                    <td style="text-align:right">
                    	<?php if ($mtk->baik != 0) : ?>
                    	<?php echo $mtk->baik ?>%
                        <?php else : ?>
                        -
                        <?php endif; ?>
                    </td>
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
                    <td style="text-align:right">
                    	<?php if (isset($mtk->persen_lulus)) : ?>
                    	<?php echo $mtk->persen_lulus ?>%
                        <?php else : ?>
                        -
                        <?php endif; ?>
                    </td>
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
                        <?php endif ?>                                                
							<i class="tooltip-demo"
	                            data-original-title="Tgl Penyerahan Nilai : <?php echo date('d-M-Y',strtotime($mtk->tgl_masuk)) ?> "
	                            data-placement="top" data-toggle="tooltip" href="#"
	                            title=""><i class="icon-question-sign"></i></i>                          
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
                        <td style="text-align:right" width="90%">Total IPS :</td>
                        <td style="text-align:right" width="10%"><?php echo number_format($ips_tot,2) ?></td>
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


        <div class="col-sm-12" style="font-size:12px">
        <h4 class="title">PARAMETER/INDIKATOR YANG DIGUNAKAN DALAM EVALUASI</h4>
		<table class="table table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" style="text-align:center" >No</th>
                    <th rowspan="2" style="text-align:center" >Indikator</th>
                    <th rowspan="2" style="text-align:center" >Perhitungan</th>
                    <th colspan="3" style="text-align:center" >Sebutan</th>
                </tr>
                <tr>
                    <th style="text-align:center" >Baik(4)</th>
                    <th style="text-align:center" >Cukup(3)</th>
                    <th style="text-align:center" >Kurang(2)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>P1 (20%)</td>
                    <td>Kehadiran Dosen (%)</td>
                    <td><img src="<?php echo base_url() ?>public/assets/images/pdf-ip-dosen/rumus-p1.png" width="200px"></td>
                    <td>≥90%</td>
                    <td>80-90%</td>
                    <td>≤80%</td>
                </tr>
                <tr>
                    <td>P2 (35%)</td>
                    <td>Kualitas Pengajaran (%)</td>
                    <td><img src="<?php echo base_url() ?>public/assets/images/pdf-ip-dosen/rumus-p2-baru.png" width="200px"></td>
                    <td>≥90%</td>
                    <td>80-90%</td>
                    <td>≤80%</td>
                </tr>
                <tr>
                    <td>P3 (10%)</td>
                    <td>Kelulusan Mahasiswa (%)</td>
                    <td><img src="<?php echo base_url() ?>public/assets/images/pdf-ip-dosen/rumus-p3-baru.png" width="200px"></td>
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
	</div>
</div>

<script>
	CI_ROOT = "<?php echo base_url() ?>";

    jQuery(document).ready(function() {   
		jQuery('#change-period').on('click',function(){
			jQuery('#id_paket').show();
			jQuery('#change_period_process').show();
			jQuery('#tutup_period_form').show();
			return false;
		});	    
		jQuery('#tutup_period_form').on('click',function(){
			jQuery(this).hide();
			jQuery('#change_period_process').hide();
			jQuery('#id_paket').hide();
			return false;
		});	    
		jQuery('#change_period_process').on('click',function(){
			var nik = jQuery('#nik').val();
			var id_paket = jQuery('#id_paket').val();
			var admin = jQuery('#isAdmin').val();
			window.location.replace(CI_ROOT+'laporan/dosen/ip_dosen/'+nik+'/'+id_paket);
			return false;
		});	    
    });
    
</script>
