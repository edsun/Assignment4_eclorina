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
    <?php if(($result->num_rows) != 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
        <?php
            $image_id = $row['image_id'];
            $sql = "SELECT * FROM images LEFT OUTER JOIN posts ON images.id = posts.image_id WHERE posts.image_id = '$image_id'";
            $image_result = $db->query($sql);
            
            if ($image_result->num_rows != 0){
                while ($image_row = $image_result->fetch_assoc()){
                    $filename = $image_row['filename'];
                }
            }
            else{
                $image_result = false;
            }
        ?>
        <div class="posting">
            <?php if($image_result): ?>
                <img src="upload/<?= $filename ?>" alt="<?= $filename ?>" />
            <?php endif; ?>
            <h3 class="date"><?= date("F d, Y, h:i a", strtotime($row['date'])); ?></h3>
            <h3><?= $row['title']; ?></h3>
            <p><?= $row['body']; ?></p>
            <a href="edit.php?id=<?= $row['id'] ?>">EDIT</a>
        </div>
    <?php endwhile; ?>
    <?php else: ?>
        <div class="posting">
            <p>No blog posts found.</p>
        </div>
    <?php endif; ?>
    </div>
<?php require 'footer.php' ?>