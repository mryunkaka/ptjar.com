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

                        <label for="floatingEmail">Bulan Laporan</label>
                        <input type="month" class="form-control" id="dt_publish" name="dt_publish" placeholder="Your Email">

                    </div>

                    <div class="col-md-6">
                        <label for="floatingEmail">File (PDF max 50 Mb)</label>
                        <input type="file" class="form-control" id="image_berita" name="image_berita" placeholder="Your Email">

                    </div>




                </div>



            </form><!-- End floating Labels Form -->
            <br><br><br> <br><br><br>
            <div class="text-center mt-4">
                <button id="save" class="btn btn-primary">Save</button>

            </div>
        </div>
    </div>
    <br><br><br> <br><br><br> <br><br><br> <br><br><br>
</section>




<script type="text/javascript" src="<?php echo base_url() . 'assets/select2/dist/js/select2.min.js' ?>"></script>
<link href="<?= base_url(''); ?>assets/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/laporan_bulanan/laporan_bulanan2.js' ?>"></script>

<script>
    $("#category").select2();
</script>
