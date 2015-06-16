<article id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
	<header class="entry-header">
		
    <?php fortune_kicker(); ?>

		<?php fortune_headline(''); ?>

    <?php fortune_byline_card(); ?>

	</header><!-- .entry-header -->

	<div class="entry-media media">
    <img src="<?php echo THEME . '/assets/img/photo.jpg' ?>" class="img-responsive" alt=""/>
    <span class="credit">By <a href="#">Mia Diel</a></span>
    <span class="caption">!Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
  </div>


  <div class="row">
    <div class="col-xs-12 col-sm-10">
			<?php if ( is_search() ) : // Only display Excerpts for Search ?>
				<div class="entry-summary">
					<p><?php entry_excerpt(); ?></p>
				</div><!-- .entry-summary -->
			<?php else : ?>
				
        <div class="entry-deck">
          <h5>Deck Article Goes Here Lorem Ipsum Dolor Sumit, Tech Cloud Surprise</h5>          
        </div><!-- .entry-content -->

				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>

			<footer class="entry-meta">
			  <?php //fortune_entry_meta($post->ID); ?>
			</footer><!-- .entry-meta -->
		</div>
	</div>

	<!-- Comments Start here -->
	<?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
		<?php //comments_template(); ?>
	<?php } ?>
</article> <!-- #post -->