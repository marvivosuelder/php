<?php
/**
 * Created by PhpStorm.
 * User: MVE
 * Date: 14-Mar-16
 * Time: 10:26
 */


// /classes/linkobject.php

require_once('http.php');

function fixUrl($val){
    return urlencode($val);
}

// "probleemsete" märkide defineerimine meile sobivasse kasutusse
class linkobject extends http{
    var $baseUrl = false;
    var $delim = '&auml';
    var $eq = '=';
    var $protocol = 'http://';

    function __construct()
    {
        parent::__construct();
        $this->baseUrl = $this->protocol.HTTP_HOST.SCRIPT_NAME; // need konstantid valmistasime http.php failis ette
        echo $this->...; // väljastame endale vaatamiseks siin samas
    }

    function addToLink(&$link, $name, $val) // & võimaldab nende poole pöörduda isegi enne, kui funktsioon on välja kutsutud
{
    if($link != ''){
        $link = $link.$this->delim;
    }
    $link = $link.fixUrl($name).$this->eq.fixUrl($val);
}

    function getLink($add = array()){
        $link = ''; // abiväärtus

        foreach($add as $name=>$val){
            $this->addToLink($link, $name, $val);
        }

        if ($link != ''){
            $link = $this->baseUrl.'?'.$link;
        }
        else{
            $link = $this->baseUrl;
        }
    } // getLink


} // linkobject klassi lõpp

$http = new linkobject();
$http->redirect();


$https = new  linobject();
echo $http->addToLink('', 'eesnimi', 'Anna');
$http->getLink(array('eesnimi'=>'Anna', 'perenimi'=>'karutina'));
?>