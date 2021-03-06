<?php require_once('../private/initialize.php'); ?>

<?php
// Set the preview page
$preview = false;
if (isset($_GET['preview'])) {
  //previewing should require admin to be logged in
  $preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}
$visible = !$preview;

// display the dynamic page from the database if isset
if(isset($_GET['id'])) {
  $page_id = $_GET['id'];
  $page = find_page_by_id($page_id, ['visible' => '$visible']);
  // check if page was found
  if (!$page) {
    redirect_to(url_for('./index.php'));
  }
  // if there's a page found, set subject_id to the value
  $subject_id = $page['subject_id'];
  // show subjects marked visible when the related page is also visible
  $subject = find_subject_by_id($subject_id, ['visible' => '$visible']);
  if (!$subject) {
    redirect_to(url_for('./index.php'));
  }
}elseif(isset($_GET['subject_id'])) {
  $subject_id = $_GET['subject_id'];

  // check if subject is marked visible
  $subject = find_subject_by_id($subject_id, ['visible' => '$visible']);
  if (!$subject) {
    redirect_to(url_for('./index.php'));
  }
  $page_set = find_pages_by_subject_id($subject_id, ['visible' => '$visible']);
  $page = mysqli_fetch_assoc($page_set); //first page
  mysqli_free_result($page_set);
  if (!$page) {
    redirect_to(url_for('./index.php'));
  }
  // if page is found
  $page_id = $page['id'];
}else {
  //nothing selected; show the homw page
}



?>


<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
<?php include(SHARED_PATH . '/public_navigation.php'); ?>

  <div id="page">
  <?php 
  // show the dynamic page from the database only when isset
  if (isset($page)) {
  // show the page from the database
  // Specifying allowable html tags
  $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>';
  echo strip_tags($page['content'], $allowed_tags);
}else {
   // show the home page
  // The homepage content could:
  // *be static content
  // *show the first page from the nav
  // *be in the database but add code to hide in the nav
  
  include(SHARED_PATH . '/static_homepage.php');
}

?>
 

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
