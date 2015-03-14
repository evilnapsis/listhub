<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/ProjectData.php";

$projects = ProjectData::getAll();
if(!isset($_SESSION["last_selected"])){
$last = ProjectData::getLast();
}else{
	$last = ProjectData::getById($_SESSION["last_selected"]);
}


// print_r($last);
if(count($projects)>0){
//echo "<ul type='none'>";
echo "<div class='list-group'>";
foreach ($projects as $project) {
 echo "<a id='loadproject-".$project->id."' href='#' class='list-group-item'>".$project->name."</a>";
$project_id = $project->id;
echo <<<SSS
<script>
$("#loadproject-$project_id").click(function(e){
	e.preventDefault();
	// alert($project_id);
	$.post("loadproject.php","id=$project_id", function(data){
		//console.log(data);
		$("div#task-container").html(data);
	});
});
</script>
SSS;
}
//echo "</ul>";
echo "</div>";
}
// print_r($_GET);



?>
<script>
	$.post("loadproject.php","id=<?php echo $last->id; ?>", function(data){
		//console.log(data);
		$("div#task-container").html(data);
	});
</script>