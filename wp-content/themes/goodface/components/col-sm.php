<?php
$colTitle = ( isset($args['col_title']) && !empty($args['col_title']) ) ? $args['col_title'] : '';
$colText = ( isset($args['col_text']) && !empty($args['col_text']) ) ? $args['col_text'] : '';

if ( !empty($colTitle) ): ?>
    <div class="condition">
        <?php if ( !empty($colTitle) || $colTitle == 0 ): ?>
            <span class="title-wrapper">
                <span class="condition-title"><?= $colTitle; ?></span>
            </span>
        <?php endif;

        if ( !empty($colText) ): ?>
            <span class="condition-text"><?= $colText; ?></span>
        <?php endif; ?>
    </div>
<?php endif; ?>