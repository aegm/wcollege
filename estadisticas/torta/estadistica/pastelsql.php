<?php  session_start();


include ("jpgraph/src/jpgraph.php"); 
include ("jpgraph/src/jpgraph_pie.php"); 
include ("jpgraph/src/jpgraph_pie3d.php"); 



$data = array($_SESSION['intPct'],$_SESSION['n']); 

$graph = new PieGraph(450,450,"auto"); 
$graph->img->SetAntiAliasing(); 
$graph->SetMarginColor('white'); 
//$graph->SetShadow(); 

// Setup margin and titles 
$graph->title->Set("Porcentaje"); 

$p1 = new PiePlot3D($data); 
$p1->SetSize(0.35); 
$p1->SetCenter(0.5); 

// Setup slice labels and move them into the plot 
$p1->value->SetFont(FF_FONT1,FS_BOLD); 
$p1->value->SetColor("black"); 
$p1->SetLabelPos(0.2); 

$nombres=array("Progreso Culminado","Progreso Faltante"); 
$p1->SetLegends($nombres); 

// Explode all slices 
$p1->ExplodeAll(); 

$graph->Add($p1); 
$graph->Stroke(); 

?>