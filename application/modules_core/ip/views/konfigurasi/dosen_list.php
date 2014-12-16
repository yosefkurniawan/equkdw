<?php $today = date("Y-m-d"); ?>
<div class="col-md-12">

<h1>Konfigurasi Semua Kelas</h1>
<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li class="active">Konfigurasi Matakuliah Bermasalah</li>
</ol>

<br>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->


            <div class="row">
                <div class="col-md-12">
                    <div class="panel colored">
                        <div class="panel-heading blue-bg">
                            <h3 class="panel-title">Daftar Semua Kelas Yang Bermasalah (Tidak ada dosen / Dosen tidak dikenali)</h3>
                        </div>

                        <div class="panel-body">
                            <table border="0" cellpadding="0" cellspacing="0"
                            class="table table-striped table-bordered" id="tabelProblem">
                            <!-- id="advanced-table"> -->
                                <thead>
                                    <tr>
                                        <th style="text-align:center;vertical-align:middle"><strong>Kode Mtk</strong></th>
                                        <th style="text-align:center;vertical-align:middle"><strong>Nama Mtk</strong></th>
                                        <th style="text-align:center;vertical-align:middle"><strong>Grup</strong></th>
                                        <th style="text-align:center;vertical-align:middle"><strong>Unit</strong></th>
                                        <th style="text-align:center;vertical-align:middle"><strong>NIK</strong></th>
                                        <th style="text-align:center;vertical-align:middle"><strong>Nama Dosen</strong></th>
                                        <th style="width:5%"><strong></strong></th>
                                    </tr>
                                </thead>

                                <tbody>
                                <?php $num = 0; if (count($dosen_list) > 0 ) : ?>
                                    <?php foreach ($dosen_list as $dosen): ?>
                                        <tr id="row-<?php echo $num ?>">
                                            <input class="rowNumber" type="hidden" value="<?= $num ?>"/>
                                            <!-- <input class="mykey" type="hidden" value="<?= $dosen->mykey ?>"> -->
                                            <input class="idkelas" type="hidden" value="<?= $dosen->id_kelasb ?>">

                                            <td style="text-align:center;vertical-align:middle"><?= $dosen->kode ?></td>

                                            <td style="vertical-align:middle"><span class="nama-mtk"><?= $dosen->nama_mtk ?></span></td>

                                            <td style="text-align:center;vertical-align:middle"><span class="group-Kelas"><?= $dosen->grup ?></span></td>

                                            <td style="vertical-align:middle"><?= $dosen->unit ?></td>

                                            <td style="vertical-align:middle">
                                                <?php if ($dosen->nik == NULL)  : ?>
                                                <span class="label label-warning dosen-not-identify">Dosen tidak ada</span>
                                                <?php else : ?>                                            
                                                <span class="label label-warning dosen-not-identify" 
                                                            style="display:none"></span>
                                                <?php endif; ?>                      
                                                <span class="nik-dosen"><?= $dosen->nik ?></span></td>

                                            <td style="vertical-align:middle">
                                                <?php if ($dosen->nik == NULL || $dosen->nama_dsn == NULL)  : ?>
                                                <span class="label label-warning dosen-not-identify">Dosen tidak ada</span>
                                                <?php else : ?>                                            
                                                <span class="label label-warning dosen-not-identify" 
                                                            style="display:none"></span>
                                                <?php endif; ?>                      
                                                <span class="nama-dosen"><?= $dosen->nama_dsn ?></span></td>
                                            <td style="text-align:center;vertical-align:middle">
                                                <?php if ($dosen->nik == NULL) : ?>
                                                <!-- create / find -->
                                                    <a href="#myModal" data-toggle="modal" class="btn btn-info btn-xs find-or-create">Input</a> 
                                                <?php elseif($dosen->nama_dsn == NULL)  : ?>
                                                <!-- create -->
                                                    <a href="#myModal" data-toggle="modal" class="btn btn-info btn-xs create">Input</a> 
                                                <?php else : ?>
                                                <!-- edit -->                                            
                                                    <a href="#myModal" data-toggle="modal" class="btn btn-info find-or-create">Input</a> 
                                                <?php endif; ?>                      
                                            </td>
                                        </tr>
                                        <?php $num = $num + 1;?>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="7" style="text-align:center">Selamat! Tidak ada Kelas Yang memiliki masalah data Dosen</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
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
                <h4 class="modal-title"> <strong> 
                    <span id="namaMatkul"></span> 
                    <span id="grupMatkul"></span> 
                </strong> - <span id="idKelasBuka"></span></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rowEdit" value="" class="form-control" />
                <div id="findDosen" style="display:none">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">      
                            <div class="controls">             
                                <input type="text" id="keyword" placeholder="Kata Kunci NIK/Nama" value="" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">                   
                        <a href="#" id="cariDosen" class="btn btn-success">Cari</a>
                    </div>
                </div>
                <br>
                <div class="panel colored">
                    <div class="panel-heading red-bg">
                        <h3 class="panel-title">Hasil Pencarian</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-hover table-striped table-bordered" id="tableDosen">
                            <thead>
                                <tr>
                                    <td width="10%" style="text-align:center;">NIK</td>
                                    <td width="30%">Nama Dosen</td>
                                    <td width="10%" style="text-align:center;">Tindakan</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><td colspan="3" style="text-align:center;">Tidak ada data dosen yang ditemukan</td></tr>
                            </tbody>
                        </table>
                    </div>                  
                </div>
                </div>
                <div id="createDosen" style="display:none">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">      
                            <label class="col-lg-4 control-label">NIK</label>
                            <div class="col-lg-8">             
                                <input type="text" id="nik-create" value="" class="form-control" disabled/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">      
                            <label class="col-lg-4 control-label">Nama Dosen</label>
                            <div class="col-lg-8">             
                                <input type="text" id="nama-create" value="" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">      
                            <label class="col-lg-4 control-label">Gelar Prefix</label>
                            <div class="col-lg-8">             
                                <input type="text" id="prefix-create" value="" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">      
                            <label class="col-lg-4 control-label">Gellar Suffix</label>
                            <div class="col-lg-8">             
                                <input type="text" id="suffix-create" value="" class="form-control" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">      
                            <label class="col-lg-4 control-label">Unit</label>
                            <div class="col-lg-8">             
                                <select class="form-control" id="unit-create">
                                    <?php foreach ($unit_list as $key => $unit): ?>
                                        <option value="<?php echo $unit['id_unit'] ?>">
                                        <?php echo $unit['unit'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">      
                            <label class="col-lg-4 control-label"></label>
                            <div class="col-lg-8">             
                                <a href="#" id="createDosenProcess" class="btn btn-success">Create!</a>
                            </div>
                        </div>
                    </div>
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

		jQuery('.find-or-create').on('click',function(){
	       console.log('find-or-create');
           jQuery('#findDosen').show();
           jQuery('#rowEdit').val(jQuery(this).closest('tr').find('input.rowNumber').val());
           jQuery('#namaMatkul').text(jQuery(this).closest('tr').find('td span.nama-mtk').text());
           jQuery('#grupMatkul').text(jQuery(this).closest('tr').find('td span.group-Kelas').text());
           jQuery('#idKelasBuka').text(jQuery(this).closest('tr').find('input.idkelas').val());
		});

        jQuery('#myModal').on('shown.bs.modal',function(){
           //make auto focus to keyword input area after modal completly loaded
           jQuery('#keyword').focus();            
           return false;
        });

        jQuery('.create').on('click',function(){
           console.log('create');
           jQuery('#createDosen').show();
           jQuery('#nik-create').val(jQuery(this).closest('tr').find('span.nik-dosen').text());
           jQuery('#rowEdit').val(jQuery(this).closest('tr').find('input.rowNumber').val());
           jQuery('#namaMatkul').text(jQuery(this).closest('tr').find('td span.nama-mtk').text());
           jQuery('#grupMatkul').text(jQuery(this).closest('tr').find('td span.group-Kelas').text());
           jQuery('#idKelasBuka').text(jQuery(this).closest('tr').find('input.idkelas').val());
        });

        jQuery('#cariDosen').on('click',function(){
            var keyword = jQuery('#keyword').val();

            if (keyword == '') {
                jQuery('#tableDosen tbody tr').remove();
                jQuery('#tableDosen > tbody:last').append(
                    '<tr><td colspan="3" style="text-align:center;">Tidak ada data dosen yang ditemukan</td></tr>'
                    );
                jQuery('#keyword').closest('div').closest('div').removeClass('has-valid').addClass('has-error').focus();
            } else {

                var item = {};
                var num = 1;
                item[num] = {};
                item[num]['keyword'] = keyword;

                jQuery.ajax({
                    type: "POST",
                    url: CI_ROOT+"ip/konfigurasi/cari_dosen",
                    data: item,
                    success: function(data)
                    {  
                        // console.log(data);
                        if (data.length > 0) {
                            jQuery('#keyword').closest('div').closest('div').removeClass('has-success').addClass('has-success');
                            jQuery('#tableDosen tbody tr').remove();
                            
                            var nik; var nama;
                            for (index = 0; index < data.length; ++index) {
                                nik = data[index]['nik'];
                                nama = data[index]['nama'];
                                if (data[index]['gelar_prefix'] != null ) {
                                    nama = data[index]['gelar_prefix'] + ' ' + nama; 
                                }
                                if (data[index]['gelar_suffix'] != null ) {
                                    nama = nama + ' ' + data[index]['gelar_suffix']; 
                                }

                                jQuery('#tableDosen > tbody:last').append(
                                    '<tr>'+
                                        '<td style="text-align:center;"><span class="nik-pilih">'+nik+'</span></td>'+
                                        '<td><span class="nama-pilih">'+nama+'</span></td>'+
                                        '<td style="text-align:center;"><a href="#" class="btn btn-danger btn-xs pilih-dosen">Pilih</a></td>'+
                                    '</tr>'
                                    );
                            };

                        } else {
                            jQuery('#keyword').closest('div').closest('div').removeClass('has-valid').addClass('has-error').focus();
                            jQuery('#tableDosen tbody tr').remove();
                            jQuery('#tableDosen > tbody:last').append(
                                '<tr><td colspan="3" style="text-align:center;">Tidak ada data dosen yang ditemukan</td></tr>'
                                );
                        }
                        //hiddenkan tombol
                    },
                    error: function (data)
                    {  
                        console.log(data);
                    }
                 });                
                return false;                             
            }
            return false;
        });

        jQuery('#tableDosen').on('click','td a.pilih-dosen',function(){

            var nik = jQuery(this).closest('tr').find('td span.nik-pilih').text();
            var nama = jQuery(this).closest('tr').find('td span.nama-pilih').text();
            var row = jQuery('#rowEdit').val();
            console.log(nik+' '+nama+' '+row);

            //clear all input
            jQuery('#keyword').val('');
            jQuery('#keyword').removeClass('has-error').removeClass('has-success');
            // jQuery('#findDosen').hide();
            jQuery('#tableDosen tbody tr').remove();
            jQuery('#tableDosen > tbody:last').append(
                '<tr><td colspan="3" style="text-align:center;">Tidak ada data dosen yang ditemukan</td></tr>'
                );

            var item = {};
            var num = 1;
            item[num] = {};
            item[num]['id_kelasb'] = jQuery('#idKelasBuka').text();
            item[num]['nik'] = nik;
            console.log(item[num]);
            // return false;

            //pilih proses
            jQuery.ajax({
                type: "POST",
                url: CI_ROOT+"ip/konfigurasi/insert_pengajar",
                data: item,
                success: function(data)
                {  
                    // console.log(data);
                    if (data == true) {
                        jQuery('#tabelProblem tbody tr').each(function(){
                            if (jQuery(this).find('input.rowNumber').val() == row) {
                                jQuery(this).find('td span.nik-dosen').text(nik);
                                jQuery(this).find('td span.nama-dosen').text(nama);                    
                                jQuery(this).find('td span.dosen-not-identify').hide();
                            }
                        });
                        jQuery('#myModal').modal('hide');
                        return false;
                    } else {
                        alert('terjadi kesalahan sistem! Data tidak dapat diproses')
                    }
                    //hiddenkan tombol
                },
                error: function (data)
                {  
                    console.log(data);
                    alert('terjadi kesalahan sistem! Data tidak dapat diproses')
                }
             }); 
        });

        jQuery('#createDosenProcess').on('click',function(){
            var nik = jQuery('#nik-create').val();
            var nama = jQuery('#nama-create').val();
            var prefix = jQuery('#prefix-create').val();
            var suffix = jQuery('#suffix-create').val();
            var row = jQuery('#rowEdit').val();
            var id_unit = jQuery('#unit-create').val();
            var nama_lengkap = nama;

            if (prefix != '' ) {
                nama_lengkap = prefix + ' ' + nama; 
            }
            if (suffix != '' ) {
                nama_lengkap = nama + ' ' + suffix; 
            }

            if (jQuery('nama-create').val() == '' ) {
                alert('nama harus diisi');
            } else {

                var item = {};
                var num = 1;
                item[num] = {};
                item[num]['nik'] = nik;
                item[num]['nama'] = nama;
                item[num]['gelar_prefix'] = prefix;
                item[num]['gelar_suffix'] = suffix;
                item[num]['jenis_kerja'] = 'Dosen';
                item[num]['email'] = '';
                item[num]['status_karyawan'] = '1';
                item[num]['id_unit'] = id_unit;

                console.log(item[num]);
                // return false;

                jQuery.ajax({
                    type: "POST",
                    url: CI_ROOT+"ip/konfigurasi/create_dosen",
                    data: item,
                    success: function(data)
                    {  
                        // console.log(data);
                        if (data == true) {
                            jQuery('#tabelProblem tbody tr').each(function(){

                                if (jQuery(this).find('td span.nik-dosen').text() == nik) {
                                    jQuery(this).find('td span.nama-dosen').text(nama_lengkap);                    
                                    jQuery(this).find('td span.dosen-not-identify').hide();
                                }
                            });

                            jQuery('#createDosen').hide();            
                            jQuery('#myModal').modal('hide');
                        } else {
                            alert('terjadi kesalahan sistem! Data tidak dapat diproses')
                        }
                        //hiddenkan tombol
                    },
                    error: function (data)
                    {  
                        console.log(data);
                        alert('terjadi kesalahan sistem! Data tidak dapat diproses')
                    }
                 }); 
            }
            return false;            
        });

        jQuery('#myModal').on('hidden.bs.modal',function(){

            //clear all input
            jQuery('nik-create').val('');
            jQuery('nama-create').val('');
            jQuery('prefix-create').val('');
            jQuery('suffix-create').val('');
            jQuery('#keyword').val('');
            jQuery('#keyword').removeClass('has-error').removeClass('has-success');
            jQuery('#tableDosen tbody tr').remove();
            jQuery('#tableDosen > tbody:last').append(
                '<tr><td colspan="3" style="text-align:center;">Tidak ada data dosen yang ditemukan</td></tr>'
                );
            //hide all
            jQuery('#findDosen').hide();            
            jQuery('#createDosen').hide();            
        });

    });

    function create_dosen(item) {
            jQuery.ajax({
                type: "POST",
                url: CI_ROOT+"ip/konfigurasi/insert_dosen",
                data: item,
                success: function(data)
                {  
                    console.log(data);
                    alert('data berhasil ditambahkan');
                    //looking for same nik in table, if found, tambahkan

                    //hiddenkan tombol
                },
                error: function (data)
                {  
                    console.log(data);
                }
             });                
            return false;
    }

</script>

