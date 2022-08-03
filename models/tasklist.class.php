<?php


class Tasklist extends DataBase
{

    private $pdo;
    private $database;

    public string $namegroup;


    public function getTaskNotValid()
    {
        $getallinfos = $this->connect()->prepare("SELECT * FROM tasklist WHERE status = ? and id_users = ?");
        $getallinfos->execute(array(0, $_SESSION['taskies_id_user']));
        $getallinfosinfo = $getallinfos->fetchAll();
        return $getallinfosinfo;
    }

    public function getTaskValid()
    {
        $getallinfos = $this->connect()->prepare("SELECT * FROM tasklist WHERE status = ? and id_users = ?");
        $getallinfos->execute(array(1, $_SESSION['taskies_id_user']));
        $getallinfosinfo = $getallinfos->fetchAll();
        return $getallinfosinfo;
    }
}

$tasklist = new Tasklist();
