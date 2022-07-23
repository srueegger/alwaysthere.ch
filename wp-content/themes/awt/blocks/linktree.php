<?php


// Create id attribute allowing for custom "anchor" value.
$id = 'linktree-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'linktree';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assign defaults.

?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
  <?php
  if( have_rows( 'block_lt_links' ) ) {
    echo '<div class="grid">';
    while( have_rows( 'block_lt_links' ) ) {
      the_row();
      $link = get_sub_field( 'link' );
      $link_target = $link['target'] ? $link['target'] : '_self';
      echo '<div class="g-col-12 g-col-lg-6">';
      echo '<a class="d-block position-relative" href="' . esc_url( $link['url'] ) . '" target="' . $link_target . '">';
      echo '<p class="mb-0 text-center fw-bold text-uppercase position-absolute w-100">' . esc_attr( $link['title'] ) . '</p>';
      echo '</a></div>';
    }
    echo '</div>';
  }
  ?>
</div>