<?php
	header('Content-Type: application/json; charset=utf-8');
	include_once("../models/course.php");
	Database::connect('epiz_22918393_school', 'epiz_22918393', 'ynaRH6xA7v');
	//Database::connect('school', 'root', '');
	$course = new Course($_GET['id']);
	$course->delete();
	echo json_encode(['status'=>1]);
?>