<main id="main">



    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
        <div class="section-header mt-4 mb-2">
            <h1><?php echo $this->lang->line('informasi_produksi') ?></h1>
        </div>
        <div class="row gy-4 mb-4 p-4">



            <div class="col-xl-12 col-md-6 mb-4" data-aos="zoom-out" data-aos-delay="200">
                <div class="service-item position-relative border">
                    <div class="row gy-4">
                        <div class="col-xl-12 container">
                            <h4>
                                <ul class="" style="list-style-type:none;">
                                    <li class="d-flex justify-content-center"><?php echo $this->lang->line('tbs') ?></li>
                                    <li class="d-flex justify-content-center">(<?php echo $this->lang->line('ton') ?>)</li>
                                </ul>
                            </h4>
                            <hr>
                        </div>
                    </div>
                    <div class=" row gy-4">
                        <?php foreach ($tbs as $sm) : ?>
                            <?php if (isset($sm['vc_tahun']) !== null) { ?>
                                <div class="col-xl-2 container">
                                    <div class="label d-flex justify-content-center h3"><?= $sm['vc_tahun'] ?></div>
                                    <div class="icon ">
                                        <i class="bi bi-bar-chart-line-fill d-flex justify-content-center" style="font-size:120px;"></i>
                                        <div class="label d-flex justify-content-center mt-2 h3"><?= number_format($sm['nu_nominal'], 0) ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endforeach ?>
                    </div>

                </div>
            </div><!-- End Service Item -->
        </div>

        <div class="row gy-4 mb-4 p-4">



            <div class="col-xl-12 col-md-6 mb-4" data-aos="zoom-out" data-aos-delay="200">
                <div class="service-item position-relative border">
                    <div class="row gy-4">
                        <div class="col-xl-12 container">
                            <h4>
                                <ul class="" style="list-style-type:none;">
                                    <li class="d-flex justify-content-center"><?php echo $this->lang->line('cpo') ?></li>
                                    <li class="d-flex justify-content-center">(<?php echo $this->lang->line('ton') ?>)</li>
                                </ul>
                            </h4>
                            <hr>
                        </div>
                    </div>
                    <div class=" row gy-4">
                        <?php foreach ($cpo as $sm) : ?>
                            <?php if (isset($sm['vc_tahun']) !== null) { ?>
                                <div class="col-xl-2 container">
                                    <div class="label d-flex justify-content-center h3"><?= $sm['vc_tahun'] ?></div>
                                    <div class="icon ">
                                        <i class="bi bi-droplet-fill d-flex justify-content-center" style="font-size:120px;"></i>
                                        <div class="label d-flex justify-content-center mt-2 h3"><?= number_format($sm['nu_nominal'], 0) ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endforeach ?>
                    </div>


                </div>
            </div><!-- End Service Item -->
        </div>

        <div class="row gy-4 mb-4 p-4">



            <div class="col-xl-12 col-md-6 mb-4" data-aos="zoom-out" data-aos-delay="200">
                <div class="service-item position-relative border">
                    <div class="row gy-4">
                        <div class="col-xl-12 container">
                            <h4>
                                <ul class="" style="list-style-type:none;">
                                    <li class="d-flex justify-content-center"><?php echo $this->lang->line('kernel') ?></li>
                                    <li class="d-flex justify-content-center">(<?php echo $this->lang->line('ton') ?>)</li>
                                </ul>
                            </h4>
                            <hr>
                        </div>
                    </div>
                    <div class=" row gy-4">
                        <?php foreach ($cpo as $sm) : ?>
                            <?php if (isset($sm['vc_tahun']) !== null) { ?>
                                <div class="col-xl-2 container">
                                    <div class="label d-flex justify-content-center h3"><?= $sm['vc_tahun'] ?></div>
                                    <div class="icon ">
                                        <i class="bi bi-bar-chart-line-fill d-flex justify-content-center" style="font-size:120px;"></i>
                                        <div class="label d-flex justify-content-center mt-2 h3"><?= number_format($sm['nu_nominal'], 0) ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endforeach ?>
                    </div>


                </div>
            </div><!-- End Service Item -->
        </div>
        <div class="row gy-4 mb-4 p-4">



            <div class="col-xl-12 col-md-6 mb-4" data-aos="zoom-out" data-aos-delay="200">
                <div class="service-item position-relative border">
                    <div class="row gy-4">
                        <div class="col-xl-12 container">
                            <h4>
                                <ul class="" style="list-style-type:none;">
                                    <li class="d-flex justify-content-center"><?php echo $this->lang->line('refinery') ?></li>
                                    <li class="d-flex justify-content-center">(<?php echo $this->lang->line('ton') ?>)</li>
                                </ul>
                            </h4>
                            <hr>
                        </div>
                    </div>
                    <div class=" row gy-4">
                        <?php foreach ($cpo as $sm) : ?>
                            <?php if (isset($sm['vc_tahun']) !== null) { ?>
                                <div class="col-xl-2 container">
                                    <div class="label d-flex justify-content-center h3"><?= $sm['vc_tahun'] ?></div>
                                    <div class="icon ">
                                        <i class="bx bxs-factory d-flex justify-content-center" style="font-size:120px;"></i>
                                        <div class="label d-flex justify-content-center mt-2 h3"><?= number_format($sm['nu_nominal'], 0) ?></div>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php endforeach ?>
                    </div>


                </div>
            </div><!-- End Service Item -->
        </div>



    </section><!-- End Featured Services Section -->

</main>