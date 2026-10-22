<main id="main">
  <!-- ======= About Section ======= -->
  <section id="profil" class="profil ">
    <div class="section-header mt-4 mb-4">
      <h1> <?php echo $this->lang->line('laporan_tahunan') ?></h2>
    </div>

    <div class="container" data-aos="fade-up">
      <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

        <div class="col-lg-12">


          <ul style="list-style-type:none;">
            <li> <?php if (isset($laporan_tahunan) !== null) { ?>
                <?php foreach ($laporan_tahunan as $sn) : ?>
                  <?php if ($this->session->userdata('site_lang') == 'ID') { ?>
                    <a href="<?php echo base_url() . $url[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                      <i class="bi bi-file-earmark-zip-fill d-flex h3"> <span> Laporan Tahunan <?= $sn['vc_tahun'] ?></span></i></a>
                  <?php } else { ?>
                    <a href="<?php echo base_url() . $url[0]['vc_url'] . $sn['vc_url']; ?>" class="icon-block">
                      <i class="bi bi-file-earmark-zip-fill d-flex h3"> <span> Annual Report <?= $sn['vc_tahun'] ?></span></i></a>
                  <?php } ?>
                  <hr>
                <?php endforeach ?>
              <?php } ?>
            </li>
          </ul>


        </div>

      </div>





    </div>
  </section><!-- End About Section -->

</main>