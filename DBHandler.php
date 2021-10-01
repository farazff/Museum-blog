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

    function getPictures(): array
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
            echo "Error: " . $sql . $this->conn->error;
        }
    }


}