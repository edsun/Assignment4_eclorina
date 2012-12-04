<?php

    require 'connect.php'; /*Connect to the Database*/
    $sql ="SELECT * FROM posts ORDER BY date DESC LIMIT 0,5"; // Create our SQL Statement
    $result = $db->query($sql); // Get the result from the query
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Edward's Guild Wars 2 Blog</title>
	<link rel="stylesheet" type="text/css" href="pagestyle.css" />
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
	  $(document).ready(function() {
	    $("form.delete").submit(function() {        
		   return confirm("Are you sure you want to delete this page?");
	    });
	  });  
	</script>
</head>
<body>
    <div id="wrapper">
        <div id="header">
	    <img src="images/GW2_logo_2c.jpg" alt="GW2 Logo" width="170" height="123" />
	    <h1>EDWARD'S GUILD WARS 2 BLOG</h1>
        </div>
        <div id="navigation">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="archive.php">Archive</a></li>
                <li><a href="newpost.php">New Post</a></li>
		<li><a href="gallery.php">Image Gallery</a></li>
            </ul>
        </div>
        <div id="sidebar">
	  <h3>Recent Blog Entries</h3>
            <ul>
		<?php if(($result->num_rows) != 0): ?>
		  <?php while($row = $result->fetch_assoc()): ?>
		    <li>
			<?php if(strlen($row['title']) > 20): ?>
				<a href="blogpost.php?id=<?= $row['id'] ?>"><?= substr($row['title'], 0,20); ?>...</a>
			<?php else: ?>
				<a href="blogpost.php?id=<?= $row['id'] ?>">
				  <?= $row['title']; ?>
				</a>
			<?php endif; ?>
		    </li>
		  <?php endwhile; ?>
		<?php else: ?>
		   <li>
			<p>No blogs posts.</p>
		   </li>
		<?php endif; ?>
            </ul>
        </div>