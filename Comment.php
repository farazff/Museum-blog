<html lang="EN">
<head>
    <title>New Comment</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <?php
        $commentErr = "";
        $isStory = false;
        $isPicture = false;
        $id = -1;
        include "DBHandler.php";
        include "TextToSpeech.php";
        $db = new DBHandler();

        $comment = $postId = $replyId = "";

        if (isset($_GET["picId"])) {
            $isPicture = true;
            $id = $_GET["picId"];
        }

        if (isset($_GET["storyId"])) {
            $isStory = true;
            $id = $_GET["storyId"];
        }

        if (isset($_POST["submit"])) {
            $text = $_POST['text'];
            $writer_name = $_POST['writer_name'];
            if($isPicture)
            {
                $DbID = $db->addPictureComment($text, $writer_name, $id);
                $convertor = new TextToSpeech();
                $convertor->CreateSpeechFile($text, 'P.' . $DbID['id']);
                header("Location: Pictures.php");
            }
            if($isStory)
            {
                $DbID = $db->addStoryComment($text, $writer_name, $id);
                $convertor = new TextToSpeech();
                $convertor->CreateSpeechFile($text, 'S.' . $DbID['id']);
                header("Location: Stories.php");
            }

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