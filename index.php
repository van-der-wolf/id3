<?php

$loader = require 'vendor/autoload.php';
$loader->add('AppName', __DIR__.'/../src/');

$file = new \Id3\Mp3File('1.mp3');
if(1){}