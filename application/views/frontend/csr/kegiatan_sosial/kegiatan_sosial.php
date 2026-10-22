  <!-- ======= Hero Section ======= -->
  <style>
      .carousel-img-alif {
          max-height: 720px;
          width: 100%;
      }
  </style>

  <section>
      <div id="carouselExampleFade" class="carousel slide carousel-fade mt-3" data-bs-ride="carousel" data-bs-interval="5000">
          <div class="carousel-inner">
              <div class="carousel-item active">

                  <div class="row justify-content-center gy-6">
                      <img src="<?= base_url('') ?>assets/file/frontend/image/kegiatan_sosial/kegsos1.jpg" alt="" class="img-fluid img carousel-img-alif">
                      <div class="col-lg-9 text-center">

                          <h2 class="color-secondary-light"></h2>
                          <h2 class="color-secondary-light"> </h2>

                      </div>

                  </div>
              </div>

              <div class="carousel-item ">

                  <div class="row justify-content-center gy-6">
                      <img src="<?= base_url('') ?>assets/file/frontend/image/kegiatan_sosial/kegsos2.jpg" alt="" class="img-fluid img carousel-img-alif">
                      <div class="col-lg-9 text-center">

                          <h2 class="color-secondary-light"></h2>
                          <h2 class="color-secondary-light"> </h2>

                      </div>

                  </div>
              </div>

              <div class="carousel-item">

                  <div class="row justify-content-center gy-6">
                      <img src="<?= base_url('') ?>assets/file/frontend/image/kegiatan_sosial/kegsos3.jpg" alt="" class="img-fluid img carousel-img-alif">
                      <div class="col-lg-9 text-center">

                          <h2 class="color-secondary-light"></h2>


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


  <section id="des">
      <div class="row g-4 g-lg-5 mb-5" data-aos="fade-up" data-aos-delay="200">


          <div class="col-2"></div>
          <div class="col-sm-8 d-flex align-items-justify mt-4">
              <H2><b> <?php echo $this->lang->line('kegiatan_sosial_head') ?></p></b></H4>
          </div>
      </div>

      <div class="row g-4 g-lg-5 mb-5" data-aos="fade-up" data-aos-delay="200">
          <div class="col-2"></div>
          <div class="col-sm-8 d-flex align-items-justify mt-4">
              <h5>
                  <p class="text-justify">
                      <?php echo $this->lang->line('kegiatan_sosial') ?></p>
              </h5>
          </div>
      </div>
  </section>