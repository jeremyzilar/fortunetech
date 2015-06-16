<?php
// Templates

function get_fortune_template($temp){
  // echo $temp;
  call_user_func('t_'.$temp, $temp);
}

function template_type($type){
  echo '<div class="t_tag"><span>'.$type.'</span></div>';
}


function get_fortune_heading($style, $symbol){
  if (!empty($style)) {
    $style = $style;
  }
  if (!empty($symbol)) {
    if ($symbol == 'fa-arrow-circle-right') {
      $symbol = '<i class="fa fa-arrow-circle-right"></i>';
    }
  }
  return <<< EOF
  <h3 class="heading editable $style">Our Produce $symbol</h3>
EOF;
}

function get_fortune_summary(){
  return <<< EOF
  <div class="summary editable"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</p></div>
EOF;
}

function get_fortune_nav($type){
  if (!empty($type)) {
    $type = 'nav-'. $type;
  }
  return <<< EOF
  <ul class="nav $type">
    <li class="editable">
      <a href="http://localhost/~jeremyzilar/wp/produce-and-products/">See more »</a>
    </li>
    <li class="editable">
      <a href="http://localhost/~jeremyzilar/wp/produce-and-products/">Another Link »</a>
    </li>
  </ul>
EOF;
}

function get_fortune_media_credit($w){
  if (empty($w) || $w > 100) {
    return $credit = '<span class="credit">Photo by: <a href="#">Ann Herple</a></span>';
  }
}

function get_fortune_media($type, $size, $pos){
  if (!empty($type)) {
    $type = 'media-' . $type;
  }
  if (!empty($size)) {
    // If the size value contains both width and height
    if (strpos($size,'|') !== false) {
      $wh =  explode('|', $size);
      $width = $wh[0];
      $height = $wh[1];
      $size = $width . 'x' . $height;
      $credit = get_fortune_media_credit($width);
    } else {
      // If the size value contains only one number, it is going to assume that is the width
      $size = $size .'x' . ($size / 2);
      $credit = get_fortune_media_credit($width);
    }
  } else {
    // If the size value is empty, we are going to set the width and height
    $size = '1200x600';
    $credit = get_fortune_media_credit('');
  }

  if (!empty($pos)) {
    $pos = 'pull-' . $pos;
  }
  return <<< EOF
  <div class="media $type $pos">
    <a href="#"><img class="img-responsive" src="http://placehold.it/$size/A1C8E5/777777" alt=""/></a> $credit
  </div>
EOF;
}

function get_fortune_coverimg(){
  return '<div class="cover-img" style="background-image: url("http://placehold.it/$size/A1C8E5/777777");"></div>';
}







function t_a1($temp){
  $heading = get_fortune_heading('', '');
  $summary = get_fortune_summary();
  $media = get_fortune_media('', '1200|600', '');
  $nav = get_fortune_nav('split');
  template_type($temp);
  echo <<< EOF
  <section class="strip strip-lg" data-temp-type="$temp">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $media
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_a2($temp){
  $heading = get_fortune_heading('text-center', '');
  $summary = get_fortune_summary();
  $media = get_fortune_media('', '600|150', '');
  $nav = get_fortune_nav('split');
  template_type($temp);
  echo <<< EOF
  <section class="strip strip-lg" data-temp-type="$temp">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $media
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}


function t_a3($temp){
  $heading = get_fortune_heading('', '');
  $summary = get_fortune_summary();
  $media = get_fortune_media('circle', '150|150', 'right');
  $nav = get_fortune_nav('split');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-lg" data-temp-type="$temp">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $media
          $heading
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_a4($temp){
  $heading = get_fortune_heading('text-center', '');
  $summary = get_fortune_summary();
  $media = get_fortune_media('', '165|215', 'right');
  $nav = get_fortune_nav('');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-lg" data-temp-type="$temp">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $media
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_a5($temp){
  $heading = get_fortune_heading('text-center', '');
  $summary = get_fortune_summary();
  $media = get_fortune_media('', '75|75', 'left');
  $nav = get_fortune_nav('split');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-lg">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $media
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_a6($temp){
  $heading = get_fortune_heading('text-center', '');
  $summary = get_fortune_summary();
  $media = get_fortune_media('', '75|75', 'right');
  $nav = get_fortune_nav('split');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-lg">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $media
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_a7($temp){
  $heading = get_fortune_heading('text-center', '');
  $summary = get_fortune_summary();
  $media = get_fortune_media('', '600|150', '');
  $nav = get_fortune_nav('split');
  $coverimg = get_fortune_coverimg();
  template_type($temp);
  echo <<< EOF
  <section class="strip strip-lg" data-temp-type="$temp">
    $coverimg
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_b1($temp){
  $heading = get_fortune_heading('', '');
  $summary = get_fortune_summary();
  $nav = get_fortune_nav('split');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-md">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_b2($temp){
  $heading = get_fortune_heading('text-center', '');
  $summary = get_fortune_summary();
  $nav = get_fortune_nav('split');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-md">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $summary
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_b3($temp){
  $heading = get_fortune_heading('text-center', '');
  $summary = get_fortune_summary();
  $nav = get_fortune_nav('centered');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-md">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $nav
          $summary
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_c1($temp){
  $heading = get_fortune_heading('text-center', '');
  $nav = get_fortune_nav('centered');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-sm">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $nav
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_c2($temp){
  $heading = get_fortune_heading('text-center', '');
  $summary = get_fortune_summary();

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-sm">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
          $summary
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_d1($temp){
  $heading = get_fortune_heading('text-center', 'fa-arrow-circle-right');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-xs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
        </div>
      </div>
    </div>
  </section>
EOF;
}

function t_d2($temp){
  $heading = get_fortune_heading('text-center', 'fa-arrow-circle-right');

  template_type($temp);
  echo <<< EOF
  <section class="strip strip-xs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          $heading
        </div>
      </div>
    </div>
  </section>
EOF;
}
