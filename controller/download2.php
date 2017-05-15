<h1>Downloading</h1>
<?php

$from_date = null;
$to_date = null;
$energy = null;
$power =  null;

if(isset($_POST['from_date'])){
	$from_date = $_POST['from_date'];
}

if(isset($_POST['to_date'])){
	$to_date = $_POST['to_date'];
}

if(isset($_POST['energy'])){
	$energy = $_POST['energy'];
	if($energy == "on"){
		$energy = true;
	}
}

if(isset($_POST['power'])){
	$power = $_POST['power'];
	if($power == "on"){
		$power = true;
	}
}

echo "$from_date <br>";
echo "$to_date <br>";
echo "$energy <br>";
echo "$power <br>";

?>