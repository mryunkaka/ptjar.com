 <section class="section">
     <div class="row">
         <div class="col-lg-12">

             <div class="card">
                 <div class="card-body">
                     <div class="row mt-2">
                         <div class="col-2">
                             <a href="<?= base_url() ?>Management_Berita/berita_form" class="badge bg-info text-dark p-3 mb-3"><i class="bi bi-info-circle me-1"></i>
                                 Tambah Berita
                             </a>
                         </div>
                     </div>
                     <!-- Table with stripped rows -->
                     <div id="messages"><?= $this->session->flashdata('msg') ?> </div>
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
                                 <th scope="col"></th>
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
                                         <td><?= $sm['vc_title']; ?></td>
                                         <td><?= word_limiter($sm['vc_content'], 20); ?></td>
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
                     <!-- End Table with stripped rows -->
                     <?= $pagination ?>
                 </div>
             </div>


         </div>
     </div>





     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
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
 <script type="text/javascript" src="<?php echo base_url() . 'assets/NiceAdmin/assets/vendor/jquery/jquery.min.js' ?>"></script>

 <script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/berita/berita_list.js' ?>"></script>