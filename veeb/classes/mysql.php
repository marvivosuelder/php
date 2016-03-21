<?php
// /classes/mysql.php

class mysql{
    var $conn = false;
    var $host = false;
    var $user = false;
    var $pass = false;
    var $dbname = false;

    var $history = array();

    function __construct($h, $u, $p, $n){
    $this->host = $h;
    $this->user = $u;
    $this->pass = $p;
    $this->dbname = $n;
    $this->connect();
    } // konstruktor

    function connect(){
    $this->conn = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        if (mysqli_connect_error()){
        echo 'Viga andmebaasi serveriga ühendumises <br />';
        exit;
        }
    } //connect

    function selectDb(){
        $res = mysqli_select_db($this->connect, $this->dbname);
        if($res === false){
            echo 'Ei saa andmebaasi kätte <br />';
            exit;
        }
    } // selectDB()

    function getMicrotime(){
        list($usec, $sec) = explode(' ', microtime());
        return ((float)$usec + (float)$sec);
    } // getMicrotime

    function query($sql){
        $begin =$this->getMicrotime();
        $res = mysqli_query($this->conn, $sql);
        if ($res == false){
            echo 'Viga päringus!<br />'.$sql.'<br />';
            echo mysqli_error($this->conn).'<br />';
            exit;
        }
        $time = $this->getMicrotime() - $begin;
        $this->history[] = array(
            'sql' => $sql,
            'time' => $time
        );
        return $res;
    } //query

    function getArray($sql){
        $res = $this->query($sql);
        $data = array();
        while($record = mysqli_fetch_assoc($res)){
            $data[] = $record;
        }
        if (count($data) == 0){
            return false;
        }
        return $data;
    } //getArray

    function showHistory(){
        if (count($this->history) > 0){
            echo '<hr />';
            foreach ($this->history as $key=>$val){
                echo '<li>'.$val['sql'].'<br /><strong>';
                echo round($val['time'],6).'</strong></li>';
            }
        }
    }// showHistory
} //mysql klassi lõpp

$db = new mysql('localhost', 'marvivosuelder', 'eiseis6a', 'marvivosuelder_TOL');
echo '<pre>';
print_r($db);
echo '<pre>';

//echo '<pre>';
$db->query('show tables');
$db->getArray('select * from FLIGHT');
$db->showHistory();
//echo '<pre>';

?>