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
	$search_term = urldecode(safeGet('keywords'));
	include_once('./components/head.php');
?>

    <h2 class="mt-4">View Grade(s)</h2>

    <form action="controllers/savegrade.php" method="post">
		<div class="card">
			<div class="card-body">
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Student</label>
					<div class="col-sm-8">
						<select class="custom-select" name="student_id">
							<option selected value="0">All</option>			
						<?php	
							$students = Student::all(null);
							foreach ($students as $student) {
						?>
							<option value="<?=$student->id?>" <?=($student->name == $search_term) ? "selected" : ""?>><?=$student->name?></option>
						<?php } ?>
						</select>
					</div>
				</div>
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Course</label>
					<div class="col-sm-8">
						<select class="custom-select" name="course_id">
							<option selected value="0" disabled>All</option>			
						<?php	
							$courses = Course::all(null);
							foreach ($courses as $course) {
						?>
							<option value="<?=$course->id?>" <?=($course->name == $search_term) ? "selected" : ""?>><?=$course->name?></option>
						<?php } ?>
						</select>
					</div>
				</div>
		    	<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Course Name - Study Year</th>
							<th scope="col">Student Name (ID)</th>
							<th scope="col">Grade of student/Max. Grade</th>
							<th scope="col"></th>
						</tr>
					</thead>
					<tbody>
						<?php	
							$grades = Grade::all(safeGet('keywords'));
							foreach ($grades as $grade) {
						?>
						<tr>
							<td><?=$grade->id?></td>
							<td><?= "$grade->course_name (Year: $grade->course_study_year)"?></td>
							<td><?= "$grade->student_name ($grade->student_id)"?></td>
							<td><?=$grade->grade . "/" . $grade->course_max_grade?></td>
							<td>
								<button class="button edit_grade" id="<?=$grade->id?>">Edit</button>&nbsp;
								<button class="button delete_grade" id="<?=$grade->id?>">Delete</button>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
		    </div>
		</div>
    </form>

<?php include_once('./components/tail.php') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('.edit_grade').click(function(event) {
			window.location.href = "editgrade.php?id="+$(this).attr('id');
		});
	
		$('.delete_grade').click(function(){
			var anchor = $(this);
			$.ajax({
				url: './controllers/deletegrade.php',
				type: 'GET',
				dataType: 'json',
				data: {id: anchor.attr('id')},
			})
			.done(function(reponse) {
				if(reponse.status==1) {
					anchor.closest('tr').fadeOut('slow', function() {
						$(this).remove();
					});
				}
			})
			.fail(function() {
				alert("Connection error.");
			})
		});
		
		//Change table on changing dropdown lists
		$('select').change(function() {
			var selected_option = $(this).find(':selected').html();
			window.location = 'customgrades.php?keywords='+encodeURI(selected_option);
		});
	});
</script>