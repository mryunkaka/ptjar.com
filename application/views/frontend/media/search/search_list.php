<main id="main">


  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog text-justify">
    <div class="section-header mt-4">
      <h1><?php echo $judul ?></h2>

    </div>


    <div class="container" data-aos="fade-up">

      <div class="row g-5 mb-5 ">
        <div class="col-lg-12 d-flex justify-content-center h3"><?= $result ?></div>
      </div>
      <div class=" row g-5 ">

        <div class=" col-lg-8">

          <div class="row gy-4 posts-list">
            <?php if (isset($list[0]['nu_id']) !== null) {
              $i = 1; ?>
              <?php foreach ($list as $sm) : ?>

                <div class="col-lg-6">
                  <article class="d-flex flex-column">

                    <div class="post-img">
                      <?php if (empty($sm['vc_image'])) { ?>
                        <td><img src="<?= base_url() . 'assets/file/backend/upload/berita/thumbnail/default/default.png' ?> " class="img-fluid" alt="..."></td>
                      <?php } else { ?>
                        <td><img src="<?= base_url() . $url[0]['vc_url'] . $sm['vc_image'] ?> " class="img-fluid" alt="..."></td>
                      <?php } ?>

                    </div>




                    <h2 class="title">
                      <a href="<?= html_escape(base_url('Berita/' . rawurlencode((string) $sm['uuid']))) ?>"><?= html_escape($sm['vc_title']) ?></a>
                    </h2>

                    <div class="meta-top">
                      <ul>
                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <span><?= html_escape($sm['vc_author_name']) ?></span></li>
                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2022-03-01"><?= date('d-M-Y', strtotime($sm['dt_published'])); ?></time></a></li>

                      </ul>
                    </div>

                    <div class="content">
                      <p>
                        <?= html_escape(word_limiter(strip_tags($sm['vc_content']), 20)) ?> </p>

                    </div>

                    <div class="read-more mt-auto align-self-end">
                      <a href="<?= base_url('') ?>Berita/<?= $sm["uuid"] ?>">Read More</a>
                    </div>

                  </article>
                </div><!-- End post list item -->


                <?php $i++; ?>
              <?php endforeach ?>
            <?php } ?>


          </div><!-- End blog posts list -->

          <?= $pagination ?>

        </div>

        <div class="col-lg-4">

          <div class="sidebar">

            <div class="sidebar-item search-form">
              <h3 class="sidebar-title">Search</h3>
              <form method="post" action="<?= base_url('Search'); ?>" class="mt-3">
                <input type="text" name="search" id="search">
                <button type="submit"><i class="bi bi-search"></i></button>
              </form>
            </div>


            <div class="sidebar-item categories">
              <!-- <h3 class="sidebar-title">Categories</h3>
              <ul class="mt-3">
                <li><a href="#">General <span>(25)</span></a></li>
                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                <li><a href="#">Travel <span>(5)</span></a></li>
                <li><a href="#">Design <span>(22)</span></a></li>
                <li><a href="#">Creative <span>(8)</span></a></li>
                <li><a href="#">Educaion <span>(14)</span></a></li>
              </ul> -->
              <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Recent Posts</h3>

                <div class="mt-3">
                  <?php if (isset($list_recent[0]['uuid']) !== null) {
                    $i = 1; ?>
                    <?php foreach ($list_recent as $sm) : ?>
                      <div class="post-item mt-3">
                        <?php if (empty($sm['vc_image'])) { ?>
                          <td><img src="<?= base_url() . 'assets/file/backend/upload/berita/thumbnail/default/default.png' ?> " class="img-fluid" alt="..."></td>
                        <?php } else { ?>
                        <?= webp_picture_tag(base_url() . $url[0]['vc_url'] . $sm['vc_image'], '', array('class' => 'flex-shrink-0', 'loading' => 'lazy', 'decoding' => 'async')) ?>
                        <?php } ?>
                        <div>
                          <h4><a href="<?= html_escape(base_url('Berita/' . rawurlencode((string) $sm['uuid']))) ?>"><?= html_escape($sm['vc_title']) ?></a></h4>
                          <time datetime=" 2020-01-01"><?= date('d-M-Y', strtotime($sm['dt_published'])); ?></time>
                        </div>
                      </div>

                      <?php $i++; ?>
                    <?php endforeach ?>
                  <?php } ?>




                </div>

              </div>

              <!-- <div class="sidebar-item tags">
                <h3 class="sidebar-title">Tags</h3>
                <ul class="mt-3">
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>
              </div> -->

            </div>
            <!-- End Blog Sidebar-->

          </div>

        </div>

      </div>
  </section><!-- End Blog Section -->

</main><!-- End #main -->
