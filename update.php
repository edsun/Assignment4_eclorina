<?php
    require('connect.php'); // Require the connect.php file, which will connect to our database
    include('SimpleImage.php'); // Include the SimpleImage file, contains functions to resize images
    
    
    // Grab the Title and body
    $id = $_GET['id'];
    
    if (!is_numeric($id)){
        header('Location: index.php'); // Bring them back to the select.php page
        die; // Kill the script
    }
    
    $result = false;
    
    // Handle the image upload first
    if(isset($_FILES['image'])){
        $imageinfo = getimagesize($_FILES['image']['tmp_name']); //Grab the image information
        // Grab the width and height for the image
        list($width, $height) = getimagesize($_FILES['image']['tmp_name']);
    
        // Check if the image type is either JPG, PNG, or GIF
        if ($imageinfo['mime'] == 'image/gif' || $imageinfo['mime'] == 'image/jpeg' || $imageinfo['mime'] == 'image/png'){
            // Store the current filename in a variable
            $oldname = basename($_FILES['image']['name']);
            
            // Create the new filename for our image
            $newname = dirname(__FILE__).'\\upload\\'.$oldname;
            
            // Move the uploaded file to our new directory
            // If it did not work, redirect to our error page.
            if (!(move_uploaded_file($_FILES['image']['tmp_name'],$newname))){
                header("Location: error.php");
            }
            
            // Get the variables we will fill into our database
            $filename = $_FILES['image']['name'];
            $type = $imageinfo['mime'];
            
            // Create our SQL statement
            $sql = "INSERT INTO images (filename,mimetype,height,width) VALUES ('$filename','$type','$height','$width')";
            $result = $db->query($sql);
            
            
            // Substring to grab the last 4 characters (.jpg, .png, .gif)
            $file_type = substr($filename, strlen($filename) - 4);
            $image = substr($filename, 0, strlen($filename) - 4);
            
            
            // Now we save our thumbnail and use for blog images
            $thumbnail = new SimpleImage();
            $thumbnail->load($newname);
            $thumbnail->resizeToWidth(100);
            $thumbnail->save(dirname(__FILE__).'\\upload\\'.$image."_thumb".$file_type);
            
            // Use for blog image
            $blog = new SimpleImage();
            $blog->load($newname);
            $blog->resizeToWidth(200);
            $blog->save(dirname(__FILE__).'\\upload\\'.$image."_blog".$file_type);
            
            // Redirect the user 
            if(!$result){
               header("Location: error.php");
            }
        }
    }
    
    if(strlen($_POST['title'])> 1 && strlen($_POST['body']) > 1){
        
        $title = mysql_real_escape_string($_POST['title']);
        $body = mysql_real_escape_string($_POST['body']);
        
        if(isset($_FILES['image'])){
            $image_id = mysqli_insert_id($db);
        }
        else{
            $image_id = NULL;
        }
        
        if(isset($_POST['delete_image'])){
            $sql = "UPDATE posts SET title = '$title',body = '$body',image_id = NULL WHERE id = '$id'"; // create SQL statement
        }
        else{
            $sql = "UPDATE posts SET title = '$title',body = '$body',image_id = '$image_id' WHERE id = '$id'"; // create SQL statement
        }
        $result = $db->query($sql); // Get the result from the query
    }
?>
<?php require 'header.php' ?>
    <div id="content">
        <div class="posting">
            <?php if($result): ?>
                <?php
                    header("Location: index.php");
                    exit;
                ?>
            <?php else: ?>
                <?php header("Location: error.php"); ?>
            <?php endif; ?>
        </div>
    </div>    
<?php require 'footer.php' ?>