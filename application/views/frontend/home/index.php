<!-- ======= Hero Section ======= -->
<style>
  .carousel-img-alif {
    max-height: 720px;
    width: 100%;
  }
</style>
<main id="main">

  <section id="carousel">
    <div id="carouselExampleFade" class="carousel slide carousel-fade mt-3" data-bs-ride="carousel" data-bs-interval="5000">
      <div class="carousel-inner">
        <div class="carousel-item active">

          <div class="row justify-content-center gy-6">
            <img src="<?= base_url('') ?>assets/file/frontend/image/home/home1.jpg" alt="" class="img-fluid img carousel-img-alif">
            <div class="col-lg-9 text-center">

              <h2 class="color-secondary-light">"Towards Sustainable Resources"</h2>
              <h2 class="color-secondary-light"></h2>

            </div>

          </div>
        </div>

        <div class="carousel-item ">

          <div class="row justify-content-center gy-6">
            <img src="<?= base_url('') ?>assets/file/frontend/image/home/home2.jpg" alt="" class="img-fluid img carousel-img-alif">
            <div class="col-lg-9 text-center">

              <h2 class="color-secondary-light">“Maju, Tumbuh dan Berkembang, Bersama Kita Bisa”</h2>
              <h2 class="color-secondary-light"> </h2>

            </div>

          </div>
        </div>

        <div class="carousel-item">

          <div class="row justify-content-center gy-6">
            <img src="<?= base_url('') ?>assets/file/frontend/image/home/home3.jpg" alt="" class="img-fluid img carousel-img-alif">
            <div class="col-lg-9 text-center">

              <h2 class="color-secondary-light">“Integritas, Konsisten, Berpikir Besar”</h2>


            </div>

          </div>
        </div>


      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </section>

  <!-- ======= Featured Services Section ======= -->
  <section id="featured-services" class="featured-services">
    <div class="container">

      <div class="row gy-4">


        <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="200">
          <div class="service-item position-relative">
            <div class="icon d-flex justify-content-center"><i class="bi bi-gear-wide-connected icon"></i></div>
            <h4>Research & Development</h4>
            <p class="text-justify"><?php echo $this->lang->line('home_research') ?></p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="400">
          <div class="service-item position-relative">
            <div class="icon d-flex justify-content-center"><i class="ri-service-line"></i></div>
            <h4>Long Term Relationship</h4>
            <p class="text-justify"><?php echo $this->lang->line('home_long_term') ?></p>
          </div>
        </div><!-- End Service Item -->

        <div class="col-xl-4 col-md-6 d-flex" data-aos="zoom-out" data-aos-delay="600">
          <div class="service-item position-relative">
            <div class="icon d-flex justify-content-center"><i class="bi bi-graph-up-arrow icon"></i></div>
            <h4>Clients Growth Over Years</h4>
            <p class="text-justify"><?php echo $this->lang->line('home_long_term') ?></p>
          </div>
        </div><!-- End Service Item -->

      </div>

    </div>
  </section><!-- End Featured Services Section -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

        <div class="col-lg-5">
          <div class="about-img">
            <img src="<?= base_url('') ?>assets/file/frontend/image/visimisi/sawit_visimisi.jpg" class="img-fluid" alt="">
          </div>
        </div>

        <div class="col-lg-7">
          <h3 class="pt-0 pt-lg-5">Visi & Misi</h3>

          <!-- Tabs -->
          <ul class="nav nav-pills mb-3">
            <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">Visi</a></li>
            <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">Misi</a></li>
          </ul><!-- End Tabs -->

          <!-- Tab Content -->
          <div class="tab-content">

            <div class="tab-pane fade show active" id="tab1">


              <div class="d-flex align-items-center mt-4">
                <?php echo $this->lang->line('home_visi_list') ?>
              </div>

            </div><!-- End Tab 1 Content -->

            <div class="tab-pane fade show" id="tab2">
              <?php echo $this->lang->line('home_misi_list') ?>

            </div><!-- End Tab 2 Content -->

          </div>

        </div>

      </div>

    </div>
  </section><!-- End About Section -->



  <!-- ======= Services Section ======= -->
  <section id="services" class="services">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Layanan Kami</h2>
      </div>

      <div class="row gy-5">

        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-item">
            <div class="img">
              <img src="<?= base_url('') ?>assets/file/frontend/image/layanan/cpo.JPG" class="img-fluid" alt="">
            </div>
            <div class="details position-relative" style="height:350px">
              <div class="icon">
                <i class="bi bi-activity"></i>
              </div>

              <h3>Crude Palm Oil</h3>

              <p class="text-justify"> <?php echo $this->lang->line('home_layanan_kami_cpo') ?></p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-item">
            <div class="img">
              <img src="<?= base_url('') ?>assets/file/frontend/image/layanan/fame.JPG" class="img-fluid" alt="">
            </div>
            <div class="details position-relative" style="height:350px">
              <div class="icon">
                <i class="bi bi-broadcast"></i>
              </div>

              <h3>Fatty Acid Mettyl Ester</h3>

              <p class="text-justify"> <?php echo $this->lang->line('home_layanan_kami_fame') ?></p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-item">
            <div class="img">
              <img src="<?= base_url('') ?>assets/file/frontend/image/layanan/RBDPO.jpg" class="img-fluid" alt="">
            </div>
            <div class="details position-relative " style="height:350px">
              <div class="icon">
                <i class="bi bi-easel"></i>
              </div>

              <h3>Refined Bleached
                Deodorized Palm Oil</h3>

              <p class="text-justify"> <?php echo $this->lang->line('home_layanan_kami_rbdpo') ?></p>
            </div>
          </div>
        </div><!-- End Service Item -->

      </div>
      <div class="row gy-5">

        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-item">
            <div class="img">
              <img src="<?= base_url('') ?>assets/file/frontend/image/layanan/pfad.jpg" class="img-fluid" alt="">
            </div>
            <div class="details position-relative" style="height:350px">
              <div class="icon">
                <i class="bi bi-activity"></i>
              </div>

              <h3>Palm Fatty Acid Distillate</h3>

              <p class="text-justify"> <?php echo $this->lang->line('home_layanan_kami_pfad') ?></p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-item">
            <div class="img">
              <img src="<?= base_url('') ?>assets/file/frontend/image/layanan/Glycerin.jpg" class="img-fluid" alt="">
            </div>
            <div class="details position-relative" style="height:350px">
              <div class="icon">
                <i class="bi bi-broadcast"></i>
              </div>

              <h3>Crude Glycerin</h3>

              <p class="text-justify"> <?php echo $this->lang->line('home_layanan_kami_cg') ?></p>
            </div>
          </div>
        </div><!-- End Service Item -->

        <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
          <div class="service-item">
            <div class="img">
              <img src="<?= base_url('') ?>assets/file/frontend/image/layanan/fatty meter.jpg" class="img-fluid" alt="">
            </div>
            <div class="details position-relative" style="height:350px">
              <div class="icon">
                <i class="bi bi-easel"></i>
              </div>

              <h3>Fatty Matter</h3>
              <p class="text-justify"> <?php echo $this->lang->line('home_layanan_kami_fm') ?></p>
            </div>
          </div>
        </div><!-- End Service Item -->

      </div>

    </div>
  </section><!-- End Services Section -->





</main><!-- End #main -->