<?php
//Written By Edward Clorina
//Date: 9/29/2012
//file: index.php

    
?>
<?php require 'header.php' ?>
        <div id="content">
            <!--display each blog post in a new div element-->
            <?php
                $sql ="SELECT * FROM posts ORDER BY date DESC LIMIT 0, 5"; // Create our SQL Statement
                $result = $db->query($sql); // Get the result from the query
            ?>
            <?php if(($result->num_rows) != 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="posting">
                    <h3><a href="blogpost.php?id=<?= $row['id'] ?>"><?= $row['title']; ?></a></h3>
                    <h3 class="date"><?= date("F d, Y, h:i a", strtotime($row['date'])); ?></h3>
                    <?php if (strlen($row['body'])> 200): ?>
                        <p><?= substr($row['body'],0,200); ?>...</p>
                        <a href="blogpost.php?id=<?= $row['id'] ?>">Read More</a>
                    <?php else: ?>
                        <p><?= $row['body']; ?></p>
                    <?php endif;?>
                    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                </div>
            <?php endwhile; ?>
            <?php else: ?>
                <div class="posting">
                    <p>No blog posts found.</p>
                </div>
            <?php endif; ?>
        </div>
<?php require 'footer.php' ?>
        
