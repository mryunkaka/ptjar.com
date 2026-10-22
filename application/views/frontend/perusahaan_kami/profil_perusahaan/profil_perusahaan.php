<main id="main">
  <!-- ======= About Section ======= -->
  <section id="profil" class="profil ">
    <div class="section-header mt-2">
      <h1> <?php echo $this->lang->line('perusahaan_profil_judul') ?></h2>
    </div>

    <div class="container" data-aos="fade-up">
      <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">



        <div class="col-lg-5">
          <div class="about-img">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
        </div>
      </div>

      <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">
        <h5>
          <p class="text-justify">
            <?php echo $this->lang->line('perusahaan_profil') ?></p>
        </h5>
      </div>


      <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

        <div class="col-lg-12">
          <h3 class="pt-0 pt-lg-5">Visi & Misi</h3>
          <div class="section-header">

            <!-- Tabs -->
            <ul class="nav nav-pills mb-3">
              <li><a class="nav-link active" data-bs-toggle="pill" href="#tab1">Visi</a></li>
              <li><a class="nav-link" data-bs-toggle="pill" href="#tab2">Misi</a></li>
            </ul><!-- End Tabs -->

            <!-- Tab Content -->
            <div class="tab-content">

              <div class="tab-pane fade show active" id="tab1">

                <h4 class="fst-italic"> <?php echo $this->lang->line('perusahaan_visi') ?></p>
                </h4>

              </div><!-- End Tab 1 Content -->


              <?php echo $this->lang->line('perusahaan_misi') ?>





            </div>

          </div>

        </div>

      </div>
  </section><!-- End About Section -->


</main>