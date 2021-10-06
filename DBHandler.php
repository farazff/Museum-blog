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

    function getPictureComment($picId): ?array
    {
        $sql = "select id, text, writer_name FROM picture_comment WHERE pic_id='{$picId}'";

        if (($respond = $this->conn->query($sql)) == TRUE) {
            $comments = [];
            while ($row = $respond->fetch_assoc()) {
                $comments[] = [
                    'id' => $row['id'],
                    'text' => $row['text'],
                    'writer_name' => $row['writer_name'],
                ];
            }
            return $comments;
        } else {
            return null;
        }
    }

    function getStories(): ?array
    {
        $sql = "select id, title, text, writer_name FROM stories";

        if (($respond = $this->conn->query($sql)) == TRUE) {
            $stories = [];
            while ($row = $respond->fetch_assoc()) {
                $stories[] = [
                    'id' => $row['id'],
                    'title' => $row['title'],
                    'text' => $row['text'],
                    'writer_name' => $row['writer_name'],
                ];
            }
            return $stories;
        } else {
            return null;
        }
    }

    function getStoryComment($storyId): ?array
    {
        $sql = "select id, text, writer_name FROM story_comment WHERE story_id='{$storyId}'";

        if (($respond = $this->conn->query($sql)) == TRUE) {
            $comments = [];
            while ($row = $respond->fetch_assoc()) {
                $comments[] = [
                    'id' => $row['id'],
                    'text' => $row['text'],
                    'writer_name' => $row['writer_name'],
                ];
            }
            return $comments;
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
            $sql = "select id FROM picture_comment ORDER BY id DESC LIMIT 1";
            return $this->conn->query($sql)->fetch_array();

        } else {
            echo "Error: " . $sql . $this->conn->error;
            return null;
        }
    }

    function addStoryComment($text, $writerName, $storyId)
    {
        $sql = "INSERT INTO story_comment (text, writer_name, story_id)
            VALUES ('{$text}', '{$writerName}', '{$storyId}')";

        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
            $sql = "select id FROM story_comment ORDER BY id DESC LIMIT 1";
            return $this->conn->query($sql)->fetch_array();
        } else {
            echo "Error: " . $sql . $this->conn->error;
            return null;
        }
    }

}