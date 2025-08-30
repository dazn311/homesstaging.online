<!-- Portfolio Details Section -->
<style>
    .swiper-slide {
        background-color: transparent;
        background-repeat: no-repeat,repeat;
        background-position: right 2px top 0,0 0;
        height: 753px;
        background-size: cover;
    }
</style>
<section id="portfolio-details" class="portfolio-details section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
            <div class="col-lg-8">
                <div class="portfolio-details-slider swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": false,
                            "speed": 1600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            }
                        }
                    </script>

                    <div class="swiper-wrapper align-items-center">
                        <?php if (count($imagesArr) === 0): ?>
                            <div class="swiper-slide" style="opacity: 0.7;background-image: url('assets/img/hero-bg.jpg');" >
                            </div>
                        <?php endif; ?>
                        <?php foreach ($imagesArr as $image ): ?>
                            <div class="swiper-slide" style="background-image: url(<?=$image['imageUrl']?>);" >
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="portfolio-info" data-aos="fade-up" data-aos-delay="200">
                    <h3><?=$res['title'] ?></h3>
                    <ul>
                        <li><strong>Категория</strong>: <?=$res['category'] ?></li>
                        <li><strong>Бюджет</strong>: <?=$res['price'] ?>₽</li>
                        <li><strong>Дата завершения</strong>: <?=$res['end_date'] ?></li>
                        <li>
                            <strong>Проект URL</strong>:
                            <a href="<?=$res['project_url'] ?>">
                                <i class="bi bi-telegram" style="padding-left: 4px;" ><?=$res['project_des'] ?></i>
                            </a>
                        </li>
                    </ul>
                </div>

                <?php if (count($worksArr) > 0): ?>
                    <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                        <h2>Произведенные работы</h2>
                        <ul>
                            <?php foreach ($worksArr as $work ): ?>
                                <li><?=$work['title_work']?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>

</section><!-- /Portfolio Details Section -->
