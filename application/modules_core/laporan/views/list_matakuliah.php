<div class="col-md-12">

<div class="page-header">
    <h1>Matakuliah</h1>
</div>

<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
    <li class="active">Matakuliah</li>
</ol>

<?php if(isset($message) && $message != NULL) : ?>
<div class="alert alert-info"> Info : <?php echo $message; ?> </div>
<?php endif ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel colored">
                        <div class="panel-heading blue-bg">
                            <h3 class="panel-title">Daftar Matakuliah</h3>
                        </div>

                        <div class="panel-body">

                          <div class="row">
                                <form action="<?php echo base_url()?>laporan/proses_cari_mtk" method="post">
                                <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" name="unit_id" >
                                        <option value="">SEMUA PRODI</option>
                                        <?php foreach ($list_prodi as $prodi): ?>
                                           <option value="<?php echo $prodi->id_unit ?>" <?php if ($search['unit_id'] == $prodi->id_unit) : echo 'selected'; endif; ?>
                                                ><?php echo $prodi->unit ?> </option>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                                </div>
<!--                                 <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" name="selesai" >
                                        <option value="" <?php if ($search['selesai'] == '') : echo 'selected'; endif; ?> >SEMUA STATUS</option>
                                        <option value="1" <?php if ($search['selesai'] == '1') : echo 'selected'; endif; ?>>LENGKAP</option>
                                        <option value="2" <?php if ($search['selesai'] == '2') : echo 'selected'; endif; ?>>BELUM LENGKAP</option>
                                    </select>
                                </div>
                                </div>
 -->                                <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nama" 
                                    value="<?php if ($search['nama'] == '') : echo ''; else : echo $search['nama']; endif; ?>" placeholder="nim .. atau nama ..."/>
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" name="save" value="Submit" />
                                    <input type="submit" class="btn btn-danger" name="save" value="Reset" />
                                </div>
                                </div>
                                </form>
                            </div> 
                            <?php echo $pages; ?>    

                            <table border="0" cellpadding="0" cellspacing="0"
                            class="table table-striped table-bordered" id="tableMtk">
                            <!-- id="advanced-table"> -->

                                <thead>
                                    <tr>
                                        <th>Kode</th>

                                        <th>Matakuliah</th>

                                        <th>Grup</th>

                                        <th>Unit</th>

                                        <th>Jumlah Peserta</th>

                                        <th>Kuisioner Terisi</th>

                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
									<?php foreach($matkul as $mtk): ?>
									<tr>
										<td><span class="kode-matakuliah"><?php echo $mtk->kode ?></span></td>
										<td><span class="nama-matakuliah"><?php echo $mtk->nama ?></span></td>
                                        <td><span class="grup-matakuliah"><?php echo $mtk->grup ?></span></td>
										<td><span class="unit-prodi"><?php echo $mtk->unit ?></span></td>
										<td><?php echo $mtk->jml_peserta ?></td>
										<td><?php echo ($mtk->terisi)? $mtk->terisi : '0' ?></td>
                                        <td>
                                            <a href="#myModal" class="btn btn-xs green-bg lihat-peserta" data-toggle="modal"><i class="icon-eye-open"></i> Lihat Status Isi </a>
                                        </td>
									</tr>
									<?php endforeach ?>
                                </tbody>
                            </table>
                            Menampilkan Total <?php echo $tot_mtk ?> Data
                            <?php echo $pages; ?>    
                        </div>
                    </div>
                </div>
            </div>
        </div>



<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"> <strong> <span id="namaMatakuliah"> Nama Matakuliah </span> </strong>
                    <br><span id="kodeMatakuliah"> Kode Matakuliah </span> 
                    <br>Grup <span id="grupMatakuliah"> Kode Matakuliah </span> 
                    <br> <span id="prodiMatakuliah">Prodi</span></h4>
            </div>
            <div class="modal-body">
                <div class="panel colored">
                    <div class="panel-heading red-bg">
                        <h3 class="panel-title">Daftar Peserta Kelas</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover" id="tablePeserta">
                            <thead>
                                <tr>
                                    <td width="5%">#</td>
                                    <td width="10%">NIM</td>
                                    <td width="70%">Nama Siswa</td>
                                    <td width="15%">Status</td>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>                  
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn gray-bg" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn blue-bg">Save changes</button> -->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --><!-- Modal -->     

<script>
    jQuery(document).ready(function() {   

        jQuery('.lihat-peserta').on('click',function(){

            dethis = jQuery(this);

            jQuery('#namaMatakuliah').text(dethis.closest('tr').find('span.nama-matakuliah').text());
            jQuery('#kodeMatakuliah').text(dethis.closest('tr').find('span.kode-matakuliah').text());
            jQuery('#prodiMatakuliah').text(dethis.closest('tr').find('span.unit-prodi').text());
            jQuery('#grupMatakuliah').text(dethis.closest('tr').find('span.grup-matakuliah').text());
            console.log('lihat peserta');


            // jQuery(this).text('Aktifkan');

            var item = {};
            var num = 1;
            item[num] = {};
            item[num]['kode'] = jQuery(this).closest('tr').find('span.kode-matakuliah').text();
            item[num]['grup'] = jQuery(this).closest('tr').find('span.grup-matakuliah').text();
            // item[num]['eva_status'] = '0';

            console.log(item[num]);
            // // return false;

            jQuery.ajax({
                type: "POST",
                url: CI_ROOT+"laporan/laporan/getPeserta",
                data: item,
                success: function(data)
                {                      
                    var krs = '';

                    console.log(data);  
                    // return false;

                    jQuery('#tablePeserta tbody tr').fadeOut(function(){
                      jQuery(this).remove();          
                    });
                    // jQuery('#tableKRS tbody tr').remove();

                    for (index = 0; index < data.length; ++index) 
                    {
                        urutan = index + 1;
                        nim = data[index]['nim'];
                        nama = data[index]['nama_lengkap'];
                        jawab = data[index]['id_jawaban'];

                        krs += '<tr>'+
                            '<td><b>'+urutan+'</b></td>'+
                            '<td><strong>'+nim+'</strong></td>'+
                            '<td>'+
                                nama+
                            '</td>'+
                            '<td>';

                        if ( jawab != null ) 
                        {
                            krs += '<span class="label label-success">sudah mengisi</span>';
                        }
                        else 
                        {
                            krs += '<span class="label label-danger">belum mengisi</span>';
                        }
                        krs += '</td></tr>';

                    }

                    jQuery('#tablePeserta tbody').append(krs).fadeIn('slow');

                    // dethis.hide();
                    // dethis.next().show();
                    // dethis.closest('tr').find('td span.punya-kuisioner').hide();
                    // dethis.closest('tr').find('td span.tidak-punya-kuisioner').show();
                },
                error: function (data)
                {  
                    console.log(data);
                }
             });             

            // return false;
        });

    });


</script>

