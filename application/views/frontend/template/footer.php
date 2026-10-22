<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

  <div class="footer-content">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="footer-info">
            <p style="font-size:25px">PT JHONLIN AGRO RAYA Tbk</p><br>
            <h5><?php echo $this->lang->line('nav_office') ?></h5>
            <p>
              Jl. Kodeco KM 1, Kelurahan Gunung
              Antasari, Kecamatan Simpang Empat, Kabupaten
              Tanah Bumbu,Kalimantan Selatan 72213<br><br>


            </p>
            <h5><?php echo $this->lang->line('nav_ops') ?></h5>
            <p>
              Desa Batu Ampar, Kecamatan Simpang Empat, Kabupaten
              Tanah Bumbu,Kalimantan Selatan 72213<br><br>
            </p>
            <strong>Phone:</strong> +62 518 2090000 Ext.7525<br>
            <strong>Fax:</strong> +62 518 2090001<br>
            <strong>Email:</strong><a href=" mailto:corsec@ptjar.com"> corsec@ptjar.com</a> <br>
          </div>
        </div>

        <div class=" col-lg-2 col-md-6 footer-links">
          <h4><?php echo $this->lang->line('nav_1') ?></h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>">Home</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Profil_Perusahaan"><?php echo $this->lang->line('nav_1_1') ?></a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Dewan_Komisaris"><?php echo $this->lang->line('nav_1_2_1') ?></a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Direksi"><?php echo $this->lang->line('nav_1_2_2') ?></a></li>

            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Tanggung_Jawab_Dewan_Komisaris"><?php echo $this->lang->line('nav_1_2_1_f') ?></a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Tanggung_Jawab_Direksi"><?php echo $this->lang->line('nav_1_2_2_f') ?></a></li>

            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Komite_Audit"><?php echo $this->lang->line('nav_1_4_1') ?></a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Sekertaris_Perusahaan"><?php echo $this->lang->line('nav_1_4_2') ?></a></li>


            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Area_Kerja"><?php echo $this->lang->line('nav_1_5') ?></a></li>
          </ul>
        </div>
        <div class=" col-lg-2 col-md-6 footer-links">
          <h4><?php echo $this->lang->line('nav_2') ?></h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Proses_Kerja"><?php echo $this->lang->line('nav_2_1') ?></a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Pencapaian_Perusahaan"><?php echo $this->lang->line('nav_2_2') ?></a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Target_Produksi"><?php echo $this->lang->line('nav_2_3') ?></a></li>

          </ul>
        </div>
        <div class=" col-lg-2 col-md-6 footer-links">
          <h4>Media</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url() ?>Berita"><?php echo $this->lang->line('nav_4_1') ?></a></li>
            <li><i class="bi bi-chevron-right"></i> <a href=""><?php echo $this->lang->line('nav_4_2') ?></a></li>

          </ul>
        </div>
        <div class=" col-lg-2 col-md-6 footer-links">
          <h4>CSR</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url('Kegiatan_Sosial') ?>"><?php echo $this->lang->line('nav_5_1') ?></a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="<?= base_url('Kebijakan_Kesehatan') ?>"><?php echo $this->lang->line('nav_5_2') ?></a></li>

          </ul>
        </div>


      </div>
    </div>
  </div>

  <div class="footer-legal text-center">
    <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

      <div class="d-flex flex-column align-items-center align-items-lg-start">
        <div class="copyright">
          &copy; 2022 <strong><span>PT. JAR </span></strong>. All Rights Reserved
        </div>

      </div>

      <!-- <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div> -->
      <div class="align-items-center align-items-lg-end">
        <a href="<?php echo base_url("Frontend/Lang/ENG"); ?>">EN |</a>
        <a href="<?php echo base_url("Frontend/Lang/ID"); ?>">ID</a>
      </div>
    </div>
  </div>

</footer><!-- End Footer -->

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/aos/aos.js"></script>
<script src="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= base_url('assets/HeroBiz-pro') ?>/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= base_url('assets/HeroBiz-pro') ?>/assets/js/main.js"></script>

<script>
(function () {
    var csrfName = <?= json_encode($this->security->get_csrf_token_name()); ?>;
    var csrfHash = <?= json_encode($this->security->get_csrf_hash()); ?>;
    document.querySelectorAll('form').forEach(function (form) {
        if ((form.getAttribute('method') || 'get').toLowerCase() !== 'post') return;
        var field = form.querySelector('input[name="' + csrfName + '"]');
        if (!field) {
            field = document.createElement('input');
            field.type = 'hidden';
            field.name = csrfName;
            form.appendChild(field);
        }
        field.value = csrfHash;
    });
})();
</script>

</body>

</html>
