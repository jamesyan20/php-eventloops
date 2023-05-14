<?php
require './src/Loops.php';
use Loop as Loop;



$loop = new Loop();
//non block sleep method (simple)

$loop->defer(function() use ($loop){
	$loop->next();
	echo("1");
});

$loop->defer(function() use ($loop){
	echo("2");
	$loop->next();
});

$loop->defer(function() use ($loop){
	echo( "3");
	$loop->next();
});


$loop->run();

