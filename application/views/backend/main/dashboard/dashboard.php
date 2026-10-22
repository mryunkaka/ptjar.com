<section class="section dashboard">
    <div class="row mb-12">


        <!-- Revenue Card -->
        <div class="col-xxl-6 col-md-6">
            <div class="card info-card revenue-card">

                <div class="card-body">
                    <h5 class="card-title">Berita</span></h5>

                    <div class="d-flex align-items-center">

                        <div class="ps-3">
                            <h6> <?= $cnt_berita[0]['cnt'] ?></h6>

                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Revenue Card -->
        <div class="col-xxl-6 col-md-6">
            <div class="card info-card revenue-card">


                <div class="card-body">
                    <h5 class="card-title">Siaran Pers</span></h5>

                    <div class="d-flex align-items-center">

                        <div class="ps-3">
                            <h6> <?= $cnt_pers[0]['cnt'] ?></h6>


                        </div>
                    </div>
                </div>

            </div>
        </div><!-- End Revenue Card -->


    </div>
    <br>
    <br> <br> <br>
    <br> <br> <br>
    <br> <br> <br>
    <br> <br> <br>
    <br> <br> <br>
    <br> <br> <br>


</section>
<script type="text/javascript" src="<?php echo base_url() . 'vendor/main/js/global/global1.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/NiceAdmin/assets/vendor/jquery/jquery.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'vendor/DataTables1/js/jquery.dataTables.min.js' ?>"></script>
<link href="<?= base_url(''); ?>vendor/DataTables1/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="<?php echo base_url() . 'vendor/main/js/dashboard/dashboard.js' ?>"></script>