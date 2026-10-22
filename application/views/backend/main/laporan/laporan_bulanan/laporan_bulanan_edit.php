<style>
    .select2 {
        width: 100% !important;
    }
</style>
<section>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"></h5>

            <!-- Floating Labels Form -->

            <form class="row g-3 " id="from">
                <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                <input type="hidden" id="id_update" name="id_update" value="<?php echo $detail[0]['nu_id'] ?>">

                <div class="row mb-20" id="cnt_file">

                    <div class="col-md-3">

                        <label for="floatingEmail">Bulan Laporan</label>
                        <input type="month" class="form-control" id="dt_publish" name="dt_publish" value="<?= date_format(date_create($detail[0]['vc_tahun'] . '-' . $detail[0]['vc_bulan']), "Y-m") ?>" placeholder="Your Email">

                    </div>

                    <div class="col-md-3 d-flex align-items-end" id="f_file1">

                        <?php if (!empty($detail[0]['vc_url'])) { ?>
                            <a href="<?php echo base_url() . $url[0]['vc_url'] . $detail[0]['vc_url']; ?>" class="icon-block">
                                <i class="h1 ri-file-zip-fill"> </i>
                                <span>Laporan</span>
                            </a>

                    </div>
                    <div class="col-md-3 d-flex align-items-end" id="f_file2">

                        <a href="#" class="badge bg-danger text-dark p-2 " id="delete_file"><i class="bi bi-info-circle me-1"></i>
                            Hapus File
                        </a>
                    </div>

                <?php } else { ?>

                    <div class="col-md-6">

                        <label for="floatingEmail">File (PDF max 50 Mb)</label>
                        <input type="file" class="form-control" id="image_berita" name="image_berita" placeholder="Your Email">


                    </div>

                <?php } ?>
                <div class="col-md-6" id='tmp_files'>
                </div>

                </div>



            </form><!-- End floating Labels Form -->
            <br><br><br> <br><br><br>
            <div class="text-center mt-4">
                <button id="update" class="btn btn-primary">Update</button>

            </div>
        </div>
    </div>
    <br><br><br> <br><br><br> <br><br><br> <br><br><br>
</section>



<script type="text/javascript" src="<?php echo base_url() . 'assets/NiceAdmin/assets/vendor/jquery/jquery.min.js' ?>"></script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/select2/dist/js/select2.min.js' ?>"></script>
<link href="<?= base_url(''); ?>assets/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/laporan_bulanan/laporan_bulanan_edit.js' ?>"></script>

<script>
    $("#category").select2();
</script>