<?php


class DBHandler
{
    private string $servername;
    private string $username;
    private string $password;
    private string $dbname;
    private mysqli $conn;

    function __construct()
    {
        $this->servername = "localhost";
        $this->username = 'root';
        $this->password = "";
        $this->dbname = "MuseumDB";
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    }

    function getPictures(): ?array
    {
        $sql = "select id, link, painter_name FROM pictures";

        if (($respond = $this->conn->query($sql)) == TRUE) {
            $pictures = [];
            while ($row = $respond->fetch_assoc()) {
                $pictures[] = [
                    'id' => $row['id'],
                    'link' => $row['link'],
                    'painter_name' => $row['painter_name'],
                ];
            }
            return $pictures;
        } else {
            return null;
        }
    }


    function getStories(): ?array
    {
        $sql = "select id, text, writer_name FROM pictures";

        if (($respond = $this->conn->query($sql)) == TRUE) {
            $stories = [];
            while ($row = $respond->fetch_assoc()) {
                $stories[] = [
                    'id' => $row['id'],
                    'text' => $row['text'],
                    'writer_name' => $row['writer_name'],
                ];
            }
            return $stories;
        } else {
            return null;
        }
    }

    function addPictureComment($text, $writerName, $picId)
    {
        $sql = "INSERT INTO picture_comment (text, writer_name, pic_id)
            VALUES ('{$text}', '{$writerName}', '{$picId}')";

        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . $this->conn->error;
        }
    }

    function addStoryComment($text, $writerName, $storyId)
    {
        $sql = "INSERT INTO story_comment (text, writer_name, story_id)
            VALUES ('{$text}', '{$writerName}', '{$storyId}')";

        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . $this->conn->error;
        }
    }

}