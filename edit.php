<?php require 'authenticate.php' ?>
<?php require 'header.php' ?>
<?php
    //connect to the DB, get the passed ID
    //create SQL to select the appropriate qoute
    $id = $_GET['id'];
    
    if (!is_numeric($id)){
        header('Location: index.php'); // Bring them back to the select.php page
        die; // Kill the script
    }
    
    $sql = "SELECT * FROM posts WHERE id = {$id}"; // Create SQL Statement
    $result = $db->query($sql); // Get the results of the query
    
    
    if (!$result || $result->num_rows != 1){
        header('Location: index.php');
        die;
    }
?>
        <div id="content">
            <div class="posting">
                <h2>Edit your blog post.</h2>
                <form action="update.php?id=<?= $id ?>" method="post" enctype="multipart/form-data">
                        <?php while($row = $result->fetch_assoc()): ?>
                        <label for="title">Title</label><br />
                        <input type="text" name="title" id="title" value="<?= $row['title']; ?>"/><br />
                        <label for="body">What's on your mind?</label>
                        <textarea name="body" id="body" rows="5" cols="35"><?= $row['body']; ?></textarea>
                        
                        <label for="image">(Optional)Image:</label>
                        <?php
                            $image_id = $row['image_id'];
                            $sql = "SELECT * FROM images LEFT OUTER JOIN posts ON images.id = posts.image_id WHERE posts.image_id = '$image_id'";
                            $image_result = $db->query($sql);
                            
                            if ($image_result->num_rows != 0){
                                while ($image_row = $image_result->fetch_assoc()){
                                    $filename = $image_row['filename'];
                                    
                                    // Substring to grab the last 4 characters (.jpg, .png, .gif)
                                    $file_type = substr($filename, strlen($filename) - 4);
                                    $image = substr($filename, 0, strlen($filename) - 4);
                                }
                            }
                            else{
                                $image_result = false;
                            }
                            
                        ?>
                        <?php if($image_result != false): ?>
                            <br /><img src="upload/<?= $image."_thumb".$file_type ?>" alt="<?= $image ?>" /><br />
                            <label for="delete_image">Delete Image:</label>
                            <input type="checkbox" name="delete_image" /><br />
                        <?php else: ?>
                            <input type="file" name="image" id="image" /><br />
                        <?php endif; ?>
                        <input value="Update Post" type="submit" name="update" />
                        <?php endwhile; ?>
                </form>
                <form class="delete" action="delete.php?id=<?= $id ?>" method="post">
                    <div>
                        <input class="confirm" type="submit" name="command" value="delete" />
                    </div>
                </form>
            </div>
        </div>
<?php require 'footer.php' ?>