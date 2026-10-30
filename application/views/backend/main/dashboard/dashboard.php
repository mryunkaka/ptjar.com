<section class="section dashboard">
    <div class="row g-4">
        <div class="col-12 col-md-6">
            <article class="card admin-stat-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="admin-stat-card__icon" aria-hidden="true"><i class="bi bi-newspaper"></i></span>
                    <div>
                        <p class="admin-stat-card__label mb-1">Berita</p>
                        <p class="admin-stat-card__value mb-0"><?= number_format((int) $cnt_berita[0]['cnt'], 0, ',', '.'); ?></p>
                    </div>
                </div>
            </article>
        </div>
        <div class="col-12 col-md-6">
            <article class="card admin-stat-card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="admin-stat-card__icon admin-stat-card__icon--warm" aria-hidden="true"><i class="bi bi-megaphone"></i></span>
                    <div>
                        <p class="admin-stat-card__label mb-1">Siaran Pers</p>
                        <p class="admin-stat-card__value mb-0"><?= number_format((int) $cnt_pers[0]['cnt'], 0, ',', '.'); ?></p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>
