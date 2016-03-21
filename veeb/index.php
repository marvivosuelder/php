<?php
/**
 * Created by PhpStorm.
 * User: MVE
 * Date: 14-Mar-16
 * Time: 12:49
 */

// vajalikud konstandid

//küsi selle faili sisu kelleltki uuesti
//see, http ja tekst fail istuvad väljaspool classes ja tmpl kausta

//index.php näitab ilusat htmli tabelit, koos sisuga siia tuleb menüü, kuupäev jne.

//define(....)
define('BASE_DIR', './');

define('SITENAME', 'Veebiprogrammeerimine');
define('CLASSES_DIR', BASE_DIR.'classes/');
define('TML_DIR', BASE_DIR,'tmpl');

require_once (CLASSES_DIR.'template.php');
require_once (CLASSES_DIR.'http.php');
require_once (CLASSES_DIR.'linkobject.php');
require_once (CLASSES_DIR.'mysql.php');

require_once ('../dbconf.php');

// valmistame vajalikud objektid
$http = new linkobject();
$db = new mysql('DBHOST', 'DBUSER', 'DBPASS', 'DBNAME');

// loome pealehe tempalte ja täidame sisuga ning väljsatame
$tmpl = new template('main');

require_once ('menu.php');
$tmpl->set('menyy', $menu->parse());
$tmpl->set('nav_bar', strftime(' %A, %d.%B.%Y %H.%M'));
$tmpl->set('lang_bar', 'Siia tuleb keelevahetus (kunagi)');
$tmpl->set('body', 'Lehe sisu');
$tmpl->set('body', '<br /> ja midagi veel');
$tmpl->set

//väljastame täidetud template
echo $tmpl->parse();
//andmebaasi päringute kontroll
$db->showHistory();