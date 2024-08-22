
<?php
function bfw_custom_pagination($current_page, $total_pages) {
  $pagination = '';
  $base_class = 'bfw-pagination__item ';
  $link_class = 'bfw-pagination__link btn';

  if ($current_page === 1) {
      $pagination .= '<li class="' . $base_class . ' active"><span class="' . $link_class . '">01</span></li>';
  } else {
      $pagination .= '<li class="' . $base_class . '"><a href="' . get_pagenum_link(1) . '" class="' . $link_class . '">01</a></li>';
  }

  if ($current_page > 3) {
      $pagination .= '<li class="etc ' . $base_class . '">...</li>';
  }

  for ($i = max(2, $current_page - 2); $i <= min($total_pages - 1, $current_page + 2); $i++) {
      if ($i === $current_page) {
          $pagination .= '<li class="' . $base_class . ' active"><span class="' . $link_class . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</span></li>';
      } else {
          $pagination .= '<li class="' . $base_class . '"><a href="' . get_pagenum_link($i) . '" class="' . $link_class . '">' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</a></li>';
      }
  }

  if ($current_page < $total_pages - 2) {
      $pagination .= '<li class="etc ' . $base_class . '">...</li>';
  }

  if ($total_pages > 1) {
      $pagination .= '<li class="' . $base_class . '"><a href="' . get_pagenum_link($total_pages) . '" class="' . $link_class . '">' . str_pad($total_pages, 2, '0', STR_PAD_LEFT) . '</a></li>';
  }

  return $pagination;
}


function bfw_display_custom_pagination() {
    global $wp_query;

    $current_page = max(1, get_query_var('paged'));
    $total_pages = $wp_query->max_num_pages;

    if ($total_pages <= 1) {
        return;
    }

    echo '<nav class="bfw-pagination" aria-label="Page navigation"><ul class="bfw-pagination__row">' . bfw_custom_pagination($current_page, $total_pages) . '</ul></nav>';
}



function bfw_set_header_variante($query) {
    if (is_single() && $query->is_main_query()) {
        set_query_var('header_variante', 'background');
    }
}
add_action('pre_get_posts', 'bfw_set_header_variante');
