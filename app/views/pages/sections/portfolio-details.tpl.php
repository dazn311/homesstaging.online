<!-- Portfolio Details Section -->
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
                        <div class="swiper-slide">
                            <img src="assets/img/kvartiri/Mitinskii-les/1-spalnia2.png" alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="assets/img/kvartiri/Mitinskii-les/3-zal.jpg" alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="assets/img/kvartiri/Mitinskii-les/4-zal.jpg" alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="assets/img/kvartiri/Mitinskii-les/5-kuhnya.jpg" alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="assets/img/kvartiri/Mitinskii-les/7-vannaya.jpg" alt="">
                        </div>

                        <div class="swiper-slide">
                            <img src="assets/img/kvartiri/Mitinskii-les/8-prihojka.png" alt="">
                        </div>
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

                <div class="portfolio-description" data-aos="fade-up" data-aos-delay="300">
                    <h2>Произведенные работы</h2>
                    <ul>
                        <?php foreach ($worksArr as $work ): ?>
                            <li><?=$work['title_work']?></li>
                        <?php endforeach; ?>
                    </ul>

                </div>
            </div>

        </div>

    </div>

</section><!-- /Portfolio Details Section -->
