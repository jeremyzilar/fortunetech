<?php get_header(); ?>

  <section id="main">
    <div class="container">
      <div class="row">

        <div class="col-xs-12 col-sm-8">
          <?php loop(); ?>
          <?php include(INC . 'newsletter_card.php'); ?>
          <?php include(INC . 'ad-300x100.php'); ?>
        </div>


        <div class="col-xs-12 col-sm-4">
          <div class="sidebar">
            
            <!-- Desktop: 300 x 250 Ad -->
            <div class="ad-wrap hidden-xs">
              <div id="#ad1" class="ad">
                <img src="http://placehold.it/300x250/FF8787/333333">
              </div>
            </div>
            
            <div class="collection-card collection-card-popular">
              <h4>Most Popular</h4>
              <?php include(INC . 'example-story.php'); ?>
              <?php include(INC . 'example-story.php'); ?>
              <?php include(INC . 'example-story.php'); ?>
              <?php include(INC . 'example-story.php'); ?>
            </div>

            <div class="">
              <div class="wbox" wbox-label="Story" wbox-type="promo"></div>
              <div class="wbox" wbox-label="Story" wbox-type="promo"></div>
              <div class="wbox" wbox-label="Story" wbox-type="promo"></div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  </section>

<?php get_footer(); ?>