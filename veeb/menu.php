<?php
/**
 * Created by PhpStorm.
 * User: MVE
 * Date: 21-Mar-16
 * Time: 12:28
 */
if(!defined('BASE_DIR')){
    exit;
}
$menu = new template('menu.menu');
$menu_item = new template('menu.item');

$menu_item->set('name', 'kontakt');
$link = $http->getLink(array('act'=>'contact'));
$menu_item->set('link','$link');
$menu->add('items', $menu_item->parse());

?>