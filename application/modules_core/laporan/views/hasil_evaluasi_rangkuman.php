<div class="page-header">
	<h1>
		Rangkuman Evaluasi
		<small>Periode <?= $periode['semester'].' - '.$periode['thn_ajaran'] ?> &nbsp; <a href="" id="change-period"> <i class="icon-cog"></i></a> &nbsp;		
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
			<form class="form-horizontal left-label" role="form">
				<div class="form-group">
					<div class="col-lg-12">
						<select name="prodi" id="idUnit" class="form-control" onchange="changeUnitSubmit(this.value)">
							<option value="overview" <?php if ($this->uri->segment(3) == 'overview') : echo "selected"; endif; ?> > -- SEMUA DATA UNIT -- </option>
							<?php foreach ($unit_list as $key => $unit): ?>
								<option value="<?php echo $unit['id_unit'] ?>" 
								<?php if ($this->uri->segment(3) == $unit['id_unit']) : echo "selected"; endif; ?> >
								<?php echo $unit['unit'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</form>
		</div>
	</h1>
</div>

<ol class="breadcrumb">
	<li><a href="<?= base_url() ?>">Dashboard</a></li>
	<li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
	<li class="active">Rangkuman Evaluasi</li>
</ol>

<!-- Hasil evaluasi kelas -->
<div class="row">
<!--
		<div class="col-md-12">
			<form class="form-horizontal left-label" role="form">
				<div class="form-group">
					<label class="control-label col-lg-1">Pilih Unit</label>
					<div class="col-lg-4">
						<select name="prodi" class="form-control" onchange="changeUnitSubmit(this.value)">
							<option value="overview" <?php if ($this->uri->segment(3) == 'overview') : echo "selected"; endif; ?> >GENERAL</option>
							<?php foreach ($unit_list as $key => $unit): ?>
								<option value="<?php echo $unit['id_unit'] ?>" 
								<?php if ($this->uri->segment(3) == $unit['id_unit']) : echo "selected"; endif; ?> >
								<?php echo $unit['unit'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			</form>
			<hr/>
		</div>
-->
		
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Overview Mahasiswa</h3>
				</div>
				<br>
				<ul class="stats clearfix">
		        <li class="col-md-3">
		          <div class="blue-bg"><i class="icon-user"></i>
		            <h5><?php echo $tot_mhs; ?> Mahasiswa <br> <?= $periode['semester'].' - '.$periode['thn_ajaran'] ?></h5>
		        </li>
		        <li class="col-md-3">
		          <div class="green-bg"><i class="icon-"></i>
		            <h5><?php echo $tot_mhs_complete; ?> Lengkap Mengisi <br>(<?php echo round($tot_mhs_complete/$tot_mhs*100,2); ?>%) </h5>
		        </li>
		        <li class="col-md-3">
		          <div class="mehroon-bg"><i class="icon-"></i>
		            <h5><?php echo $tot_mhs_ongoing; ?> Sedang/Belum Mengisi <br>(<?php echo round($tot_mhs_ongoing/$tot_mhs*100,2); ?>%)</h5>
		        </li>
		        <li class="col-md-3">
		          <div class="yellow-bg"><i class="icon-"></i>
		            <h5><?php echo $tot_mhs_dont_have; ?> Tidak Perlu Mengisi <br>(<?php echo round($tot_mhs_dont_have/$tot_mhs*100,2); ?>%)</h5>
		        </li>
		        </ul>
			</div>		
		</div>		
				
		<div class="col-md-6">
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Grafik Matakuliah</h3>
				</div>
				<div class="panel-body">
					<div id="chart_matkul" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div>
		
		<div class="col-md-6">
			<div class="panel">
				<div class="panel-heading">
					<h3 class="panel-title">Grafik Matakuliah Terisi</h3>
				</div>
				<div class="panel-body">
					<div id="chart_matkul_terisi" style="width: 100%; height: 300px;"></div>
				</div>
			</div>
		</div>
</div>
<div class="row">
	<div class="col-md-12">
		
		
<!-- 		<p>terdiri dari :  -->
	
			<h3>Download</h3>
			
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Unit</th>
<!-- 						<th style="text-align:center">Overview</th> -->
						<th style="text-align:center">Rangkuman Pengisian per Mtk</th>
						<th style="text-align:center">Daftar Mahasiswa</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($unit_list as $unit) : ?>
					<tr>
						<td style="vertical-align:middle"><?php echo $unit['unit'] ?></td>
<!--
						<td style="text-align:center">
							<a href="" class="btn btn-info"><i class="icon-bar-chart">&nbsp;Overview (.pdf)</i></a>
						</td>
-->
						<td style="text-align:center">


							<a href="<?php echo base_url()?>laporan/pdf_hasil_rangkuman_per_mtk/<?php echo $unit['id_unit']?><?php if($id_paket != 'overview') : echo "/".$id_paket; endif; ?>" 
								target="_blank"
								class="btn btn-danger"><i class="icon-bar-chart">&nbsp;Format Pdf</i></a> &nbsp;
							<a href="<?php echo base_url()?>laporan/excel_hasil_rangkuman_per_mtk/<?php echo $unit['id_unit']?><?php if($id_paket != 'overview') : echo "/".$id_paket; endif; ?>" 
								target="_blank"
								class="btn btn-info"><i class="icon-bar-chart">&nbsp;Format Excel</i></a>
						</td>
						<td style="text-align:center">
							<a href="<?php echo base_url()?>laporan/pdf_daftar_siswa_sudah_selesai/<?php echo $unit['id_unit']?><?php if($id_paket != 'overview') : echo "/".$id_paket; endif; ?>" 
								target="_blank"
							class="btn btn-success"><i class="icon-bar-chart">&nbsp;Sudah Mengisi (.pdf)</i></a> &nbsp;
							<a href="<?php echo base_url()?>laporan/pdf_daftar_siswa_belum_selesai/<?php echo $unit['id_unit']?><?php if($id_paket != 'overview') : echo "/".$id_paket; endif; ?>" 
								target="_blank"
							class="btn btn-warning"><i class="icon-bar-chart">&nbsp;Belum Lengkap (.pdf)</i></a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
	
			
		</p>
	</div>
</div>

<script>
	CI_ROOT = "<?php echo base_url() ?>";
	
	// Change unit handler
	function changeUnitSubmit(id_unit) {
		window.location.href = CI_ROOT + "laporan/rangkuman_evaluasi/" + id_unit;
	}
	
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
			var id_unit = jQuery('#idUnit').val();
			var id_paket = jQuery('#id_paket').val();
			window.location.replace(CI_ROOT+'laporan/rangkuman_evaluasi/'+id_unit+'/'+id_paket);			
			return false;
		});	   
		
		
		/**********************************
		Bar Charts - Matakuliah
		**********************************/
		
		$("#chart_matkul").dxChart({
	
			dataSource: [
				{matkul: "MK Berkuisioner", value: <?php echo $mtk_overview['mtk_berkuis']; ?>},
				{matkul: "MK Tdk Berkuisioner", value: <?php echo $mtk_overview['mtk_tdk_berkuis']; ?>},
				{matkul: "MK Berkuisioer Tdk Wajib", value: <?php echo $mtk_overview['mtk_berkuis_tdk_wajib']; ?>}
			],
			commonSeriesSettings: {
				argumentField: "state",
				type: "bar",
				hoverMode: "allArgumentPoints",
				selectionMode: "allArgumentPoints",
				label: {
					visible: true,
					format: "fixedPoint",
					precision: 0,
					customizeText: function() { 
						return this.valueText + " (" + Math.round(this.value / <?php echo $mtk_overview['jumlah_matakuliah']; ?> * 100) + "%)";
					}
				}
			},
			series: {
				argumentField: "matkul",
				valueField: "value",
				name: "Matakuliah",
				type: "bar",
				color: "#30abe0"
			},
			
			legend: {
				visible: false
			},
			pointClick: function (point) {
				this.select();
			}
		
		});	
		
		
		/**********************************
		Doughnut Charts - Matakuliah terisi
		**********************************/
		
		var DoughnutChartdataSource = [
		    {matkul: "100%", val: <?php echo $mtk_persen['seratus_persen']; ?>},
		    {matkul: ">=90%", val: <?php echo $mtk_persen['sembilanpuluh_persen']; ?>},
		    {matkul: ">=80%", val: <?php echo $mtk_persen['delapanpuluh_persen']; ?>},
		    {matkul: ">=70%", val: <?php echo $mtk_persen['tujuhpuluh_persen']; ?>},
		    {matkul: "<70%", val: <?php echo ($mtk_persen['dibawah_persen'] + $mtk_persen['nol_persen']) ?>}
		];
		$("#chart_matkul_terisi").dxPieChart({
		    dataSource: DoughnutChartdataSource,
			legend: {
				horizontalAlignment: "center",
				verticalAlignment: "bttom",
				margin: 15
			},
			series: [{
				type: "doughnut",
				argumentField: "matkul",
				label: {
					visible: true,
					connector: {
						visible: true
					},
					customizeText: function() { 
						return this.valueText + " (" + Math.round(this.value / <?php echo $mtk_overview['mtk_berkuis']; ?> * 100) + "%)";
					}
				}
			}]
		});
		

 
    });
    
</script>
