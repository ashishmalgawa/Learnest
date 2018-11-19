<?php
session_start();
session_destroy();
if (headers_sent()){
      die('<script type="text/javascript">window.location.href="' . "index.php" . '";</script>');
    }else{
    header("Location: index.php"); /* Redirect browser */
exit();
      die();
    }    
?>