<?php $today = date("Y-m-d"); ?>
<div class="col-md-12">

<div class="page-header">
    <h1>Form Klaim Hadiah</h1>
</div>

<ol class="breadcrumb">
    <li><a href="<?= base_url() ?>">Dashboard</a></li>
    <li><a href="<?= base_url().'laporan' ?>">Laporan</a></li>
    <li><a href="<?= base_url().'laporan/status_pengisian' ?>">Status_pengisian</a></li>
    <li class="active">Klaim Hadiah untuk nim : <?= $mahasiswa->nim ?></li>
</ol>
<!-- <a href="<?php echo base_url(); ?>manajemen/user/tambah" class="blue-bg btn btn-med showcase-btn"><i class="icon-file">&nbsp;</i>Tambah User Baru</a> -->


            <div class="row">
                <div class="panel colored col-md-12">
                    <div class="panel-heading blue-bg">
                        <h3 class="panel-title">Klaim Hadiah</h3>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal left-label" action="<?= base_url().'hadiah/klaim/savedab' ?>">
                            <div class="form-group">
                                <label class="control-label col-lg-3">Nim</label>


                                <div class="col-lg-6">
                                    <input  type="hidden" name="nim" value="<?=$mahasiswa->nim?>">
                                    <input class="form-control" disabled type="text" value="<?=$mahasiswa->nim?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Nama</label>

                                <div class="col-lg-6">
                                    <input class="form-control" disabled type="text" value="<?=$mahasiswa->nama_lengkap?>">
                                </div>

                                <div class="col-lg-6">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Matakuliah diambil</label>

                                <div class="col-lg-6">
                                    <input class="form-control" disabled type="text" value="<?=$mahasiswa->matakuliah_diambil?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Matakuliah berkuisioner</label>

                                <div class="col-lg-6">
                                    <input class="form-control" disabled type="text" value="<?=$mahasiswa->matakuliah_berkuisioner?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Kuisioner terisi</label>

                                <div class="col-lg-6">
                                    <input class="form-control" disabled type="text" value="<?=$mahasiswa->kuisioner_terisi?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-3">Berikan Hadiah</label>

                                <div class="col-lg-6">
                                    <select name="hadiah" class="col-lg-12 chzn-nopadd chzn-select-no-single">
                                        <option value="" <?php if($mahasiswa->hadiah == "" OR $mahasiswa->hadiah == null) : ?> selected <?php endif ?> > - </option>
                                        <option value="tas" <?php if($mahasiswa->hadiah == "tas") : ?> selected <?php endif ?> > Tas </option>
                                        <option value="onigiri" <?php if($mahasiswa->hadiah == "onigiri") : ?> selected <?php endif ?> > Onigiri </option>
                                        <option value="minuman" <?php if($mahasiswa->hadiah == "minuman") : ?> selected <?php endif ?> > Minuman </option>
                                    </select>
                                </div>
                            </div>


                    </div>

                    <div class="panel-footer clearfix">
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <input type="submit" class="btn btn-med blue-bg" value="submit">
                                <a class="btn btn-med gray-bg" href="<?= base_url().'laporan/status_pengisian' ?>"
                                href="#">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                        </form>


</div>



