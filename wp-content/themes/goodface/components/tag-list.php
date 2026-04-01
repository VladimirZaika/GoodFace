<?php
$list = ( isset($args['list']) && !empty($args['list']) ) ? $args['list'] : '';

if ( !empty($list) ): ?>
    <div class="list-wrapper">
        <ul>
            <?php foreach($list as $item):
                $text = $item['text'];

                if ( !empty($text) ): ?>
                    <li class="list-item"><?= $text; ?></li>
                <?php endif;
            endforeach; ?>
        </ul>
    </div>
<?php endif;