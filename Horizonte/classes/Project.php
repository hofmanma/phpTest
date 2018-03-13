<?php
     if (PROJECT_INCLUDES == 1)
      return;

     define( PROJECT_INCLUDES, 1);

     include "Authentication.php";
     include "Song.php";
     include "Auftritt.php";
     include "Musiker.php";
     include "Probe.php";
     include "Comment.php";
     include "Link.php";
?>
