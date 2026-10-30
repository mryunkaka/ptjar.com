<style>
    .select2 {
        width: 100% !important;
    }
</style>
<section>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>

            <!-- Floating Labels Form -->

            <form class="row g-3" id="from">
                <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="floatingSelect">Bahasa</label>
                        <select class="form-select bahasa" id="bahasa" name="bahasa" aria-label="State">
                            <?php foreach ($language as $sm) : ?>
                                <option value="<?= $sm['vc_code'] ?>"><?= $sm['vc_desc'] ?></option>
                            <?php endforeach ?>

                        </select>


                    </div>
                </div>
                <div class="row">

                    <div class="col-md-3">
                        <label for="floatingSelect">Category</label>
                        <select class="form-select category" id="category" name="category" aria-label="State">
                            <?php foreach ($category as $sm) : ?>

                                <option value="<?= $sm['nu_id'] ?>"><?= $sm['vc_category_name'] ?></option>

                            <?php endforeach ?>


                        </select>


                    </div>
                    <div class="col-md-3">

                        <label for="floatingEmail">Publish Date</label>
                        <input type="date" class="form-control" id="dt_publish" name="dt_publish" placeholder="Your Email">

                    </div>
                    <div class="col-md-3">
                        <label for="floatingSelect">Posting</label>
                        <select class="form-select" id="post_sts" name="post_sts" aria-label="State">
                            <option value="0" selected>Draft</option>
                            <option value="1">Publish</option>

                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="col-md-12">
                            <label class="form-check-label" for="gridCheck1">
                                Headline
                            </label>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <label class="form-check-label" for="gridCheck1">
                                    Set As Headline
                                </label>
                                <input class="form-check-input" type="checkbox" id="headline_sts" name="headline_sts" value="1">

                            </div>
                        </div>
                    </div>





                </div>
                <div class="row ">
                    <div class="col-md-4 mt-2">

                        <label for="inputEmail4" class="form-label">Image</label>
                    </div>
                    <!-- <div class="col-md-2 mt-2">

                        <label for="inputEmail4" class="form-label">Tumbnail</label>
                    </div> -->
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-2" id="img-container">

                        <div class="row" id="row_0">

                            <div class="col-md-8 mb-2">
                                <input type="file" class="form-control" id="image_0" name='image_berita[]'>
                            </div>


                        </div>
                    </div>

                    <div class="col-md-4 mb-2">
                        <div class="col-md-4 mb-2" id="img-button">
                            <a href="#" id="add_image"><span class="badge rounded-pill bg-primary p-3 ms-2"><i class="ri-add-fill"></i></span></a>
                            <a href="#" id="delete_image"><span class="badge rounded-pill bg-danger p-3 ms-2"> <i class="ri-delete-bin-6-line"></i></span></a>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-3">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="berita_author" name="berita_author" placeholder="Your Name">
                            <label for="floatingName">Author</label>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="berita_title" name="berita_title" placeholder="Your Name">
                            <label for="floatingName">Berita Title</label>
                        </div>
                    </div>
                </div>




                <div class="row">
                    <div class="col-md-12 mb-3">
                        <h5>Content</h5>

                        <textarea class="tinymce-editor" id="content_berita" name="content_berita" style="height: 100px;"></textarea>


                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Meta Keyword">
                            <label for="floatingPassword">Meta Keyword <span class="color-secondary">Ex:(key1,key2,...)</ class="color-gray"></label>
                        </div>
                    </div>
                </div>


            </form><!-- End floating Labels Form -->

            <div class="text-center">
                <button id="save" class="btn btn-primary" onclick="tinyMCE.triggerSave(true,true);">Save</button>
                <button id="save_preview" class="btn btn-secondary" onclick="tinyMCE.triggerSave(true,true);">Preview</button>
            </div>
        </div>
    </div>

</section>




<script src="<?= base_url('assets/NiceAdmin/assets/vendor/tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/select2/dist/js/select2.min.js' ?>"></script>
<link href="<?= base_url(''); ?>assets/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url() . 'assets/validation/dist/jquery.validate.min.js' ?>"></script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/berita/berita2.js' ?>"></script>

<script>
    $("#category").select2();
</script>
