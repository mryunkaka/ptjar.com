<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top" data-scrollto-offset="0">


    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="<?= base_url() ?>" class="logo d-flex align-items-center scrollto me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="<?= base_url() ?>assets/file/frontend/image/template/iconjar.png" alt="">

      </a>

      <nav id="navbar" class="navbar">
        <ul>

          <li class="dropdown"><a><span><?php echo $this->lang->line('nav_1') ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="<?= base_url('Profil_Perusahaan') ?>"><?php echo $this->lang->line('nav_1_1') ?></a></li>
              <li class="dropdown"><a><span><?php echo $this->lang->line('nav_1_2') ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="<?= base_url('Dewan_Komisaris') ?>"><?php echo $this->lang->line('nav_1_2_1') ?></a></li>
                  <li><a href="<?= base_url('Direksi') ?>"><?php echo $this->lang->line('nav_1_2_2') ?></a></li>
                </ul>
              </li>
              <li class="dropdown"><a><span><?php echo $this->lang->line('nav_1_3') ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="<?= base_url('Tanggung_Jawab_Dewan_Komisaris') ?>"><?php echo $this->lang->line('nav_1_3_1') ?></a></li>
                  <li><a href="<?= base_url('Tanggung_Jawab_Direksi') ?>"><?php echo $this->lang->line('nav_1_3_2') ?></a></li>
                </ul>
              </li>
              <li class="dropdown"><a><span><?php echo $this->lang->line('nav_1_4') ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>

                  <li><a href="<?= base_url('Komite_Audit') ?>"><?php echo $this->lang->line('nav_1_4_1') ?></a></li>
                  <li><a href="<?= base_url('Sekertaris_Perusahaan') ?>"><?php echo $this->lang->line('nav_1_4_2') ?></a></li>

                </ul>
              </li>

              <li class="dropdown"><a><span><?php echo $this->lang->line('nav_1_5') ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>

                  <li><a href="<?= base_url('Struktur_Organisasi') ?>"><?php echo $this->lang->line('nav_1_5_1') ?></a></li>
                  <li><a href="<?= base_url('Struktur_Group') ?>"><?php echo $this->lang->line('nav_1_5_2') ?></a></li>
                  <li><a href="<?= base_url('Pemegang_Saham') ?>"><?php echo $this->lang->line('nav_1_5_3') ?></a></li>



                </ul>
              </li>

              <li><a href="<?= base_url('Area_Kerja') ?>"><?php echo $this->lang->line('nav_1_6') ?></a></li>
            </ul>

          </li>
          <li class="dropdown"><a><span><?php echo $this->lang->line('nav_2') ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="<?= base_url() ?>Proses_Kerja"><?php echo $this->lang->line('nav_2_1') ?></a></li>
              <li><a href="<?= base_url() ?>Pencapaian_Perusahaan"><?php echo $this->lang->line('nav_2_2') ?></a></li>
              <li><a href="<?= base_url() ?>Target_Produksi"><?php echo $this->lang->line('nav_2_3') ?></a></li>



            </ul>
          </li>

          <li class="dropdown"><a><span><?php echo $this->lang->line('nav_3') ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="<?= base_url() ?>Informasi_Keuangan"><?php echo $this->lang->line('nav_3_1') ?></a></li>
              <li><a href="<?= base_url() ?>Informasi_Produksi"><?php echo $this->lang->line('nav_3_2') ?></a></li>
              <li><a href="<?= base_url() ?>Rilis_Perusahaan"><?php echo $this->lang->line('nav_3_3') ?></a></li>
              <li><a href="<?= base_url() ?>Rups-Rupslb"><?php echo $this->lang->line('nav_3_4') ?></a></li>
              <li><a href="<?= base_url() ?>Tindakan_Korporasi"><?php echo $this->lang->line('nav_3_5') ?></a></li>
              <li><a href="<?= base_url() ?>Laporan_Tahunan"><?php echo $this->lang->line('nav_3_6') ?></a></li>
              <li><a href="<?= base_url() ?>Laporan_Bulanan"><?php echo $this->lang->line('nav_3_7') ?></a></li>
            </ul>
          </li>
          <li class="dropdown"><a><span>Media</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="<?= base_url() ?>Berita"><?php echo $this->lang->line('nav_4_1') ?></a></li>
              <li><a href="<?= base_url() ?>Siaran_Pers"><?php echo $this->lang->line('nav_4_2') ?></a></li>

            </ul>
          </li>


          <li class=" dropdown pull-right"><a><span>CSR</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="<?= base_url() ?>Kegiatan_Sosial"><?php echo $this->lang->line('nav_5_1') ?></a></li>
              <li><a href="<?= base_url() ?>Kebijakan_Kesehatan"><?php echo $this->lang->line('nav_5_2') ?></a></li>
            </ul>
          </li>


          <li class="dropdown"><a><span><?= $_SESSION['site_lang'] == 'ID' ? '<img width="20px" src="' . base_url() . 'assets/Frontend/icon/ina.png">' : '<img width="20px" src="' . base_url() . 'assets/Frontend/icon/uk.png">'; ?><?= $_SESSION['site_lang'] ?></span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="<?php echo base_url("Frontend/Lang/ENG"); ?>" <?= $_SESSION['site_lang'] == 'ENG' ? 'style=" display:none;"' : ''; ?>> <img width="20px" src="<?php echo base_url(); ?>assets/Frontend/icon/uk.png"> ENG</a></li>
              <li> <a href="<?php echo base_url("Frontend/Lang/ID"); ?>" <?= $_SESSION['site_lang'] == 'ID' ? 'style=" display:none;"' : ''; ?>><img width="20px" src="<?php echo base_url(); ?>assets/Frontend/icon/ina.png"> </i>ID</a></li>

            </ul>


          </li>


        </ul>



        <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->

      <a></a>

    </div>
  </header><!-- End Header -->