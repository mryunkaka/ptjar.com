<section id="blog" class="blog text-justify mt-4">
    <div class="container" data-aos="fade-up">
        <div class="row  d-flex justify-content-end">
            <div class="col-sm-1"> <a href="#" class="badge bg-danger text-dark p-3 mb-3" data-bs-toggle="modal" data-bs-target="#basicModal"><i class="bi bi-info-circle me-1"></i>
                    Delete
                </a></div>

            <div class="col-sm-1"> <a href="<?= base_url() ?>Management_Berita/berita_edit/<?= $detail[0]['uuid'] ?>" class="badge bg-info text-dark p-3 mb-3"><i class="bi bi-info-circle me-1"></i>
                    Edit
                </a></div>

            <hr>
        </div>
        <div class="row g-5">
            <input type="hidden" id="base" value="<?php echo base_url(); ?>">
            <div class="col-lg-12">
                <h2><b>Preview</b>
                </h2>
                <article class="blog-details">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php if (empty($photo)) { ?>
                                <td><img src="<?= base_url() . 'assets/file/backend/upload/berita/thumbnail/default/default.png' ?> " class="img-thumbnail" width="120" alt="..."></td>
                            <?php } else { ?>
                                <?php foreach ($photo as $sm) : ?>

                                    <?php if ($sm['int_thumbnail'] == 1) { ?>

                                        <div class="carousel-item active">
                                            <img src="<?= base_url('') . $url[0]['vc_url'] . $sm['vc_image'] ?>" class="d-block w-100" alt="...">
                                            <!-- <div class="carousel-caption d-none d-md-block">
                                            <h5>First slide label</h5>
                                            <p>Some representative placeholder content for the first slide.</p>
                                        </div> -->
                                        </div>

                                    <?php } else { ?>


                                        <div class="carousel-item">
                                            <img src="<?= base_url() . $url[0]['vc_url'] . $sm['vc_image'] ?>" class=" d-block w-100" alt="...">
                                            <!-- <div class="carousel-caption d-none d-md-block">
                                            <h5>First slide label</h5>
                                            <p>Some representative placeholder content for the first slide.</p>
                                        </div> -->
                                        </div>


                                    <?php } ?>

                                <?php endforeach ?>
                            <?php } ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>

                    <h2 class="title"> <?= html_escape($detail[0]['vc_title']) ?></h2>

                    <div class="meta-top">
                        <div class="row mb-4">
                            <div class="col-sm-2">
                                <li class="d-flex align-items-center"><i class="bi bi-person"></i><?= html_escape($detail[0]['vc_author_name']) ?></li>
                            </div>
                            <div class="col-sm-2">
                                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="2020-03-01"><?= date("d-M-Y", strtotime($detail[0]['dt_published'])) ?></time></li>
                            </div>
                        </div>

                    </div><!-- End meta top -->

                    <div class="content">
                        <?= $this->security->xss_clean($detail[0]['vc_content']) ?>
                    </div><!-- End post content -->

            </div>

        </div>
</section><!-- End Blog Details Section -->


<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title" id="detailModalLabel">Delete Berita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="from_dt">
                    <input type="hidden" class="form-control" id="id_deleted" name="id_deleted" value="<?= $detail[0]['uuid'] ?>">


                    <div class="row mb-3 h4 ">
                        <div class="col-md-12 ">
                            Apakah anda ingin menghapus berita ini?
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" id="delete_preview" type="button">Delete</button>
            </div>
            </form>
        </div>
    </div>
</div><!-- End Basic Modal-->

<script type="text/javascript" src="<?php echo base_url() . 'assets/NiceAdmin/assets/vendor/jquery/jquery.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/Backend/js/berita/berita_preview.js' ?>"></script>
