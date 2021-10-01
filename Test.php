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

//                echo '<a href="'.$pictures[$i]['link'].'" /></a>';
                echo '<img  src="'.$pictures[$i]['link'].'">  ';
                echo '<br>';
            }
//            echo "writer: ", $db->getName($writer);
        ?>
    </body>
</html>