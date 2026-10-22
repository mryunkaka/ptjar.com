<main id="main">



    <!-- ======= Featured Services Section ======= -->
    <section id="featured-services" class="featured-services">
        <div class="section-header mt-4 mb-2">
            <h1><?php echo $this->lang->line('informasi_keuangan') ?></h2>
        </div>
        <div class="row gy-4 mb-4 p-4">
            <div class="row">


                <div class="col-xl-6 col-md-6 mb-4" data-aos="zoom-out" data-aos-delay="200">
                    <div class="service-item position-relative border">
                        <div class="row gy-4">
                            <div class="col-xl-12 container">
                                <h4>
                                    <ul class="" style="list-style-type:none;">
                                        <li class="d-flex justify-content-center"><?php echo $this->lang->line('asset') ?></li>
                                        <li class="d-flex justify-content-center">(<?php echo $this->lang->line('dalam_miliyar') ?>)</li>
                                    </ul>
                                </h4>
                                <hr>
                            </div>
                        </div>
                        <div class=" row gy-4">
                            <?php foreach ($asset as $sm) : ?>
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



                <div class="col-xl-6 col-md-6 mb-4" data-aos="zoom-out" data-aos-delay="200">
                    <div class="service-item position-relative border">
                        <div class="row gy-4">
                            <div class="col-xl-12 container">
                                <h4>
                                    <ul class="" style="list-style-type:none;">
                                        <li class="d-flex justify-content-center"><?php echo $this->lang->line('kewajiban') ?></li>
                                        <li class="d-flex justify-content-center">(<?php echo $this->lang->line('dalam_miliyar') ?>)</li>
                                    </ul>
                                </h4>
                                <hr>
                            </div>
                        </div>
                        <div class=" row gy-4">
                            <?php foreach ($kewajiban as $sm) : ?>
                                <?php if (isset($sm['vc_tahun']) !== null) { ?>
                                    <div class="col-xl-2 container">
                                        <div class="label d-flex justify-content-center h3"><?= $sm['vc_tahun'] ?></div>
                                        <div class="icon ">
                                            <i class="bi bi-graph-down d-flex justify-content-center" style="font-size:120px;"></i>
                                            <div class="label d-flex justify-content-center mt-2 h3"><?= number_format($sm['nu_nominal'], 0) ?></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>

                    </div>
                </div><!-- End Service Item -->





            </div>


            <div class="row">


                <div class="col-xl-6 col-md-6 mb-4" data-aos="zoom-out" data-aos-delay="200">
                    <div class="service-item position-relative border">
                        <div class="row gy-4">
                            <div class="col-xl-12 container">
                                <h4>
                                    <ul class="" style="list-style-type:none;">
                                        <li class="d-flex justify-content-center"><?php echo $this->lang->line('ekuitas') ?></li>
                                        <li class="d-flex justify-content-center">(<?php echo $this->lang->line('dalam_miliyar') ?>)</li>
                                    </ul>
                                </h4>
                                <hr>
                            </div>
                        </div>
                        <div class=" row gy-4">
                            <?php foreach ($ekuitas as $sm) : ?>
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



                <div class="col-xl-6 col-md-6 mb-4" data-aos="zoom-out" data-aos-delay="200">
                    <div class="service-item position-relative border">
                        <div class="row gy-4">
                            <div class="col-xl-12 container">
                                <h4>
                                    <ul class="" style="list-style-type:none;">
                                        <li class="d-flex justify-content-center"><?php echo $this->lang->line('laba') ?></li>
                                        <li class="d-flex justify-content-center">(<?php echo $this->lang->line('dalam_miliyar') ?>)</li>
                                    </ul>
                                </h4>
                                <hr>
                            </div>
                        </div>
                        <div class=" row gy-4">
                            <div class=" row gy-4">
                                <?php foreach ($laba as $sm) : ?>
                                    <?php if (isset($sm['vc_tahun']) !== null) { ?>
                                        <div class="col-xl-2 container">
                                            <div class="label d-flex justify-content-center h3"><?= $sm['vc_tahun'] ?></div>
                                            <div class="icon ">
                                                <i class="bi bi-graph-up-arrow d-flex justify-content-center" style="font-size:120px;"></i>
                                                <div class="label d-flex justify-content-center mt-2 h3"><?= number_format($sm['nu_nominal'], 0) ?></div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php endforeach ?>

                            </div>
                            <div class=" row gy-4">
                                <?php echo $this->lang->line('laba_ket') ?>
                            </div>

                        </div>
                    </div><!-- End Service Item -->





                </div>
            </div>
        </div>
        <div class="row gy-4 mb-4 p-4">
            <div class="row">
                <hr>
            </div>
        </div>
        <div class="row gy-4 mb-4 p-4">
            <div class="row">
                <?php if (isset($sm['vc_tahun']) !== null) { ?>
                    <?php foreach ($tahun_file as $sm) : ?>

                        <div class="col-sm-2 container">
                            <ul style="list-style-type:none;">
                                <li class="h3"><?= $sm['vc_tahun'] ?> </li>
                            </ul>
                            <?php foreach ($get_file as $sn) : ?>
                                <?php if ($sn['vc_tahun'] == $sm['vc_tahun']) { ?>
                                    <ul style="list-style-type:none;">
                                        <li>
                                            <?php if ($this->session->userdata('site_lang') == 'ID') { ?>
                                                <a href="<?php echo base_url() . $url[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                                                    <i class="bi bi-file-earmark-zip-fill d-flex"> <span><?= $sn['vc_title_idn'] ?></span></i></a>
                                            <?php } else { ?>
                                                <a href="<?php echo base_url() . $url[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                                                    <i class="bi bi-file-earmark-zip-fill d-flex"> <span><?= $sn['vc_title_eng'] ?></span></i></a>


                                            <?php } ?>
                                        </li>
                                    </ul>
                                <?php } ?>
                            <?php endforeach ?>
                        </div>

                    <?php endforeach ?>
                <?php } ?>
            </div>
        </div>

    </section><!-- End Featured Services Section -->

</main>