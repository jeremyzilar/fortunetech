<?php 
// App Menu
// The main menu that floats in from the left, triggered by the hamburger
?>

<nav id="app-menu" role="navigation">
  <div class="container-fluid">
	  <div class="row">
	  	<div class="search">
	  		<form class="navbar-form navbar-left" role="search">
	        <div class="form-group">
	          <input type="text" class="form-control" placeholder="Search">
	        </div>
	        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
	      </form>
	  	</div>
    	<?php
			$args = array(
				'theme_location'  => 'app-menu',
				'menu_class'      => 'nav navbar-nav',
				'menu_id'         => '',
				'container'       => 'div',
				'container_class' => 'nav-wrap col-xs-12',
				'container_id'    => '',
				'echo'            => true,
				'before'          => '',
				'after'           => '',
				'link_before'     => '',
				'link_after'      => '',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>'
			);
			wp_nav_menu( $args );
			?>
	  </div>
  </div><!-- /.container-fluid -->
</nav>