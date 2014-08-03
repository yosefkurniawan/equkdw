<div class="page-header">
    <h1>Tahun Ajaran 2012/2013 "Gasal"</h1>
</div>

<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
    <li class="active">IP Dosen</li>
</ol>


	<div id="container" style="min-width: 300px; height: 300px; margin: 1em"></div>
	<button id="export">export</button>
	<div id="imgContainer"></div>

	<table class="table">
		<thead>
			<th><strong>Nama Dosen</strong></th>
			<th><strong>Lihat Laporan</strong></th>
		</thead>
		<tbody>
		<?php $i=0; while($i < count($dosen)) : ?>
			<tr>
				<td><?php echo $dosen[$i]->nama_dsn ?></td>
				<td><a href ="<?php echo base_url(); ?>ip/ip/detail_dosen_pdf">Lihat Laporan</a> </td>
			</tr>
		<?php $i++; endwhile; ?>
		</tbody>
	</table>


<script type="text/javascript">

var CI_ROOT = '<?php echo base_url(); ?>';

$(function () {
    $('#container').highcharts({
        title: {
            text: 'Combination chart'
        },
        xAxis: {
            categories: ['O1', 'O2', 'O3', 'O4', 'O5']
        },
        series: [{
            type: 'column',
            name: 'Jane',
            data: [3, 2, 1, 3, 4]
        }, {
            type: 'spline',
            name: 'Average',
            data: [3, 2.67, 3, 6.33, 3.33],
            marker: {
            	lineWidth: 2,
            	lineColor: Highcharts.getOptions().colors[3],
            	fillColor: 'white'
            }
        }, {
            type: 'spline',
            name: 'Average',
            data: [4, 3.67, 4, 7.33, 4.33],
            marker: {
            	lineWidth: 2,
            	lineColor: Highcharts.getOptions().colors[3],
            	fillColor: 'white'
            }
        }]
    });
});

$('#export').click(function () {
    var obj = {},
        chart;

	var exportUrl;    

    chart = $('#container').highcharts();
    obj.svg = chart.getSVG();
    obj.type = 'image/png';
    obj.width = 450; 
    obj.async = true;
    
    $.ajax({
        type: 'post',
        url: chart.options.exporting.url,        
        data: obj, 
        success: function (data) {            
            exportUrl = this.url,
                imgContainer = $("#imgContainer");
            $('<img>').attr('src', exportUrl + data).attr('width','250px').appendTo(imgContainer);
            $('<a>or Download Here</a>').attr('href',CI_ROOT+'ip/ip/laporan/?param='+exportUrl + data).appendTo(imgContainer);

            // $('img').fadeIn();

            // var gambar = {};
            // var number = 1;
            // gambar[number] = {}
            // gambar[number]['isi'] = '<p>Hello Bimo</p>';            

            // alert(window.location.href + '?param=' + exportUrl + data);

		    // $.ajax({
		    //     type: 'post',
		    //     url: CI_ROOT+'ip/ip/laporan',        
		    //     data: gambar, 
		    //     success: function (data) {            
		    //     	console.log('berhasil');
		    //     }
		    // });

        },
      	complete: function(){
      		// window.location.replace(CI_ROOT+'ip/ip/laporan'+ '?param=' + exportUrl + data);
        }        
    });


});

    

</script>
