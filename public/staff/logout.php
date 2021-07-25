<?php
require_once('../../private/initialize.php');

log_out_admin();
// unset($_SESSION['username']);
// or you could use
// $_SESSION['username'] = NULL;

redirect_to(url_for('/staff/login.php'));

?>
