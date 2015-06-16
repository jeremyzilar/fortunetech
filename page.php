<?php get_header(); 

// Main Navbar
include INC . 'main_navbar.php';

?>

<?php include(INC . 'head_page.php'); ?>
	<section id="main">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				  <?php loop(); ?>
				</div>
			</div>
		</div>
	</section>
<?php get_footer(); ?>