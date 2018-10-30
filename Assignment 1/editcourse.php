<?php
	
	$searchPage = "courses";
	include_once("./controllers/common.php");
	
	include_once('./models/course.php');
	$id = safeGet('id');
	Database::connect('epiz_22918393_school', 'epiz_22918393', 'ynaRH6xA7v');
	//Database::connect('school', 'root', '');
	$course = new Course($id);
	$title = ($id ?"Edit":"Add")." Courses";
	include_once('./components/head.php');
?>

    <h2 class="mt-4"><?=($id)?"Edit":"Add"?> Course</h2>

    <form action="controllers/savecourse.php" method="post">
    	<input type="hidden" name="id" value="<?=$course->get('id')?>">
		<div class="card">
			<div class="card-body">
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Name</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="name" value="<?=$course->get('name')?>" required>
					</div>
				</div>
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Study Year</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="study_year" value="<?=$course->get('study_year')?>" required>
					</div>
				</div>
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Maximum Grade</label>
					<div class="col-sm-10">
						<input class="form-control" type="text" name="max_grade" value="<?=$course->get('max_grade')?>" required>
					</div>
				</div>
		    	<div class="form-group">
		    		<button class="button float-right" type="submit">Add</button>
		    	</div>
		    </div>
		</div>
    </form>

<?php include_once('./components/tail.php') ?>