<section>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"></h5>

            <!-- Floating Labels Form -->

            <form class="row g-3 " id="from">
                <input type="hidden" id="base" value="<?php echo base_url(); ?>">


                <div class="row mb-4">
                    <label for="inputText" class="col-sm-1 col-form-label">Tahun</label>
                    <div class="col-sm-1">
                        <input type="number" class="form-control dt_publish" id="dt_publish" name="dt_publish" placeholder="Tahun">

                    </div>
                </div>
                <div class="row mb-3">
                    <b>
                        <div class="col-sm-7">
                            Penulisan Format miliyar(contoh: 9.000.000.000 ditulis 9)
                        </div>
                    </b>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-1 col-form-label">Total Asset</label>
                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control nominal" placeholder="Total Asset" name='asset' aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-1 col-form-label">Total Kewajiban</label>
                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control nominal" placeholder="Total Kewajiban" name='kewajiban' aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-1 col-form-label">Total Ekuitas</label>
                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control nominal" placeholder="Total Ekuitas" name='ekuitas' aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-1 col-form-label">Laba Bersih</label>
                    <div class="col-sm-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Rp</span>
                            <input type="text" class="form-control nominal" placeholder="Laba Bersih" name='laba' aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                    </div>
                </div>

            </form><!-- End General Form Elements -->



            <br><br><br> <br><br><br>
            <div class="text-center mt-4">
                <button id="save" class="btn btn-primary">Save</button>

            </div>
        </div>
    </div>
    <br><br><br> <br><br>
</section>



<script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>
<link rel="stylesheet" href="<?= base_url(''); ?>assets/YearPicker/dist/yearpicker.css">
<script src="<?= base_url(''); ?>assets/YearPicker/dist/yearpicker.js"></script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/info_keuangan/info_keuangan.js' ?>"></script>
<script>
    $('.dt_publish').yearpicker();
</script>