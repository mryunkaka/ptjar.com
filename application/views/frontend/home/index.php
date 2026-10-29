<!-- ======= Hero Section ======= -->
<style>
  .carousel-img-alif {
    max-height: 720px;
    width: 100%;
  }

  .recruitment-notice-modal .modal-dialog {
    width: min(92vw, 1060px);
    max-width: none;
    margin: 3vh auto;
  }

  .recruitment-notice-modal .modal-content {
    position: relative;
    overflow: hidden;
    max-height: 94vh;
    border: 0;
    border-radius: 12px;
    background: #080706;
    box-shadow: 0 24px 90px rgba(0, 0, 0, .65);
  }

  .modal-backdrop.recruitment-notice-backdrop.show {
    opacity: .9;
  }

  .recruitment-notice-modal__close {
    position: absolute;
    top: .65rem;
    right: .65rem;
    z-index: 5;
    width: 2.5rem;
    height: 2.5rem;
    padding: .75rem;
    border: 1px solid rgba(255, 255, 255, .55);
    border-radius: 50%;
    background-color: rgba(255, 255, 255, .72);
    background-size: 48%;
    filter: invert(1);
    opacity: .95;
  }

  .recruitment-notice-modal .modal-body {
    position: relative;
    min-height: 0;
    padding: 3.5rem 4.25rem 1rem;
    background: #080706;
    overflow-y: auto;
    overscroll-behavior: contain;
    scrollbar-width: none;
    -ms-overflow-style: none;
  }

  .recruitment-notice-modal .modal-body::-webkit-scrollbar {
    display: none;
  }

  .recruitment-notice-modal__slide {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .recruitment-notice-modal__slide a {
    display: flex;
    width: 100%;
    justify-content: center;
    align-items: flex-start;
    background: #080706;
  }

  .recruitment-notice-modal__slide a:focus-visible {
    outline: 3px solid #f0c52a;
    outline-offset: -4px;
  }

  .recruitment-notice-modal__slide img {
    display: block;
    width: auto;
    max-width: 100%;
    height: auto;
    object-fit: contain;
  }

  .recruitment-notice-modal .carousel-control-prev-icon,
  .recruitment-notice-modal .carousel-control-next-icon {
    width: 2.7rem;
    height: 2.7rem;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, .58);
    background-size: 52%;
    filter: drop-shadow(0 1px 3px rgba(0, 0, 0, .85));
  }

  .recruitment-notice-modal .carousel-control-prev,
  .recruitment-notice-modal .carousel-control-next {
    position: fixed;
    opacity: 1;
    top: 50%;
    bottom: auto;
    width: 3.5rem;
    height: 3.5rem;
    transform: translateY(-50%);
  }

  .recruitment-notice-modal .carousel-control-prev {
    left: max(.5rem, calc((100vw - min(92vw, 1060px)) / 2 - 3.75rem));
  }

  .recruitment-notice-modal .carousel-control-next {
    right: max(.5rem, calc((100vw - min(92vw, 1060px)) / 2 - 3.75rem));
  }

  .recruitment-notice-modal__close {
    top: .5rem;
    right: .5rem;
  }

  @media (max-width: 575.98px) {
    .recruitment-notice-modal .modal-dialog {
      width: 98vw;
      max-width: none;
      margin: 2vh auto;
    }

    .recruitment-notice-modal .modal-content {
      max-height: 96vh;
    }

    .recruitment-notice-modal .modal-body {
      padding: 3.5rem 3.25rem .75rem;
    }

    .recruitment-notice-modal .carousel-control-prev {
      left: .25rem;
    }

    .recruitment-notice-modal .carousel-control-next {
      right: .25rem;
    }

    .recruitment-notice-modal .carousel-control-prev-icon,
    .recruitment-notice-modal .carousel-control-next-icon {
      width: 2.4rem;
      height: 2.4rem;
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .recruitment-notice-modal .carousel-item {
      transition: none;
    }
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

<div class="modal fade recruitment-notice-modal" id="recruitment-warning-modal" tabindex="-1" aria-label="Pengumuman resmi: Waspada Penipuan Rekrutmen" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <button type="button" class="btn-close recruitment-notice-modal__close" data-bs-dismiss="modal" aria-label="Tutup pengumuman"></button>

      <div class="modal-body">
        <div id="recruitment-notice-carousel" class="carousel slide" role="region" aria-roledescription="carousel" aria-label="Poster klarifikasi rekrutmen" data-bs-touch="true" data-bs-wrap="true" data-bs-interval="false">
          <div class="carousel-inner" aria-live="polite">
            <div class="carousel-item active" role="group" aria-roledescription="slide" aria-label="Poster 1 dari 2">
              <div class="recruitment-notice-modal__slide">
                <a href="<?= base_url('assets/file/frontend/image/recruitment/klarifikasi-rekrutmen-1.jpeg') ?>" target="_blank" rel="noopener noreferrer" aria-label="Buka poster klarifikasi rekrutmen bagian pertama ukuran penuh">
                  <img src="<?= base_url('assets/file/frontend/image/recruitment/klarifikasi-rekrutmen-1.jpeg') ?>" alt="Klarifikasi resmi PT Jhonlin Agro Raya Tbk tentang modus penipuan rekrutmen dan tanda-tanda permintaan transfer, bagian 1 dari 2." width="1920" height="2560" decoding="async">
                </a>
              </div>
            </div>
            <div class="carousel-item" role="group" aria-roledescription="slide" aria-label="Poster 2 dari 2">
              <div class="recruitment-notice-modal__slide">
                <a href="<?= base_url('assets/file/frontend/image/recruitment/klarifikasi-rekrutmen-2.jpeg') ?>" target="_blank" rel="noopener noreferrer" aria-label="Buka poster klarifikasi rekrutmen bagian kedua ukuran penuh">
                  <img src="<?= base_url('assets/file/frontend/image/recruitment/klarifikasi-rekrutmen-2.jpeg') ?>" alt="Imbauan untuk memverifikasi lowongan melalui kanal resmi PT Jhonlin Agro Raya Tbk dan kontak resmi perusahaan, bagian 2 dari 2." width="1920" height="2560" loading="lazy" decoding="async">
                </a>
              </div>
            </div>
          </div>

          <button class="carousel-control-prev" type="button" data-bs-target="#recruitment-notice-carousel" data-bs-slide="prev" aria-label="Poster sebelumnya">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#recruitment-notice-carousel" data-bs-slide="next" aria-label="Poster berikutnya">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
(function () {
  function showRecruitmentNotice() {
    var modalElement = document.getElementById('recruitment-warning-modal');
    if (!modalElement || !window.bootstrap || !window.bootstrap.Modal) return;
    modalElement.addEventListener('shown.bs.modal', function () {
      var backdrops = document.querySelectorAll('.modal-backdrop');
      var backdrop = backdrops[backdrops.length - 1];
      if (backdrop) backdrop.classList.add('recruitment-notice-backdrop');
    });
    window.bootstrap.Modal.getOrCreateInstance(modalElement).show();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', showRecruitmentNotice, { once: true });
  } else {
    showRecruitmentNotice();
  }
})();
</script>
