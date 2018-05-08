<?php session_start();
session_destroy();

unset($_SESSION['rawajuser']);
unset($_SESSION['facebook_access_token']);
// Remove user data from session
unset($_SESSION['loggeduser']);
unset($_SESSION['usertype']);
header("Location:index.php");
exit();

?>
