<section>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"></h5>

            <!-- Floating Labels Form -->

            <form class="row g-3 " id="from">
                <input type="hidden" id="base" value="<?php echo base_url(); ?>">

                <div class="row mb-20">


                    <div class="col-md-3">

                        <label for="floatingEmail">Bulan</label>
                        <input type="month" class="form-control" id="dt_publish" name="dt_publish" placeholder="Bulan">

                    </div>

                    <div class="col-md-6">
                        <label for="floatingEmail">File (PDF max 50 Mb)</label>
                        <input type="file" class="form-control" id="image_berita" name="image_berita" placeholder="Your Email">

                    </div>




                </div>
                <div class="row mb-20 mt-2">


                    <div class="col-md-6">

                        <label for="floatingEmail">Judul Bahasa Indonesia</label>
                        <input type="text" class="form-control" id="judul_ind" name="judul_ind" placeholder="Judul Bahasa Indonesia">

                    </div>

                    <div class="col-md-6">

                        <label for="floatingEmail">Judul Bahasa Inggris</label>
                        <input type="text" class="form-control" id="judul_eng" name="judul_eng" placeholder="Judul Bahasa Inggris">

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
    <br><br><br> <br><br><br>
</section>



<script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/tindakan_korporasi/tindakan_korporasi.js' ?>"></script>