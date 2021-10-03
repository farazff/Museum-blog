<html lang="EN">
<head>
    <title>Stories</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
    include 'DBHandler.php';
    $db = new DBHandler();

    $stories = $db->getStories();

    for($i = 0; $i < count($stories); $i++)
    {
        echo '<h2>'.$stories[$i]['title'].'</h2>';
        echo '<h3>'.$stories[$i]['text'].'</h3>';
        echo '<h3>Writer: '.$stories[$i]['writer_name'].'</h3>';

        echo '<a href="Comment.php?type=newComment&storyId='.$stories[$i]['id'].'">Write comment</a>';

        $comments = $db->getStoryComment($stories[$i]['id']);
        if(count($comments) != 0)
        {
            echo '<h2>Comments:</h2>';
        }

        for($j = 0; $j < count($comments); $j++)
        {
            echo '<h3>'.$comments[$j]['writer_name']. ': '.$comments[$j]['text'].'</h3>';
        }

        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
    }
    ?>
</body>
</html>