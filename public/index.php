<?php require_once('../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
<?php include(SHARED_PATH . '/public_navigation.php'); ?>

  <div id="page">
  <?php 
  // show the home page
  // The homepage content could:
  // *be static content
  // *show the first page from the nav
  // *be in the database but add code to hide in the nav
  
  include(SHARED_PATH . '/static_homepage.php'); ?>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
