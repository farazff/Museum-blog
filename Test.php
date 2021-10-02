<html lang="EN">
<head>
    <title>Pictures</title>
    <link rel="stylesheet" href="styles.css">
</head>
    <body>


        <?php
            include 'DBHandler.php';
            $db = new DBHandler();

            $pictures = $db->getPictures();

            for($i = 0; $i < count($pictures); $i++)
            {
                echo '<img  src="'.$pictures[$i]['link'].'">  ';
                echo '<h3>Painter: '.$pictures[$i]['painter_name'].'</h3>';

                $comments = $db->getPictureComment($pictures[$i]['id']);
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