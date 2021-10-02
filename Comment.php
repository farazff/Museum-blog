<html lang="EN">
<head>
    <title>New Comment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php
        $commentErr = "";
        include "DBHandler.php";
        $db = new DBHandler();

        $comment = $postId = $replyId = "";

//        if (isset($_GET["type"])) {
//            $_SESSION['postId'] = $_GET['id'];
//            $_SESSION['replyId'] = $_GET['replyId'];
//        }

        if (isset($_POST["submit"])) {

            $text = $_POST['text'];
            $writer_name = $_POST['writer_name'];
            $db->addPictureComment($text, $writer_name, 1);
            header("Location: Pictures.php");
        }
    ?>

    <h1>New Comment</h1>

    <form method="POST">
        <div>
            <span class="error" style="color: red"><?php echo $commentErr ?></span><br>
            <p> Full Name: <textarea name="writer_name"><?php echo $comment;?> </textarea><br>  </p>
            <p> Comment text: <textarea name="text"><?php echo $comment;?> </textarea><br>  </p>
            <input class="button" type="submit" name="submit" value="submit">
        </div>
    </form>
</body>
</html>