 <section class="section">
     <div class="row">
         <div class="col-lg-12">

             <div class="card">

                 <div class="card-body">
                     <br>

                     <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                         <i class="bi bi-collection me-1"> </i>Buat User
                     </button>
                     <div id="messages"></div>
                     <!-- Table with stripped rows -->
                     <div class="table-responsive ">
                         <table class="table table-striped dt-responsive nowrap" id="crud_table">
                             <thead>
                                 <tr>
                                     <th scope="col">#</th>
                                     <th scope="col">Username</th>
                                     <th scope="col">Nama</th>
                                     <th scope="col">Role</th>
                                     <th scope="col">Status</th>

                                     <th scope="col"></th>

                                 </tr>

                             </thead>
                             <tfoot>
                                 <tr>
                                     <th colspan="6"></th>
                                 </tr>
                             </tfoot>

                         </table>
                         <!-- End Table with stripped rows -->

                     </div>
                 </div>
             </div>

         </div>
     </div>





     <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true">
         <div class="modal-dialog modal-lg">
             <form id="from">
                 <div class="modal-content">
                     <div class="modal-header">
                         <h5 class="modal-title" id="exampleModal1Label">Tambah User</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                         <div class="row  mb-2">
                             <div class="col-md-12 position-relative">
                                 <label for="validationTooltip02" class="form-label">Nama</label>
                                 <input type="text" class="form-control" id="nama" name="nama">

                             </div>



                         </div>
                         <div class="row  mb-2">
                             <div class="col-md-6 position-relative">
                                 <label for="validationTooltip01" class="form-label">Username</label>
                                 <input type="text" class="form-control" id="username" name="username">

                             </div>
                             <div class=" col-md-4 position-relative">
                                 <label for="validationTooltip02" class="form-label">Password</label>
                                 <input type="text" class="form-control" id="password" name="password">
                             </div>

                             <div class="col-md-2 d-flex align-items-end">
                                 <a href='#' class="btn btn-primary  " id="generate">Generate</a>
                             </div>
                         </div>

                         <div class="row">
                             <div class="col-md-12 position-relative">
                                 <label for="exampleFormControlSelect1">Role</label>
                                 <select name="role" id="role" class="form-control">

                                     <?php foreach ($role as $m) : ?>
                                         <option value="<?= $m['vc_code_role']; ?>"><?= $m['vc_role_name']; ?></option>
                                     <?php endforeach; ?>

                                 </select>
                             </div>
                         </div>


                         <div class="row">
                             <div class="col-md-12 position-relative">
                                 <label for="exampleFormControlSelect1">Status</label>
                                 <select class="form-control" id="status" name="status">
                                     <option value="1">Aktif</option>
                                     <option value="0">Nonaktif</option>
                                 </select>
                             </div>
                         </div>

                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                             <a class="btn btn-primary" id="save">Save</a>
                         </div>
                     </div>
             </form><!-- End Custom Styled Validation with Tooltips -->
         </div>
     </div>


 </section>

 <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">

         <div class="modal-content">
             <div class="modal-header" id="editModal-head">

             </div>
             <div class="modal-body" id="editModal-body">


             </div>

             <div class="modal-footer" id="editModal-foot">

             </div>

         </div>
     </div>
 </div>


 <!-- Modal -->


 <script type="text/javascript" src="<?php echo base_url() . 'assets/NiceAdmin/assets/vendor/jquery/jquery.min.js' ?>"></script>
 <script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/global/global.js' ?>"></script>

 <script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>



 <script type="text/javascript" src="<?php echo base_url() . 'assets/DataTables/js/jquery.dataTables.min.js' ?>"></script>
 <link href="<?= base_url(''); ?>assets/DataTables/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/management/managemet_user.js' ?>"></script>

 <script>

 </script>