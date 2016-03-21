<?php
/**
 * Created by PhpStorm.
 * User: MVE
 * Date: 14-Mar-16
 * Time: 10:26
 */

// vt predefined variables - http://php.net/manual/en/reserved.variables.php

// /classes/http.php

function fixHtml($val){
    return htmlentities($val);
}

class http{
    var $vars = array(); // http päringust tulenevad andmed
    var $server = array(); // serveri poolsed andmed
    var $cookie = array(); //  küpsiste andmed näit kasutaja asukoht valuuta kuvamiseks, kellaaeg jms info, mida sobib kasutaja kohta koguda

    function  __construct(){
        $this->init();
        $this->initConst();
    }  // kostruktor

    function init(){
        $this->vars = array_merge($_GET, $_POST, $_FILES); // kasutaja võib edast oma vrts geti või posti või requestiga. Ühendame nende 3 massiiv array-mergega
        $this->server = $_SERVER;
        $this->cookie =$_COOKIE;
    } // init

    // tekitame mugavuse pärast mõned konstantid
    function initConst(){
        $vars = array('REMOTE ADDR', 'PHP_SELF', 'SCRIPT_NAME', 'HTTP_HOST');
        foreach($vars as $var){
            if(!defined($var) and isset($this->server[$var])){
                define($var, $this->server[$var]);
            }
        }
    } // initConst

    function get($name, $fix = false){
        if (isset($this->vars[$name])){
            if($fix){
                return fixHtml($this->vars[$name]);
            }
            return $this->vars[$name];
        }
        return false;
    } get

// funktsioon, mis annab muutujatele väärtused
    function set($name, $val){
        $this->vars[$name] = $val;
    } // set

    // funktsioon, mis kustutab muutuja ära
    function del($name){
        if(isset($this->vars[$name])){
            unset($this->vars[$name]);
        }
    } // del

    // määrame kuhu me peame minema
    function redirect($url = false){
        if($url == false){
            $url = $this->getLink();
        }
    $url = str_replace('&amp;', '&', $url);
    header('Location: '.$url);
    exit;
    }   // redirect ehk kas on olemas kuhu minna ja kui ei ole, siis kuhu minna

}   // http klassi lõpp

// halb test, mis ei ole turvaline, sest muutujad jäävad näha, aga õppe käigus sobib...
//$http = new http(); see ja järgmine rida on viidud üle konstruktorisse
//$http->init(); // muidu ei lähe hetkel initsialiseerimiseks
$http = new http();
$http->set('eesnimi','Anna');
$http->set('perenimi','Karutina');

$http->initConst();

echo '<pre>';   // jagab ilusti ridadele laiali, ilma echo'<pre>'-ta võrduks pilt var_dump vaatega
print_r($http->vars);
print_r($http->server);
print_r($http->cookie);
echo '<pre>';
echo HTTP_HOST;
// emuleerisime situatsiooni, et saatsime andmed POST'iga
echo $http->get('eesnimi').'<br />';  // 'nimi' ja 'perenimi' (viimane koos <b> tagidega) olid tal katsetusena juba massiivi sisestatud
echo $http->get('perenimi', true);
echo '<pre>';
?>