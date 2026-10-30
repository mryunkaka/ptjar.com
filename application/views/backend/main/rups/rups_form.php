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

                <div class="row mb-20">


                    <div class="col-md-3">

                        <label for="floatingEmail">Tahun Laporan</label>
                        <input type="number" class="form-control dt_publish" id="dt_publish" name="dt_publish">

                    </div>

                    <div class="col-md-6">
                        <label for="floatingEmail">File (PDF max 50 Mb)</label>
                        <input type="file" class="form-control" id="image_berita" name="image_berita" placeholder="Your Email">

                    </div>




                </div>
                <div class="row mb-20 mt-3">


                    <div class="col-md-6">

                        <label for="floatingEmail">Judul Bahasa Indonesia</label>
                        <input type="text" class="form-control" id="judul_ind" name="judul_ind" placeholder="Judul Bahasa Indonesia">

                    </div>

                    <div class="col-md-6">

                        <label for="floatingEmail">Judul Bahasa Inggris</label>
                        <input type="text" class="form-control" id="judul_eng" name="judul_eng" placeholder="Judul Bahasa Inggris">

                    </div>




                </div>

                <div class="row mb-20 mt-3">


                    <div class="col-md-6">

                        <label for="floatingEmail"> Deskripsi Bahasa Indonesia</label>
                        <input type="text" class="form-control" id="desc_ind" name="desc_ind" placeholder="Deskripsi Bahasa Indonesia">

                    </div>

                    <div class="col-md-6">

                        <label for="floatingEmail">Deskripsi Bahasa Inggris</label>
                        <input type="text" class="form-control" id="desc_eng" name="desc_eng" placeholder="Deskripsi Bahasa Inggris">

                    </div>




                </div>
                <div class="row mb-20 mt-2">


                    <div class="col-md-12">

                        <label for="floatingEmail">Catatan</label>
                        <textarea rows="5" type="text" class="form-control" id="vc_note" name="vc_note"></textarea>

                    </div>





                </div>




            </form><!-- End floating Labels Form -->
            <br><br><br> <br><br><br>
            <div class="text-center mt-4">
                <button id="save" class="btn btn-primary">Save</button>

            </div>
        </div>
    </div>
    <br><br><br>
</section>




<script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>
<link rel="stylesheet" href="<?= base_url(''); ?>assets/YearPicker/dist/yearpicker.css">
<script src="<?= base_url(''); ?>assets/YearPicker/dist/yearpicker.js"></script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/rups/rups.js' ?>"></script>
<script>
    $('.dt_publish').yearpicker();
</script>
