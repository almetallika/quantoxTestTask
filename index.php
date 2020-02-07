<?php
namespace App;

//use App\db;
//use App\Students;

include('dbconfig.php');
require_once('db.php');
require_once('Students.php');

$routing = (strlen($_SERVER['REQUEST_URI']) == 1) ? array() : explode('/', substr($_SERVER['REQUEST_URI'],1));

if (count($routing) == 0) {
	
	echo "No parameters...<br/>";
	echo "--------------------------------<br/>";
	echo "/students				- list of all students<br/>";
	echo "/student/studentId		- student statistics<br/>";

	die();
}

switch($routing[0]){
	case "students":
		$data = db::super_query("SELECT s.id, s.name, b.name as schoolBoard FROM students s LEFT JOIN boards b ON (b.id=s.schoolBoard)",true);
		echo json_encode($data);
		break;
	case "student":
		if (!isset($routing[1]) or ($routing[1] == '')) {
			die ("no student ID!");
		}
		Students::getStudentData($routing[1]);
		break;
}
