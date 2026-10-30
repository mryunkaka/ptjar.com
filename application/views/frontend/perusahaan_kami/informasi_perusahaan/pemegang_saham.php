<main id="main">

    <!-- ======= About Section ======= -->
    <section id="komite" class="komite">
        <div class="section-header mt-2 mb-4">
            <h1> <?php echo $this->lang->line('pemegang_saham_judul') ?></h1>
        </div>
        <div class="row g-4 g-lg-5 mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-2"></div>
            <div class="col-sm-8 d-flex align-items-justify mt-4">
                <table class="table table-light  table-hover">
                    <thead>
                        <tr>
                            <th rowspan="2" style="vertical-align : middle;text-align:center;"> <?php echo $this->lang->line('pemegang_saham_keterangan') ?></th>
                            <th colspan="3" style=" text-align: center;"> <?php echo $this->lang->line('pemegang_saham_nominal') ?></th>

                        </tr>
                        <tr>

                            <th scope="col"><?php echo $this->lang->line('pemegang_saham_jumlah_saham') ?></th>
                            <th scope="col"><?php echo $this->lang->line('pemegang_saham_jumlah_nominal') ?></th>
                            <th scope="col"><?php echo $this->lang->line('pemegang_saham_jumlah_kepemilikan') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row"><?php echo $this->lang->line('pemegang_saham_modal_dasar') ?></th>
                            <td>10,000,000,000</td>
                            <td>1,000,000,000,000</td>
                            <td></td>
                        </tr>
                        <tr>
                            <th colspan="4"><?php echo $this->lang->line('pemegang_saham_modal_disetor') ?></th>

                        </tr>
                        <tr>
                            <td>PT EHSAN AGRO SENTOSA</td>
                            <td>6,771,050,000</td>
                            <td>677,105,000,000</td>
                            <td>99.91</td>
                        </tr>
                        <tr>
                            <td>PT SINAR BINTANG MULIA</td>
                            <td>6,000,000</td>
                            <td>600,000,000</td>
                            <td>0.09</td>
                        </tr>
                        <tr>
                            <th><?php echo $this->lang->line('pemegang_saham_modal_jumlah_disetor') ?></th>
                            <th>6,777,050,000</th>
                            <th>677,705,000,000</th>
                            <th>100</th>
                        </tr>
                        <tr>
                            <th><?php echo $this->lang->line('pemegang_saham_modal_jumlah_portpel') ?></th>
                            <th>3,222,950,000</th>
                            <th>322,295,000,000</th>
                            <th></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </section><!-- End About Section -->


</main>