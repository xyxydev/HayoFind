<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();


exit();
?>
<script>
  // Disable the browser's back button
  window.history.pushState(null, '', document.URL);
  window.addEventListener('popstate', function () {
  window.history.pushState(null, '', document.URL);
  });
</script>