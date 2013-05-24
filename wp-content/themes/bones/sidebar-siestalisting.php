<?php
//   $the_query = new WP_Query( array ( 'post_type' => 'siesta'));
  $today = date('Y-m-d');
  $the_query = new WP_Query( array ( 'post_type' => 'siesta', 'posts_per_page' => 1, 'orderby' => 'meta_value', 'meta_key' => 'eventdate', 'order' => 'ASC',
      'meta_query' => array(
          array(
              'key' => 'eventdate',
              'value' => $today,
              'type' => 'date',
              'compare' => '>='
          )
      )
  ));
  // The Loop
  while ( $the_query->have_posts() ) :
  $the_query->the_post();
  $custom_value = get_post_custom_values('eventdate', get_the_ID());
  $originalDate = $custom_value[0];
  $formattedDate = date("d.m", strtotime($originalDate));
  echo '<li class="sidebar-siesta-wrapper">';
  echo '<div class="sidebar-siesta-row">';
  echo '<div class="sidebar-siesta-date">' . $formattedDate . '</div>';
  echo '<div class="sidebar-siesta-title">' . get_the_title() . '</div>';
  echo '</div>';
  echo '<div class="sidebar-siesta-row">';
  echo '<div class="sidebar-siesta-excerpt">' . get_the_excerpt() . '</div>';
  echo '</div>';
  echo '</li>';
  endwhile;

  wp_reset_postdata();

?>
