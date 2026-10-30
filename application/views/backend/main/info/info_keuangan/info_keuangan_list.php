 <section class="section">
     <div class="row">
         <div class="col-lg-12">

             <div class="card admin-table-card">
                 <div class="card-body">
                     <div class="row mt-2 admin-table-toolbar">
                         <div class="col-auto">
                             <a href="<?= base_url() ?>Management_Informasi_Keuangan/laporan_form" class="badge bg-info text-dark p-3 mb-3"><i class="bi bi-info-circle me-1"></i>
                                 Tambah Informasi Keuangan
                             </a>
                         </div>

                     </div>
                     <div id="messages"><?= $this->session->flashdata('msg') ?> </div>
                     <!-- Table with stripped rows -->
                     <div class="table-responsive admin-table-wrap" role="region" tabindex="0" aria-label="Tabel informasi keuangan">
                         <table class="table table-striped">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Tahun</th>
                                 <th scope="col">Judul</th>


                                 <th scope="col">Aksi</th>
                             </tr>
                         </thead>

                         <tbody>
                             <?php if (isset($list[0]['vc_group_seq']) !== null) {
                                    $i = 1;
                                    $cnt = 0; ?>

                                 <?php foreach ($list as $sm) : ?>

                                     <tr id="rowtab<?= $sm['vc_group_seq'] ?>">
                                         <th scope="row"><?= $i; ?></th>


                                         <td><?= $sm['vc_tahun']; ?></td>
                                         <td>Informasi Keuangan Tahun <?= $sm['vc_tahun']; ?></td>


                                         <td>
                                             <a href="<?= base_url() ?>Management_Informasi_Keuangan/laporan_edit/<?= $sm['vc_group_seq'] ?>" class="badge bg-info text-dark p-3 mb-3"><i class="bi bi-info-circle me-1"></i>
                                                 Edit
                                             </a>
                                             <a href="#" uuid="<?= $sm['vc_group_seq'] ?>" id="id_del" class="badge bg-danger text-dark p-3 mb-3"><i class="bi bi-info-circle me-1"></i>
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







 </section>

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

 <script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/info_keuangan/info_keuangan_list.js' ?>"></script>