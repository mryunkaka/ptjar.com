      </div>

      </section>
      </div>
      </main><!-- End #main -->

      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Vendor JS Files -->
      <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

      <!-- Shared local template interactions -->
      <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/js/main.js"></script>

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
