<?php
$text = get_sub_field('text');
$blocks = get_sub_field('blocks');
?>
<div class="two-row space">
  <div class="wrap wrapper">
    <div class="text-block">
      <?php echo $text; ?>
    </div>
    <div class="item-blocks">
      <?php foreach ($blocks as $block) { ?>
        <?php $background_color = $block['background_color']; ?>
        <div class="item-block" style="background-color: <?php echo $background_color; ?>;">
          <div class="text-block text">
            <?php echo $block['text']; ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>