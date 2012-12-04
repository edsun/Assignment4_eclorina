<?php require 'header.php' ?>
        <div id="content">
            <div class="posting">
                <?php
                    $sql ="SELECT * FROM posts ORDER BY date DESC"; // Create our SQL Statement
                    $result = $db->query($sql); // Get the result from the query
                ?>
                <h2>List of all blog entries.</h2>
                <ul>
                    <?php if(($result->num_rows) != 0): ?>
                      <?php while($row = $result->fetch_assoc()): ?>
                        <li>
                              <h3><?= $row['title']; ?></h3>
                              <p class="date"><?= date("F d, Y, h:i a", strtotime($row['date'])); ?></p>
                              <a href="blogpost.php?id=<?= $row['id'] ?>">VIEW</a>
                              <a href="edit.php?id=<?= $row['id'] ?>">EDIT</a>
                        </li>
                      <?php endwhile; ?>
                    <?php else: ?>
                       <li>
                            <p>No blogs posted.</p>
                       </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
<?php require 'footer.php' ?>