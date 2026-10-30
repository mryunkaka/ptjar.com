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

                <div class="row mb-4">


                    <div class="col-md-3">

                        <label for="floatingEmail">Bulan Paparan Publik</label>
                        <input type="month" class="form-control" id="dt_publish" name="dt_publish" placeholder="Your Email">

                    </div>

                    <div class="col-md-6">
                        <label for="floatingEmail">File (PDF max 50 Mb)</label>
                        <input type="file" class="form-control" id="image_berita" name="image_berita" placeholder="Your Email">

                    </div>




                </div>
                <div class="row mb-2">


                    <div class="col-md-9">

                        <label for="floatingEmail">Catatan</label>
                        <textarea type="month" class="form-control" rows="10" id="vc_note" name="vc_note" placeholder="Catatan"></textarea>
                    </div>




                </div>




            </form><!-- End floating Labels Form -->
            <br><br><br> <br><br><br> <br><br><br> <br>
            <div class="text-center mt-4">
                <button id="save" class="btn btn-primary">Save</button>

            </div>
        </div>
    </div>

</section>





<script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/rilis_perusahaan/paparan_publik/paparan_publik.js' ?>"></script>

<script>
    $("#category").select2();
</script>