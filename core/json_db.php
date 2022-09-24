<?php

class JsonDB
{
    private $fileName;
    private $databasePath;

    private $DB_FOLDER = "db";

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->databasePath = $_SERVER['DOCUMENT_ROOT'] . $this->DB_FOLDER . DIRECTORY_SEPARATOR . $this->getFileName();
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getDatabasePath()
    {
        return $this->databasePath;
    }

    public function isEmpty()
    {
        return filesize($this->getDatabasePath()) == 0;
    }

    public function getData()
    {
        if (!$this->isEmpty() && file_exists($this->getDatabasePath())) {
            return json_decode(file_get_contents($this->getDatabasePath()));
        } else {
            return [];
        }
    }

    public function addItem($item)
    {
        $data = $this->getData();
        array_push($data, $item);
        $this->save($data);
    }

    public function deleteItem($item)
    {
        $data = $this->getData();
        foreach ($data as $db_item) {
            if ($db_item == $item) {
                unset($data[$item]);
                break;
            }
        }
        $this->save($data);
    }

    public function clear()
    {
        unlink($this->getDatabasePath());
    }

    private function save($data)
    {
        file_put_contents(
            $this->getDatabasePath(),
            json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );
    }
}
