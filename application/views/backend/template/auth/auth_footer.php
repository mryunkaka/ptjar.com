      </div>

      </section>
      </div>
      </main><!-- End #main -->

      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Vendor JS Files -->
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/vendor/chart.js/chart.min.js"></script>
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/vendor/echarts/echarts.min.js"></script>
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/vendor/quill/quill.min.js"></script>
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/vendor/tinymce/tinymce.min.js"></script>
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/vendor/php-email-form/validate.js"></script>

      <!-- Template Main JS File -->
      <script src="<?= base_url('assets/vendor/NiceAdmin/'); ?>assets/js/main.js"></script>

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
