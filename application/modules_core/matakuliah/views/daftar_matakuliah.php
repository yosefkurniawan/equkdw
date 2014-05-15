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
                            <table border="0" cellpadding="0" cellspacing="0"
                            class="table table-striped table-bordered" id="advanced-table">

                                <thead>
                                    <tr>
                                        <th>Kode</th>

                                        <th>Nama Matakuliah</th>

                                        <th>Unit</th>

                                        <th>Status</th>

                                        <th>Tindakan</th>

                                    </tr>
                                </thead>

                                <tbody>
									<?php foreach ($list_matkul as $matkul): ?>
	                                    <tr>
	                                        <td><?= $matkul->kode ?></td>

	                                        <td><?= $matkul->nama ?></td>

	                                        <td><?= $matkul->unit ?></td>

                                            <?php if ($matkul->eva_status == 1) : ?>
	                                        <td>
                                                    <span class="label label-info">Punya Kuisioner</span>                      
                                            </td>
                                            <td>
                                                <a href="<?=base_url()?>matakuliah/gantistatus/<?=$matkul->kode?>/<?=$matkul->eva_status?>" onclick="return confirm('Apakah anda yakin akan menonaktifkan?')">Non Aktifkan</a>
                                            </td>
                                            <?php else : ?>
                                            <td>
                                                <span class="label label-danger">Tidak Memiliki Kuisioner</span>                      
                                            </td>
                                            <td>
                                                <a href="<?=base_url()?>matakuliah/gantistatus/<?=$matkul->kode?>/<?=$matkul->eva_status?>" onclick="return confirm('Apakah anda yakin akan mengaktifkan?')">Aktifkan</a>
                                            </td>
                                            <?php endif; ?>
	                                    </tr>
	                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



