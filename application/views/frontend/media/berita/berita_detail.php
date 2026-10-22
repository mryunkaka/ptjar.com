<main id="main">
  <section id="blog" class="blog text-justify mt-4">
    <div class="container" data-aos="fade-up">

      <div class="row g-5">

        <div class="col-lg-8">

          <article class="blog-details">




            <div id="carouselExampleFade" class="carousel slide carousel-fade mt-3" data-bs-ride="carousel" data-bs-interval="5000">
              <div class="carousel-inner">
                <?php foreach ($photo as $sm) : ?>
                  <?php if ($sm['int_thumbnail'] == 1) { ?>

                    <div class="carousel-item active">
                      <div class="row justify-content-center gy-6">
                        <img src="<?= base_url('') . $url[0]['vc_url'] . $sm['vc_image'] ?>" alt="" class="img-fluid img carousel-img-alif">

                      </div>
                    </div>
                  <?php } else { ?>
                    <div class="carousel-item">
                      <div class="row justify-content-center gy-6">
                        <img src="<?= base_url('') . $url[0]['vc_url'] . $sm['vc_image'] ?>" alt="" class="img-fluid img carousel-img-alif">

                      </div>
                    </div>
                  <?php } ?>
                <?php endforeach ?>

              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>


            <h2 class="title"><?= $detail[0]['vc_title'] ?></h2>

            <div class="meta-top">
              <ul>
                <li class="d-flex align-items-center"><i class="bi bi-person"></i> <?= $detail[0]['vc_author_name'] ?></li>
                <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <time datetime="2020-03-01"><?= date("d-M-Y", strtotime($detail[0]['dt_published'])) ?></time></li>

              </ul>
            </div><!-- End meta top -->

            <div class="content">


              <?= $detail[0]['vc_content'] ?>


            </div><!-- End post content -->

            <!-- <div class="meta-bottom">
              <i class="bi bi-folder"></i>
              <ul class="cats">
                <li><a href="#">Business</a></li>
              </ul>

              <i class="bi bi-tags"></i>
              <ul class="tags">
                <li><a href="#">Creative</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>
            </div>End meta bottom -->

          </article><!-- End blog post -->
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
                  <?php if (isset($list[0]['nu_id']) !== null) {
                    $i = 1; ?>
                    <?php foreach ($list_recent as $sm) : ?>
                      <div class="post-item mt-3">
                        <img src="<?= base_url() . $url[0]['vc_url'] . $sm['vc_image'] ?> " alt="" class="flex-shrink-0">
                        <div>
                          <h4><a href="<?= base_url('') ?>Berita/<?= $sm["uuid"] ?>"><?= $sm["vc_title"] ?></a></h4>
                          <time datetime=" 2020-01-01"><?= date('d-M-Y', strtotime($sm['dt_published'])); ?></time>
                        </div>
                      </div>

                      <?php $i++; ?>
                    <?php endforeach ?>
                  <?php } ?>




                </div>

              </div>
              <!-- 
              <div class="sidebar-item tags">
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

    </div>
  </section><!-- End Blog Details Section -->
</main>