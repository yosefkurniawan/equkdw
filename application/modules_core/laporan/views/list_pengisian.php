<?php $today = date("Y-m-d"); ?>
<div class="page-header">
    <h1>Monitoring Status Pengisian Mahasiswa</h1>
</div>

<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
    <li class="active">Status Pengisian</li>
</ol>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->

<?php if($message != NULL || $message !='') : ?>
<div class="alert alert-info"> Info : <?php echo $message; ?> </div>
<?php endif ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel colored">
                        <div class="panel-heading blue-bg">
                            <h3 class="panel-title">Daftar Mahasiswa</h3>

                        </div>

                        <div class="panel-body">


                            <div class="row">
                                <form action="<?php echo base_url()?>laporan/proses_cari" method="post">
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
                                <div class="col-md-3">
                                <div class="form-group">
                                    <select class="form-control" name="eva_status" >
                                        <option value="" <?php if ($search['eva_status'] == '') : echo 'selected'; endif; ?> >SEMUA STATUS</option>
                                        <option value="1" <?php if ($search['eva_status'] == '1') : echo 'selected'; endif; ?>>SELESAI</option>
                                        <option value="2" <?php if ($search['eva_status'] == '2') : echo 'selected'; endif; ?>>BELUM SELESAI</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-3">
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
                            Menampilkan Total <span class="text text-danger"><?php echo $tot_mhs ?></span> Data
                            <table border="0" cellpadding="0" cellspacing="0"
                            class="table table-striped table-bordered">

                                <thead>
                                    <tr>
                                        <th rowspan="2" style="text-align:center;vertical-align:middle">Nim</th>

                                        <th rowspan="2" style="text-align:center;vertical-align:middle">Nama lengkap</th>

                                        <th rowspan="2" style="text-align:center;vertical-align:middle">Unit</th>

                                        <th rowspan="2" style="text-align:center;vertical-align:middle">KRS</th>

                                        <th colspan="3" style="text-align:center;vertical-align:middle">Kuisioner</th>

                                        <th rowspan="2" style="text-align:center;vertical-align:middle">Status</th>

                                        <th rowspan="2" style="text-align:center;vertical-align:middle"></th>

                                        <!-- <th>Tindakan</th> -->
                                    </tr>                                    
                                    <tr>

                                        <th style="text-align:center;vertical-align:middle" width="7%">Wajib</th>

                                        <th style="text-align:center;vertical-align:middle" width="7%">Opsional</th>

                                        <th style="text-align:center;vertical-align:middle" width="7%">Wajib Terisi</th>


                                        <!-- <th>Tindakan</th> -->
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if(count($list_pengisian)) : ?>
                                    <?php foreach ($list_pengisian as $pengisian): ?>
                                        <tr>
                                            <td style="text-align:center;vertical-align:middle"><span class="nim-mahasiswa"><?= $pengisian->nim ?></span></td>

                                            <td><span class="nama-mahasiswa"><?= $pengisian->nama_lengkap ?></span></td>

                                            <td><span class="prodi-mahasiswa"><?= $pengisian->unit ?></span></td>

                                            <td style="text-align:center;vertical-align:middle"><?= $pengisian->matakuliah_diambil ?></td>

                                            <td style="text-align:center;vertical-align:middle" class="text-danger"><?= $pengisian->matakuliah_berkuisioner ?></td>

                                            <td style="text-align:center;vertical-align:middle"><?= $pengisian->matakuliah_berkuisioner_opsional ?></td>

                                            <td style="text-align:center;vertical-align:middle"  class="text-danger"><?= $pengisian->kuisioner_terisi ?></td>

                                            <td style="text-align:center;vertical-align:middle">
                                                <?php if ($pengisian->matakuliah_berkuisioner != 0) : ?>
                                                    <?php if (($pengisian->kuisioner_terisi / $pengisian->matakuliah_berkuisioner) == 1) : ?>
                                                        <span class="label label-success">lengkap</span>                     
                                                    <?php else : ?>
                                                        <span class="label label-warning">belum lengkap</span>                     
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                        <span class="label label-info">tidak punya</span>                     
                                                <?php endif;?>  
                                            </td>
                                            <td style="text-align:center;vertical-align:middle">
                                                <a href="#myModal" class="btn btn-xs green-bg lihat-krs" data-toggle="modal"><i class="icon-eye-open"></i> Lihat Status </a>                                                
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="8" style="text-align:center">Data tidak ditemukan</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            Menampilkan Total <?php echo $tot_mhs ?> Data
                            <?php echo $pages ?>
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
                <h4 class="modal-title"> <strong> <span id="namaMahasiswa"> Nama Mahasiswa </span> </strong> - <span id="nimMahasiswa">NIM</span> - <span id="prodiMahasiswa">Prodi</span></h4>
            </div>
            <div class="modal-body">
                <div class="panel colored">
                    <div class="panel-heading red-bg">
                        <h3 class="panel-title">Kuisioner Wajib</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover" id="tableKRS">
                            <thead>
                                <tr>
                                    <td width="25%">Matakuliah</td>
                                    <td width="5%">Grup</td>
                                    <td width="5%">Status</td>
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



        jQuery('.lihat-krs').on('click',function(){
                
/* 		    jQuery('body').append('<div class="loading"><div>Loading...</div></div>'); */

            dethis = jQuery(this);

            jQuery('#namaMahasiswa').text(dethis.closest('tr').find('span.nama-mahasiswa').text());
            jQuery('#nimMahasiswa').text(dethis.closest('tr').find('span.nim-mahasiswa').text());
            jQuery('#prodiMahasiswa').text(dethis.closest('tr').find('span.prodi-mahasiswa').text());
            console.log('lihat krs');
            // jQuery(this).text('Aktifkan');

            var item = {};
            var num = 1;
            item[num] = {};
            item[num]['nim'] = jQuery(this).closest('tr').find('span.nim-mahasiswa').text();
            // item[num]['eva_status'] = '0';

            console.log(item[num]);
            // return false;

            jQuery.ajax({
                type: "POST",
                url: CI_ROOT+"laporan/laporan/getKRS",
                data: item,
                success: function(data)
                {                      
                    var krs = '';

                    console.log(data);  

                    jQuery('#tableKRS tbody tr').fadeOut(function(){
                      jQuery(this).remove();          
                    });
                    // jQuery('#tableKRS tbody tr').remove();

                    for (index = 0; index < data.length; ++index) 
                    {
                        nama_matkul = data[index]['nama_matkul'];
                        nama_dosen = data[index]['nama_dosen'];
                        grup = data[index]['grup'];
                        eva_status = data[index]['eva_status'];
                        jawaban = data[index]['jawaban'];

                        krs += '<tr>'+
                            '<td><strong>'+nama_matkul+'</strong><br>'+
                                nama_dosen+
                            '</td>'+
                            '<td>'+
                                grup+
                            '</td>'+
                            '<td>';

                        if ( eva_status == 1 ) 
                        {
                            if ( jawaban != '-')
                            {
                                krs += '<span class="label label-success">sudah diisi</span>';
                            }
                            else 
                            {
                                krs += '<span class="label label-warning">belum diisi</span>';
                            }
                        }
                        else if (eva_status == 2)
                        {
                            if ( jawaban != '-')
                            {
                                krs += '<span class="label label-success">sudah diisi (tidak wajib)</span>';
                            }
                            else 
                            {
                                krs += '<span class="label label-warning">belum diisi (tidak wajib)</span>';
                            }
                        }
                        else 
                        {
                            krs += '<span class="label label-info">tidak ada kuisioner</span>';
                        }
                        krs += '</td></tr>';

                    }

                    jQuery('#tableKRS tbody').append(krs).fadeIn('slow');

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


