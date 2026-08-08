<?php

$crud_fetch_student = "SELECT * FROM students;";
$crud_make_student = "INSERT INTO students (name, family, studentCode) VALUES (:name, :family, :studentCode)";
$crud_delete_student = "DELETE FROM students WHERE id = :id";
$crud_update_student = "UPDATE students SET name = :name, family = :family, studentCode = :studentCode WHERE id = :id";
