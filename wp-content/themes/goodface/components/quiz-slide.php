<?php
$data = ( isset($args) && !empty($args) ) ? $args : '';
$firstKey = array_key_first ($data );

if ( !empty($data[$firstKey]) ):
    if ( $firstKey !== 'result' ):
        $title = $data[$firstKey]['title'];
        $options = $data[$firstKey]['options'];
        $multiple = $data[$firstKey]['multiple']; ?>

        <div class="quiz-slide" data-question="<?= $firstKey; ?>" data-multiple="<?= $multiple; ?>">
            <?php if ( isset($title) && !empty($title) ): ?>
                <div class="title-wrapper">
                    <h3><?= $title; ?></h3>
                </div>
            <?php endif;
            
            if ( isset($options) && !empty($options) ):
                $totalOptions = count( $options );
                $optionsClass = $totalOptions < 4 ? ' quiz-options-flex' : ' quiz-options-grid'; ?>

                <div class="quiz-options<?= $optionsClass; ?>">
                    <?php foreach ( $options as $option ):
                        if ( isset($option) && !empty($option) ): ?>
                            <label class="variant" data-value="<?php echo $option['answer']; ?>">
                                <span><?php echo $option['answer']; ?></span>
                                <input type="checkbox" value="<?php echo $option['rating']; ?>">
                            </label>
                        <?php endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php else:
        $title = $data[$firstKey]['title'];
        $multiple = $data[$firstKey]['multiple'];
        $timerTitle = $data[$firstKey]['timer_title'];
        $titlePrice = $data[$firstKey]['title_price'];
        $timerDescription = $data[$firstKey]['timer_description'];
        $textBottom = $data[$firstKey]['text_bottom']; ?>

        <div class="quiz-slide<?= ' ' . $firstKey; ?>" data-question="<?= $firstKey; ?>" data-multiple="<?= $multiple; ?>">
            <div class="result-wrapper">
                <?php if ( isset($title) && !empty($title) ): ?>
                    <div class="title-wrapper title-wrapper-top">
                        <span class="text-top"><?= $title; ?></span>
                    </div>
                <?php endif; ?>

                <div class="result">
                    <div class="content-wrapper">
                        <div class="title-wrapper title-wrapper-card">
                            <h4></h4>
                        </div>

                        <div class="text-wrapper">
                            <p></p>
                        </div>
                    </div>

                    <div class="offer-wrapper">
                        <div class="timmer-wrap">
                            <div class="quiz-timer" id="quiz-timer" data-timer-min="10" data-timer-sec="00">
                                <span class="time time-min" id="time-min"></span>
                                <span class="time-separator">:</span>
                                <span class="time time-sec" id="time-sec"></span>
                            </div>

                            <?php if ( isset($timerTitle) && !empty($timerTitle) ): ?>
                                <div class="title-wrapper title-wrapper-timer">
                                    <span class="timer-title"><?= $timerTitle; ?></span>
                                </div>
                            <?php endif;

                            if ( isset($timerDescription) && !empty($timerDescription) ): ?>
                                <div class="descr-wrapper">
                                    <span class="timer-descr"><?= $timerDescription; ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                         
                        <div class="purchase-wrapper">
                            <?php if ( isset($titlePrice) && !empty($titlePrice) ): ?>
                                <div class="title-wrapper">
                                    <span class="title-price"><?= $titlePrice; ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="price-wrapper">
                                <span class="price price-discount" id="price-discount"></span>
                                <span class="price price-regular" id="price-regular"><del></del></span>
                            </div>
                        </div>

                        <div class="btn-wrapper">
                            <a
                                class="button button-primary button-purchase"
                                id="button-purchase"
                                href="#"
                                aria-label="Buy Now"
                            >
                                <span class="button-text"></span>
                            </a>
                        </div>
                    </div>
                </div>

                <?php if ( isset($textBottom) && !empty($textBottom) ): ?>
                    <div class="title-wrapper title-wrapper-bottom">
                        <span class="text-bottom"><?= $textBottom; ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif;
endif;