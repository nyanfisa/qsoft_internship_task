                 <div class="box">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <img src="<?=htmlspecialchars($car['image']); ?>" alt="Image">
                            </figure>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong><?=htmlspecialchars($car['name']); ?></strong>
                                    <br>
                                    <?=formatPrice($car['price'], $currency) ?>
                                </p>
                            </div>
                        </div>
                    </article>
                </div>