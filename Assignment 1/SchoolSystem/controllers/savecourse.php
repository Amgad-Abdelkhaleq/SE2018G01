<?php
	include_once("../controllers/common.php");
	include_once("../models/course.php");
	Database::connect('epiz_22918393_school', 'epiz_22918393', 'ynaRH6xA7v');
	//Database::connect('school', 'root', '');
	$id = safeGet("id", 0);
	if($id==0) {
		Course::add(safeGet("name"),safeGet("study_year"),safeGet("max_grade"));
	} else {
		$course = new Course($id);
		$course->name = safeGet("name");
		$course->study_year = safeGet("study_year");
		$course->max_grade = safeGet("max_grade");
		$course->save();
	}
	header('Location: ../courses.php');
?>