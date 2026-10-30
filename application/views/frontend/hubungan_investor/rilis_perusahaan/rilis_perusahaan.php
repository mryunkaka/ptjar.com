<main id="main">
  <!-- ======= About Section ======= -->
  <section id="profil" class="profil ">
    <div class="section-header mt-4">
      <h1> <?php echo $this->lang->line('rilis_perusahaan') ?></h1>
    </div>

    <div class="container" data-aos="fade-up">
      <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

        <div class="col-lg-6">

          <ul style="list-style-type:none;">
            <h3 class="pt-0 pt-lg-5"><?php echo $this->lang->line('rilis_paparan') ?></h3>
          </ul>
          <ul style="list-style-type:none;">
            <li> <?php if (isset($paparan_publik) !== null) { ?>
                <?php foreach ($paparan_publik as $sn) : ?>
                  <?php if ($this->session->userdata('site_lang') == 'ID') { ?>
                    <a href="<?php echo base_url() . $url_paparan[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                      <i class="bi bi-file-earmark-zip-fill d-flex h3"> <span> Iklan Prospektus <?= $sn['vc_tahun'] ?></span></i></a>
                  <?php } else { ?>
                    <a href="<?php echo base_url() . $url_paparan[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                      <i class="bi bi-file-earmark-zip-fill d-flex h3"> <span> Prospectus Advertisement <?= $sn['vc_tahun'] ?></span></i></a>
                  <?php } ?>
                <?php endforeach ?>
              <?php } ?>
            </li>
          </ul>


        </div>
        <div class="col-lg-6">


          <ul style="list-style-type:none;">
            <h3 class="pt-0 pt-lg-5"><?php echo $this->lang->line('rilis_rupst') ?></h3>
          </ul>
          <ul style="list-style-type:none;">
            <li>

              <?php if (isset($pemegang_saham) !== null) { ?>
                <?php foreach ($pemegang_saham as $sn) : ?>
                  <?php if ($this->session->userdata('site_lang') == 'ID') { ?>
                    <a href="<?php echo base_url() . $url_rupst[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                      <i class="bi bi-file-earmark-zip-fill d-flex h3"> <span> RUPS Tahunan <?= $sn['vc_tahun'] ?></span></i></a>
                  <?php } else { ?>
                    <a href="<?php echo base_url() . $url_rupst[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                      <i class="bi bi-file-earmark-zip-fill d-flex h3"> <span> Annual Shareholders <?= $sn['vc_tahun'] ?></span></i></a>
                  <?php } ?>
                <?php endforeach ?>
              <?php } ?>
            </li>
          </ul>

        </div>
      </div>





    </div>
  </section><!-- End About Section -->

</main>