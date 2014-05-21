<?php $today = date("Y-m-d"); ?>
<div class="col-md-12">

<div class="page-header">
    <h1>Hasil Evaluasi</h1>
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
                            <h3 class="panel-title">Daftar Matakuliah</h3>

                        </div>

                        <div class="panel-body">
                            <table border="0" cellpadding="0" cellspacing="0"
                            class="table table-striped table-bordered" id="advanced-table">

                                <thead>
                                    <tr>
                                        <th>Nim</th>

                                        <th>Nama lengkap</th>

                                        <th>Unit</th>

                                        <th>Matakuliah diambil</th>

                                        <th>Matakuliah berkuisioner</th>

                                        <th>Sudah diisi</th>

                                        <th>Status</th>

                                        <th>Tindakan</th>
                                    </tr>
                                </thead>

                                <tbody>
									<?php foreach ($list_pengisian as $pengisian): ?>
	                                    <tr>
	                                        <td><?= $pengisian->nim ?></td>

	                                        <td><?= $pengisian->nama_lengkap ?></td>

	                                        <td><?= $pengisian->unit ?></td>

                                            <td><?= $pengisian->matakuliah_diambil ?></td>

                                            <td><?= $pengisian->matakuliah_berkuisioner ?></td>

                                            <td><?= $pengisian->kuisioner_terisi ?></td>

                                            <td>
                                                <?php if ($pengisian->matakuliah_berkuisioner != 0) : ?>
                                                    <?php if (($pengisian->kuisioner_terisi / $pengisian->matakuliah_berkuisioner) == 1) : ?>
                                                        <span class="label label-success">lengkap</span>                     
                                                    <?php else : ?>
                                                        <span class="label label-warning">belum lengkap</span>                     
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                        <span class="label label-info">tidak punya kuisioner</span>                     
                                                <?php endif;?>
                                            </td>

                                            <td>
                                                <?php if ($pengisian->matakuliah_berkuisioner != 0) : ?>
                                                    <?php if (($pengisian->kuisioner_terisi / $pengisian->matakuliah_berkuisioner) == 1) : ?>
                                                        <?php if ($pengisian->hadiah == "" OR $pengisian->hadiah == null) : ?>
                                                            <a href="<?=base_url()?>hadiah/klaim/beri/<?=$pengisian->nim?>" 
                                                                class="blue-bg btn btn-xs showcase-btn"><i class="icon-pencil"></i>&nbsp;Klaim Hadiah</a>
                                                        <?php else : ?>
                                                            <a href="<?=base_url()?>hadiah/klaim/beri/<?=$pengisian->nim?>" 
                                                                class="blue-bg btn btn-xs showcase-btn"><i class="icon-pencil"></i>&nbsp;Ganti Hadiah</a>
                                                                <br>
                                                                Hadiah : <?=$pengisian->hadiah?>
                                                        <?php endif; ?>
   
                                                    <?php endif; ?>
                                                <?php endif;?>
                                            </td>

	                                    </tr>
	                                <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



