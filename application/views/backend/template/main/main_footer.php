    </section>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" untuk mengakhiri sesi anda.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="post" action="<?= html_escape(base_url('auth/logout')); ?>">
                        <button class="btn btn-primary" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main><!-- End #main -->
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>PT.JAR</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/chart.js/chart.min.js"></script>
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="<?= base_url('assets/NiceAdmin/'); ?>assets/js/main.js"></script>

    <script>
    (function () {
        var csrfName = <?= json_encode($this->security->get_csrf_token_name()); ?>;
        var csrfHash = <?= json_encode($this->security->get_csrf_hash()); ?>;
        function addToken(form) {
            if ((form.getAttribute('method') || 'get').toLowerCase() !== 'post') return;
            var field = form.querySelector('input[name="' + csrfName + '"]');
            if (!field) {
                field = document.createElement('input');
                field.type = 'hidden';
                field.name = csrfName;
                form.appendChild(field);
            }
            field.value = csrfHash;
        }
        document.querySelectorAll('form').forEach(addToken);
        document.addEventListener('submit', function (event) { addToken(event.target); }, true);
        if (window.jQuery) {
            jQuery(document).ajaxSend(function (_event, _xhr, settings) {
                if ((settings.type || 'GET').toUpperCase() !== 'POST') return;
                if (window.FormData && settings.data instanceof FormData) {
                    if (!settings.data.has(csrfName)) settings.data.append(csrfName, csrfHash);
                } else if (typeof settings.data === 'string') {
                    if (!new RegExp('(?:^|&)' + encodeURIComponent(csrfName) + '=').test(settings.data)) {
                        settings.data += (settings.data ? '&' : '') + encodeURIComponent(csrfName) + '=' + encodeURIComponent(csrfHash);
                    }
                } else {
                    settings.data = settings.data || {};
                    if (settings.data[csrfName] === undefined) settings.data[csrfName] = csrfHash;
                }
            });
        }
    })();
    </script>

    </body>

    </html>
