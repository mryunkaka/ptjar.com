<main id="main">
  <!-- ======= About Section ======= -->
  <section id="profil" class="profil ">
    <div class="section-header mt-4 mb-4">
      <h1> <?php echo $this->lang->line('rups') ?></h1>
    </div>

    <div class="container" data-aos="fade-up">
      <div class="row g-4 g-lg-5 mt-4 mb-4" data-aos="fade-up" data-aos-delay="200">

        <div class="col-lg-12">

          <div class="accordion" id="accordionExample">
            <?php if (isset($sm['vc_tahun']) !== null) { ?>
              <?php foreach ($list_tahun as $sm) : ?>
                <div class="accordion-item ">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button bg-danger-light" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $sm['vc_tahun'] ?>" aria-expanded="true" aria-controls="collapse<?= $sm['vc_tahun'] ?>">
                      <?= $sm['vc_tahun'] ?>
                    </button>

                  </h2>
                  <div id="collapse<?= $sm['vc_tahun'] ?>" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <ul style="list-style-type:none;">

                        <?php foreach ($rups as $sn) : ?>
                          <?php if ($sn['vc_tahun'] == $sm['vc_tahun']) { ?>
                            <li>
                              <?php if ($this->session->userdata('site_lang') == 'ID') { ?>
                                <p>
                                  <?= $sn['vc_title_idn'] ?><a href="<?php echo base_url() . $url[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                                    <u>Unduh</u></a>
                                  <?php if ($sn['vc_desc_idn'] != NULL || $sn['vc_desc_idn'] != "") { ?>
                                    <br> <i class="ri-arrow-right-circle-line h5"> <?= $sn['vc_desc_idn'] ?></i>
                                  <?php } ?>
                                </p>
                              <?php } else { ?>
                                <p>
                                  <?= $sn['vc_title_eng'] ?><a href="<?php echo base_url() . $url[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                                    <u>Unduh</u></a>
                                  <?php if ($sn['vc_desc_eng'] != NULL || $sn['vc_desc_eng'] != "") { ?>
                                    <br> <i class="ri-arrow-right-circle-line h5"> <?= $sn['vc_desc_eng'] ?></i>
                                  <?php } ?>
                                </p>
                              <?php } ?>
                            </li>
                          <?php } ?>
                        <?php endforeach ?>

                      </ul>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            <?php } ?>
          </div>
        </div>


      </div>

    </div>





  </section><!-- End About Section -->
  <br><br><br>
</main>