<?php
session_start();

include "core/controller/Database.php";
include "core/controller/Executor.php";
include "core/controller/Session.php";

include "core/modules/blog/model/ProjectData.php";
include "core/modules/blog/model/PriorityData.php";
include "core/modules/blog/model/TaskData.php";

$tasks_news = TaskData::countNews();
$tasks_news_finalizeds = TaskData::countNewsFinalizeds();

?>
<h1>Escritorio</h1>





<div class="panel panel-default">
<div class="panel-heading">Ultimos 30 dias</div>
<div class="panel-body">
	
	<div id="graph" class="animate" data-animate="fadeInUp"></div>

<script>
<?php 
echo "var c=0;";
echo "var dates=Array();";
echo "var data=Array();";
echo "var total=Array();";
for($i=0;$i<30;$i++){
  echo "dates[c]=\"".date("Y-m-d",time()-60*60*24*$i)."\";";
  echo "data[c]=\"".TaskData::countFinishedFromDay(date("Y-m-d",time()-60*60*24*$i))."\";";
  echo "total[c]={x: dates[c],y: data[c]};";
  echo "c++;";
}
?>
// Use Morris.Area instead of Morris.Line
Morris.Area({
  element: 'graph',
  data: total,
  xkey: 'x',
  ykeys: ['y',],
  labels: ['Y']
}).on('click', function(i, row){
  console.log(i, row);
});

</script>
</div>
</div>

		</div>










<table class="table table-bordered">
<tr>
<td>
<center>
<h4>Tareas finalizadas hoy</h4>
<h2><?php echo $tasks_news_finalizeds->c; ?></h2>
</center>
</td>
<td>
<center>
<h4>Tareas creadas hoy</h4>
<h2><?php echo $tasks_news->c; ?></h2>
</center>

</td>
</tr>
</table>

