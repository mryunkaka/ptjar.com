 <section class="section">
     <div class="row">
         <div class="col-lg-12">

             <div class="card admin-table-card">
                 <div class="card-body">
                     <div class="row mt-2 admin-table-toolbar">
                         <div class="col-auto">
                             <a href="<?= base_url() ?>Management_Berita/berita_form" class="badge bg-info text-dark p-3 mb-3"><i class="bi bi-info-circle me-1"></i>
                                 Tambah Berita
                             </a>
                         </div>
                     </div>
                     <div class="card border mb-3">
                         <div class="card-body">
                             <h5 class="card-title">Impor dari Jhonlin Magazine</h5>
                             <p class="mb-3">Impor 10 berita terbaru atau tarik seluruh arsip. Berita baru disimpan sebagai draft untuk ditinjau.</p>
                             <form id="importNewsForm" method="post" action="<?= site_url('Management_Berita/import_from_jhonlinmagz') ?>" data-batch-url="<?= site_url('Management_Berita/import_all_batch') ?>" class="row g-2 align-items-end">
                                 <input type="hidden" name="<?= html_escape($this->security->get_csrf_token_name()) ?>" value="<?= html_escape($this->security->get_csrf_hash()) ?>">
                                 <div class="col-md-4">
                                     <label for="import_category" class="form-label">Kategori lokal</label>
                                     <select class="form-select" id="import_category" name="category" required>
                                         <option value="">Pilih kategori</option>
                                         <?php foreach ($category as $item) : ?>
                                             <option value="<?= (int) $item['nu_id'] ?>"><?= html_escape($item['vc_category_name']) ?></option>
                                         <?php endforeach ?>
                                     </select>
                                 </div>
                                 <div class="col-md-3">
                                     <label for="import_language" class="form-label">Bahasa</label>
                                     <select class="form-select" id="import_language" name="bahasa" required>
                                         <option value="">Pilih bahasa</option>
                                         <?php foreach ($language as $item) : ?>
                                             <option value="<?= html_escape($item['vc_code']) ?>"><?= html_escape($item['vc_desc']) ?></option>
                                         <?php endforeach ?>
                                     </select>
                                 </div>
                                 <div class="col-md-5 d-flex flex-wrap gap-2">
                                     <button type="submit" name="import_scope" value="recent" class="btn btn-primary" <?= empty($category) || empty($language) ? 'disabled' : '' ?>>
                                         <i class="bi bi-cloud-download me-1"></i> Impor berita terbaru
                                     </button>
                                     <button type="submit" name="import_scope" value="all" class="btn btn-outline-primary" <?= empty($category) || empty($language) ? 'disabled' : '' ?>>
                                         <i class="bi bi-cloud-arrow-down me-1"></i> Tarik semua berita
                                     </button>
                                 </div>
                             </form>
                             <div id="importProgress" class="mt-3" aria-live="polite"></div>
                         </div>
                     </div>
                     <!-- Table with stripped rows -->
                     <div id="messages"><?= isset($flash_message) ? $flash_message : '' ?> </div>
                     <div class="table-responsive admin-table-wrap" role="region" tabindex="0" aria-label="Tabel berita">
                         <table class="table table-striped">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">THUMBNAIL</th>
                                 <th scope="col">TITLE</th>
                                 <th scope="col">CONTENT</th>
                                 <th scope="col">POST</th>
                                 <th scope="col">TANGGAL PUBLISH</th>
                                 <th scope="col">BAHASA</th>
                                 <th scope="col">Aksi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php if (isset($list[0]['nu_id']) !== null) {
                                    $i = 1;
                                    $cnt = 0; ?>

                                 <?php foreach ($list as $sm) : ?>

                                     <tr id="rowtab<?= $sm['nu_id'] ?>">
                                         <th scope="row"><?= $i; ?></th>

                                         <?php if (empty($sm['vc_image'])) { ?>
                                             <td><img src="<?= base_url() . 'assets/file/backend/upload/berita/thumbnail/default/default.png' ?> " class="img-thumbnail" width="120" alt="..."></td>
                                         <?php } else { ?>
                                             <td><img src="<?= base_url() . $url[0]['vc_url'] . $sm['vc_image'] ?> " class="img-thumbnail" width="120" alt="..."></td>
                                         <?php } ?>
                                         </php>
                                         <td><?= html_escape($sm['vc_title']); ?></td>
                                         <td><?= html_escape(word_limiter(strip_tags($sm['vc_content']), 20)); ?></td>
                                         <td>
                                             <?php if ($sm['vc_status'] == 0) { ?>
                                                 <span class="badge rounded-pill bg-warning text-dark">Draft</span>
                                             <?php } else { ?>
                                                 <span class="badge rounded-pill bg-success">Publish</span>
                                             <?php } ?>
                                         </td>
                                         <td><?= date('d-M-Y', strtotime($sm['dt_published'])); ?></td>
                                         <td><img class="border border-secondary" width="20px" src="<?php echo base_url() . $sm['vc_lang_img']; ?>"></td>
                                         <td>
                                             <?php if ((int) $sm['vc_status'] === 0) { ?>
                                                 <form method="post" action="<?= site_url('Management_Berita/publish_berita') ?>" class="d-inline" onsubmit="return confirm('Terbitkan berita ini sekarang?')">
                                                     <input type="hidden" name="uuid" value="<?= html_escape($sm['uuid']) ?>">
                                                     <input type="hidden" name="<?= html_escape($this->security->get_csrf_token_name()) ?>" value="<?= html_escape($this->security->get_csrf_hash()) ?>">
                                                     <button type="submit" class="btn btn-success btn-sm mb-2"><i class="bi bi-send-check me-1"></i>Post</button>
                                                 </form>
                                             <?php } else { ?>
                                                 <form method="post" action="<?= site_url('Management_Berita/unpublish_berita') ?>" class="d-inline" onsubmit="return confirm('Tarik berita ini dari publik dan jadikan Draft?')">
                                                     <input type="hidden" name="uuid" value="<?= html_escape($sm['uuid']) ?>">
                                                     <input type="hidden" name="<?= html_escape($this->security->get_csrf_token_name()) ?>" value="<?= html_escape($this->security->get_csrf_hash()) ?>">
                                                     <button type="submit" class="btn btn-warning btn-sm mb-2"><i class="bi bi-arrow-counterclockwise me-1"></i>Tarik</button>
                                                 </form>
                                             <?php } ?>
                                             <a href="<?= base_url() ?>Management_Berita/berita_preview/<?= $sm['uuid'] ?>" class="badge bg-info text-dark p-3 mb-3"><i class="bi bi-info-circle me-1"></i>
                                                 Preview
                                             </a>
                                             <a href="#" uuid="<?= $sm['uuid'] ?>" id="id_del" class="badge bg-danger text-dark p-3 mb-3"><i class="bi bi-info-circle me-1"></i>
                                                 Delete
                                             </a>
                                         </td>

                                     </tr>
                                     <?php $i++;
                                        $cnt++; ?>
                                 <?php endforeach ?>
                             <?php } ?>

                         </tbody>

                     </table>
                     </div>
                     <!-- End Table with stripped rows -->
                     <?= $pagination ?>
                 </div>
             </div>


         </div>
     </div>





     <div class="modal fade admin-modal" id="deleteModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-lg">

             <div class="modal-content">
                 <div class="modal-header" id="deleteModal-head">

                 </div>
                 <div class="modal-body" id="deleteModal-body">


                 </div>

                 <div class="modal-footer" id="deleteModal-foot">

                 </div>

             </div>
         </div>
     </div>

 </section>

 <script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/berita/berita_list.js' ?>"></script>
