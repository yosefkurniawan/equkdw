<?php $today = date("Y-m-d"); ?>
<div class="col-md-12">

<h1>Konfigurasi Matakuliah</h1>
<br>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->


            <div class="row">
                <div class="col-md-12">
                    <div class="panel colored">
                        <div class="panel-heading blue-bg">
                            <h3 class="panel-title">Daftar Matakuliah</h3>
                        </div>

                        <div class="panel-body">

                            <div class="row">
                                <form action="<?php echo base_url()?>matakuliah/matakuliah/proses_cari" method="post">
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
                                        <option value="0" <?php if ($search['eva_status'] == '0') : echo 'selected'; endif; ?>>TIDAK ADA KUISIONER</option>
                                        <option value="1" <?php if ($search['eva_status'] == '1') : echo 'selected'; endif; ?>>ADA KUISIONER</option>
                                        <option value="2" <?php if ($search['eva_status'] == '2') : echo 'selected'; endif; ?>>ADA TIDAK WAJIB</option>
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="nama" 
                                    value="<?php if ($search['nama'] == '') : echo ''; else : echo $search['nama']; endif; ?>" placeholder=""/>
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
                            class="table table-striped table-bordered">
                            <!-- id="advanced-table"> -->
                                <thead>
                                    <tr>
                                        <th><strong>Kode</strong></th>

                                        <th><strong>Nama Matakuliah</strong></th>

                                        <th><strong>Unit</strong></th>

                                        <th style="width:13%"><strong>Status Kuisioner</strong></th>

                                        <th style="width:13%"><strong>Ubah Status</strong></th>

                                    </tr>
                                </thead>

                                <tbody>
                                <?php if (count($list_matkul) > 0 ) : ?>
                                    <?php foreach ($list_matkul as $matkul): ?>
                                        <tr>
                                            <td><span class="kode-matakuliah"><?= $matkul->kode ?></span></td>

                                            <td><?= $matkul->nama ?></td>

                                            <td><?= $matkul->unit ?></td>
                                            <td>
                                                <span class="label label-info punya-kuisioner" 
                                                	<?php if ($matkul->eva_status != 1) : echo 'style="display:none"'; endif; ?> >Ada</span>                      
                                                <span class="label label-success punya-kuisioner-tidak-wajib" 
                                                	<?php if ($matkul->eva_status != 2) : echo 'style="display:none"'; endif; ?> >Ada Tidak Wajib</span>                      
                                                <span class="label label-danger tidak-punya-kuisioner" 
                                                	<?php if ($matkul->eva_status != 0) : echo 'style="display:none"'; endif; ?> >Tidak Ada</span>                      
                                            </td>
                                            <td>
                                            	<select class="form-control input-sm ubah-status">
                                            		<option value="1" 
                                            		<?php if ($matkul->eva_status == 1) : echo "selected"; endif; ?> >Ada</option>
                                            		<option value="2" 
                                            		<?php if ($matkul->eva_status == 2) : echo "selected"; endif; ?> >Ada Tidak Wajib</option>
                                            		<option value="0" 
                                            		<?php if ($matkul->eva_status == 0) : echo "selected"; endif; ?> >Tidak Ada</option>
                                            	</select>                                            	
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="5" style="text-align:center">Maaf, Pencarian tidak dapat ditemukan</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                            <?php echo $pages; ?> 
                        </div>
                    </div>
                </div>
            </div>
        </div>

<script>
    
    jQuery(document).ready(function() {   

		jQuery('.ubah-status').on('change',function(){

			console.log("nilai : " + jQuery(this).val());

            dethis = jQuery(this);
			var eva = jQuery(this).val();

            var item = {};
            var num = 1;
            item[num] = {};
            item[num]['kode'] = jQuery(this).closest('tr').find('span.kode-matakuliah').text();
            item[num]['eva_status'] = eva;

            console.log(item[num]);
            // return false;

            jQuery.ajax({
                type: "POST",
                url: CI_ROOT+"matakuliah/matakuliah/gantistatus_ajax",
                data: item,
                success: function(data)
                {  
                    console.log(data);
					
                    dethis.closest('tr').find('td span.punya-kuisioner').hide();
                    dethis.closest('tr').find('td span.punya-kuisioner-tidak-wajib').hide();
                    dethis.closest('tr').find('td span.tidak-punya-kuisioner').hide();

					if (eva == 0) 
					{						
	                    dethis.closest('tr').find('td span.tidak-punya-kuisioner').show();
					}
					else if (eva == 1) 
					{
	                    dethis.closest('tr').find('td span.punya-kuisioner').show();						
					} 
					else if (eva == 2) 
					{	
	                    dethis.closest('tr').find('td span.punya-kuisioner-tidak-wajib').show();						
					}

                },
                error: function (data)
                {  
                    console.log(data);
                }
             });         			
			
			return false;
		});

        jQuery('.non-aktifkan-kuisioner').on('click',function(){

            dethis = jQuery(this);

            console.log('non aktif');
            // jQuery(this).text('Aktifkan');

            var item = {};
            var num = 1;
            item[num] = {};
            item[num]['kode'] = jQuery(this).closest('tr').find('span.kode-matakuliah').text();
            item[num]['eva_status'] = '0';

            console.log(item[num]);
            // return false;

            jQuery.ajax({
                type: "POST",
                url: CI_ROOT+"matakuliah/matakuliah/gantistatus_ajax",
                data: item,
                success: function(data)
                {  
                    console.log(data);

                    dethis.hide();
                    dethis.next().show();
                    dethis.closest('tr').find('td span.punya-kuisioner').hide();
                    dethis.closest('tr').find('td span.tidak-punya-kuisioner').show();
                },
                error: function (data)
                {  
                    console.log(data);
                }
             });                
            return false;
        });

        jQuery('.aktifkan-kuisioner').on('click',function(){

            dethis = jQuery(this);

            console.log('non aktif');
            // jQuery(this).text('Aktifkan');

            var item = {};
            var num = 1;
            item[num] = {};
            item[num]['kode'] = jQuery(this).closest('tr').find('span.kode-matakuliah').text();
            item[num]['eva_status'] = '1';

            console.log(item[num]);
            // return false;

            jQuery.ajax({
                type: "POST",
                url: CI_ROOT+"matakuliah/matakuliah/gantistatus_ajax",
                data: item,
                success: function(data)
                {  
                    console.log(data);
                    dethis.hide();
                    dethis.prev().show();
                    // jQuery(this).removeClass('aktifkan-kuisioner').addClass('non-aktifkan-kuisioner');
                    dethis.closest('tr').find('td span.punya-kuisioner').show();
                    dethis.closest('tr').find('td span.tidak-punya-kuisioner').hide();
                },
                error: function (data)
                {  
                    console.log(data);
                }
             });                
            return false;

        });

    });


</script>

