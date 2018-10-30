<?php
	
	$searchPage = "grades";
	include_once("./controllers/common.php");
	
	include_once('./models/grade.php');
	include_once('./models/student.php');
	include_once('./models/course.php');
	$id = safeGet('id');
	Database::connect('epiz_22918393_school', 'epiz_22918393', 'ynaRH6xA7v');
	//Database::connect('school', 'root', '');
	$grade = new Grade($id);
	$title = ($id ?"Edit":"Add")." Grades";
	include_once('./components/head.php');
?>

    <h2 class="mt-4"><?=($id)?"Edit":"Add"?> Grade</h2>

    <form action="controllers/savegrade.php" method="post">
    	<input type="hidden" name="id" value="<?=$grade->get('id')?>">
		<div class="card">
			<div class="card-body">
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Student</label>
					<div class="col-sm-8">
						<select class="custom-select" name="student_id">
							<option selected disabled>Open this to select a student</option>			
						<?php	
							$students = Student::all(safeGet('keywords'));
							foreach ($students as $student) {
						?>
							<option value="<?=$student->id?>" <?=($student->id == $grade->get('student_id')) ? "selected" : ""?>><?=$student->name?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Course</label>
					<div class="col-sm-8">
						<select class="custom-select" name="course_id">
							<option selected disabled>Open this to select a course</option>			
						<?php	
							$courses = Course::all(safeGet('keywords'));
							foreach ($courses as $course) {
						?>
							<option value="<?=$course->id?>" <?=($course->id == $grade->get('course_id')) ? "selected" : ""?>><?=$course->name . " - " . $course->study_year . " (Maximum Grade: " . $course->max_grade . ")"?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Student Grade</label>
					<div class="col-sm-8">
						<input class="form-control" type="text" name="grade" value="<?=$grade->get('grade')?>" required>
					</div>
				</div>
		    	<div class="form-group">
		    		<button class="button float-right" type="submit">Add</button>
		    	</div>
		    </div>
		</div>
    </form>

<?php include_once('./components/tail.php') ?>