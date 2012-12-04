<?php
    require 'header.php';
    require 'authenticate.php';
    
    // Grab the Title and body
    $id = $_GET['id'];
    
    if (!is_numeric($id)){
        header('Location: index.php'); // Bring them back to the select.php page
        die; // Kill the script
    }
    
    $sql = "DELETE FROM posts WHERE id = '$id'";
    $result = $db->query($sql);
    
    if ($result){
        header('Location: index.php');
    }
    else{
        header('Location: error.php');
    }
    
?>