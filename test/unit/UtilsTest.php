<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';
 
$t = new lime_test(2, new lime_output_color());
$t->isnt(Utils::generateHash(), '', '::generateHash() return a non-empty value');
$t->isnt(Utils::generateHash(), Utils::generateHash(), '::generateHash() return different values each times');