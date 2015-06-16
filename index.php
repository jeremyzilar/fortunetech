<?php get_header(); ?>
  <section id="main">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6">

          <div id="top-5" class="collection-card">
            <h4>Top 5</h4>
            <?php include(INC . 'example-story-top-5.php'); ?>
            <?php include(INC . 'example-story-top-5.php'); ?>
            <?php include(INC . 'example-story-top-5.php'); ?>
            <?php include(INC . 'example-story-top-5.php'); ?>
            <?php include(INC . 'example-story-top-5.php'); ?>
          </div>

          <?php include(INC . 'ad-300x100.php'); ?>

          <div id="trending-companies" class="collection-card">
            <h4>Trending</h4>
            <?php include(INC . 'example-story-collection.php'); ?>
            <?php include(INC . 'example-story-collection.php'); ?>
            <?php include(INC . 'example-story-collection.php'); ?>
          </div>

          <?php include(INC . 'ad-300x100.php'); ?>

        </div>

        <div class="col-xs-12 col-sm-3">
          <h4>Commentary</h4>
          <?php include(INC . 'example-story.php'); ?>
          <?php include(INC . 'example-story.php'); ?>
          <?php include(INC . 'example-story.php'); ?>
          <?php include(INC . 'example-story.php'); ?>
          <?php include(INC . 'example-story.php'); ?>
          <?php include(INC . 'example-story.php'); ?>
          <?php include(INC . 'example-story.php'); ?>
          <?php include(INC . 'example-story.php'); ?>
          <?php include(INC . 'example-story.php'); ?>

        </div>

        <div class="col-xs-12 col-sm-3">
          <h4>Key Topics</h4>
          <div class="wbox" wbox-label="Story" wbox-type="promo"></div>
          <div class="wbox" wbox-label="Story" wbox-type="promo"></div>
          <div class="wbox" wbox-label="Story" wbox-type="promo"></div>
        </div>


      </div>

      <div class="row">
        <div class="col-xs-12 col-sm-8">

          <?php //loop(); ?>
          <?php //include(INC . 'article.php'); ?>
        </div>

        <div class="col-xs-12 col-sm-4">

        
          
        </div>
      </div>
    </div>
  </section>

<?php get_footer(); ?>