<?php
    $filename = "2009-07-20_CARA_MESSI_01.jpg";
    // Get the file extension
    $file_type = substr($filename, strlen($filename) - 4);
    $image = substr($filename, 0, strlen($filename) - 3);
    
    echo $image."_thumb".$file_type;
?>