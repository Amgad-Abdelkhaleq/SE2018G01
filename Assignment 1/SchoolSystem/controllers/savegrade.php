<?php
	include_once("../controllers/common.php");
	include_once("../models/grade.php");
	Database::connect('epiz_22918393_school', 'epiz_22918393', 'ynaRH6xA7v');
	//Database::connect('school', 'root', '');
	$id = safeGet("id", 0);
	if($id==0) {
		Grade::add(safeGet("student_id"),safeGet("course_id"),safeGet("grade"));
	} else {
		$grade = new Grade($id);
		$grade->student_id = safeGet("student_id");
		$grade->course_id = safeGet("course_id");
		$grade->grade = safeGet("grade");
		$grade->save();
	}
	header('Location: ../grades.php');
?>