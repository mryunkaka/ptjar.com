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

                        <label for="floatingEmail">Tahun Laporan</label>
                        <input type="number" class="form-control" id="dt_publish" name="dt_publish">

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

                <div class="row mb-20 mt-2">


                    <div class="col-md-6">

                        <label for="floatingEmail">Judul Bahasa Indonesia</label>
                        <input type="text" class="form-control" id="judul_ind" value="<?= $detail[0]['vc_title_idn'] ?>" name="judul_ind" placeholder="Judul Bahasa Indonesia">

                    </div>

                    <div class="col-md-6">

                        <label for="floatingEmail">Judul Bahasa Inggris</label>
                        <input type="text" class="form-control" id="judul_eng" value="<?= $detail[0]['vc_title_eng'] ?>" name="judul_eng" placeholder="Judul Bahasa Inggris">

                    </div>




                </div>
                <div class="row mb-20 mt-2">


                    <div class="col-md-12">

                        <label for="floatingEmail">Catatan</label>
                        <textarea rows="5" type="text" class="form-control" id="vc_note" name="vc_note"><?= $detail[0]['vc_note'] ?></textarea>

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




<script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>
<link rel="stylesheet" href="<?= base_url(''); ?>assets/YearPicker/dist/yearpicker.css">
<script src="<?= base_url(''); ?>assets/YearPicker/dist/yearpicker.js"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/laporan_keuangan/laporan_keuangan_edit.js' ?>"></script>
<script>
    $("#dt_publish").yearpicker({
        year: <?php echo $detail[0]['vc_tahun'] ?>,

    });
</script>