<?php
	include_once('database.php');

	class Grade extends Database{
		function __construct($id) {
			$sql = "SELECT * FROM grades WHERE id = $id;";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			if(empty($data)){return;}
			foreach ($data as $key => $value) {
				$this->{$key} = $value;
			}
		}

		public static function add($student_id,$course_id,$grade) {
			$sql = "INSERT INTO grades (student_id,course_id,grade) VALUES (?,?,?)";
			Database::$db->prepare($sql)->execute([$student_id,$course_id,$grade]);
		}
		
		public function delete() {
			$sql = "DELETE FROM grades WHERE id = $this->id;";
			Database::$db->query($sql);
		}

		public function save() {
			$sql = "UPDATE grades SET student_id = ?, course_id = ?, grade = ? WHERE id = ?;";
			Database::$db->prepare($sql)->execute([$this->student_id, $this->course_id, $this->grade, $this->id]);
		}

		public static function all($keyword) {
			/*
			My format is:
			ID
			{Course Name} - {study_year}
			{Student Name} - {ID}
			{Grade of student}/{Max. Grade}
			*/
			$keyword = str_replace(" ", "%", $keyword);
			$sql = "
			SELECT
			grades.id		AS id,
			courses.name	AS course_name,
			courses.study_year	AS course_study_year,
			students.name	AS student_name,
			students.id		AS student_id,
			grades.grade	AS grade,
			courses.max_grade	AS course_max_grade
			
			FROM grades
			
			JOIN students
			ON students.id = grades.student_id
			
			JOIN courses
			ON courses.id = grades.course_id
			
			WHERE
			
			(courses.name LIKE ('%$keyword%') OR students.name LIKE ('%$keyword%'))
			;";
			$statement = Database::$db->prepare($sql);
			$statement->execute();
			return $statement->fetchAll(PDO::FETCH_OBJ);
		}
	}
?>