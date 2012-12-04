<?php require 'authenticate.php' ?>
<?php require 'header.php' ?>
        <div id="content">
            <div class="posting">
                <h2>Input your new blog post.</h2>
                <form action="insert.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <label for="title">Title</label><br />
                        <input type="text" name="title" id="title" /><br />
                        <label for="body">What's on your mind?</label>
                        <textarea name="body" id="body" rows="5" cols="35"></textarea>
                        <label for="image">(Optional)Image:</label>
                        <input type="file" name="image" id="image" />
                        <br />
                        <input value="Post it!" type="submit" />
                    </fieldset>
                </form>
            </div>
        </div>
<?php require 'footer.php' ?>