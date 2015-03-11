<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/ProjectData.php";

$project = new ProjectData();
$project->name = $_POST["name"];
$project->user_id = Session::getUID();
$project->add();

// print_r($_GET);



?>