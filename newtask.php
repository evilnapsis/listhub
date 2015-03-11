<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/TaskData.php";

$project = new TaskData();
$project->name = $_POST["name"];
$project->priority_id = $_POST["priority_id"];
$project->project_id = $_POST["project_id"];
$project->add();

// print_r($_GET);



?>