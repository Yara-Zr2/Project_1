<?php
// session_start.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Start the session if it's not already started
}
?>
