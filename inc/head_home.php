<?php 
// Header — for all pages
?>

<section id="head" class="card">
  <div class="container">
    <div id="head-title" class="row">
      <div class="col-xs-12">
      	<a class="app-trigger app-trigger-menu" href="#"><i class="fa fa-bars"></i></a>
      	<a class="app-trigger app-trigger-search" href="#"><i class="fa fa-search"></i></a>
        <h1><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo THEME . '/assets/img/fortune-logo-black.png'; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" class="img-responsive logo" /></a></h1>

      </div>
    </div>
  </div>
</section>