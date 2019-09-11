<?php

class SpeedForm
{
    private $conn;
    private $table = 'speedform';

    public $download;
    public $upload;
    public $ping;
    public $jitter;
    public $location;
    public $carrier;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function postForm()
    {
        $query =
            '
                  INSERT INTO 
                    ' . $this->table . '
                  SET 
                    download = :download, 
                    upload = :upload,
                    ping = :ping,
                    jitter = :jitter,
                    location = :location,
                    carrier = :carrier              
             ';

        $stmt = $this->conn->prepare($query);

        // both methods turn blank values into 0.000's
        // strip_tags removes HTMl and PHP tags from a string
        // other option is to just require ping and jitter so no blank values allowed
        $this->download = htmlspecialchars(strip_tags($this->download));
        $this->upload = htmlspecialchars(strip_tags($this->upload));
        //$this->ping = htmlspecialchars(strip_tags($this->ping));
        //$this->jitter = htmlspecialchars(strip_tags($this->jitter));
        $this->location = htmlspecialchars(strip_tags($this->location));
        $this->carrier = htmlspecialchars(strip_tags($this->carrier));

        $stmt->bindParam(':download', $this->download);
        $stmt->bindParam(':upload', $this->upload);
        $stmt->bindParam(':ping', $this->ping);
        $stmt->bindParam(':jitter', $this->jitter);
        $stmt->bindParam(':location', $this->location);
        $stmt->bindParam(':carrier', $this->carrier);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);
        return false;
    }


}