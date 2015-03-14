<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/TaskData.php";
include "core/modules/blog/model/TagData.php";
include "core/modules/blog/model/TaskTagData.php";

$project_id = $_POST["project_id"];
$tags_str = $_POST["tags"];
$tags = explode(",", trim($tags_str));
$tp = null;


//print_r($tags);

$project = TaskData::getById($_POST["task_id"]);
$project->name = $_POST["name"];
$project->description = $_POST["description"];
$project->start_at = $_POST["start_at"];
$project->finish_at = $_POST["finish_at"];

$project->priority_id = $_POST["priority_id"];
$project->update();

$task_id = $_POST["task_id"];
/// procesando etiquetas
foreach ($tags as $tag) {
$tp = TagData::existTP($tag,$project_id);
	if($tp==null){
		$t = new TagData();
		$t->name = $tag;
		$t->project_id = $project->project_id;
		$t->add();
		$tp = TagData::existTP($tag,$project->project_id);
	}

	if($tp!=null){
		$tdx = TaskTagData::getByTT($task_id,$tp->id);
		if($tdx==null){
			$td = new TaskTagData();
			$td->tag_id = $tp->id;
			$td->task_id = $task_id;
			$td->add();
		}
	}

}



// print_r($_GET);



?>