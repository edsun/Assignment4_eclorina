<?php
    require 'header.php';
    
    $sql ="SELECT * FROM posts WHERE image_id IS NOT NULL"; // Create our SQL Statement
    $result = $db->query($sql); // Get the result from the query
?>
        <div id="content">
            <!--display each blog post containing an image in a new div element-->
            <?php if(($result->num_rows) != 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="posting">
                    <?php
                            $image_id = $row['image_id'];
                            $sql = "SELECT * FROM images WHERE id = '$image_id'";
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
                            <a href="blogpost.php?id=<?= $row['id'] ?>"><img src="upload/<?= $image."_thumb".$file_type ?>" alt="<?= $image ?>" /></a>
                        <?php endif; ?>
                </div>
            <?php endwhile; ?>
            <?php else: ?>
                <div class="posting">
                    <p>No blog posts with images found.</p>
                </div>
            <?php endif; ?>
        </div>
<?php require 'footer.php' ?>