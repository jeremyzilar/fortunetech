<?php 
// Page Nav

function fortune_card_nav($page_menu){
  if (empty($page_menu)) {
    // echo 'NOTHING';
  } else {
    echo <<< EOF
    <div class="row">
      <div class="col-xs-12">

EOF;
      $args = array(
        'theme_location'  => $page_menu,
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'nav nav-centered',
        'menu_id'         => '',
        'echo'            => true,
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
      );
      wp_nav_menu( $args );

      echo <<< EOF
      </div>
    </div>
EOF;
  }

}