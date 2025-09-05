<!-- Portfolio Section -->
<section id="portfolio" class="portfolio section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>ЗАВЕРШЕННЫЕ ПРОЕКТЫ</span>
        <h2>ЗАВЕРШЕННЫЕ ПРОЕКТЫ</h2>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
            <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                <li data-filter="*" class="filter-active">Все</li>
                <?php
                $Portfolio2Arr = $Portfolio2Arr ?? array('projectTitle'=>'daz');
                foreach ($Portfolio2Arr as $key=>$Portfolio) : ?>
                    <li data-filter=".filter-<?=$key;?>"><?=$Portfolio[0]['projectTitle'];?></li>
                <?php endforeach; ?>
            </ul><!-- End Portfolio Filters -->

            <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                <?php
                $Portfolio2Arr = $Portfolio2Arr ?? array();
                foreach ($Portfolio2Arr as $key=>$Portfolio) : ?>
                    <?php foreach ($Portfolio as $PortfolioObj) : ?>
                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-<?=$key;?>">
                            <img src="<?=$PortfolioObj['imageUrl'];?>" class="img-fluid" alt="">
                            <div class="portfolio-info">
                                <h4><?=$PortfolioObj['projectTitle'];?></h4>
                                <p>бюджет <?php
                                    $priceInt = (int) $PortfolioObj['price'];
                                    $priceInt = $priceInt / 1_000_000;
                                    echo round($priceInt, 3);
                                    ?> млн</p>
                                <a href="<?=$PortfolioObj['imageUrl'];?>" title="Увеличить"
                                   data-gallery="portfolio-gallery-<?=$key;?>"
                                   class="glightbox preview-link">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="/?details=<?=$key;?>" title="перейти на страницу <?=$PortfolioObj['projectKey'];?>" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>

            </div><!-- End Portfolio Container -->

        </div>

    </div>

</section><!-- /Portfolio Section -->

