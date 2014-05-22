<?php
	$n=($num_registros/$cant_pag);
	$tope=$n;
	if ($n>11)
		$n=11;
	if($pag>1)
	{  
		   $paganterior=$pag-1;?> 
	<!--acontinuacion paso las variables por get, a travez de las anclas ?para declarar, &para separar variables-->
		   <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$lugar&pag=1&filtro=$filtro";?>'> &lt;&lt; </a> &nbsp;&nbsp;
		   <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$lugar&pag=$paganterior&filtro=$filtro";?>'> < Anterior </a>&nbsp; 	
<?php } 

	$num=$pag;
	if ($pag>=6)
		$num=$num-5;
	else
		$num=1;
	for($i=1;$i<=ceil($n);$i++)//aqui se escriben todos los num de pag hasta n
	{   
		if(ceil($tope)>=$num){
			
			if($num==$pag)//acontinuacion esto es para resaltar el numero de pag seleccionado por el usuario
			  {?>
			   <a class="txt_num_pag_selec" href='inicio.php<?php echo "?lugar=$lugar&pag=$num&filtro=$filtro";?>'><?php echo $num;?></a>
		<?php }
			  else 
			  { ?> 
			   <a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$lugar&pag=$num&filtro=$filtro";?>'><?php echo $num;?></a>
		<?php }
		}
	
	$num+=1;
	} 
	if($pag<ceil($tope))
	{
		   $ultima=ceil($tope);
		   $pagsiguiente=$pag+1;?> 
		   &nbsp;<a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$lugar&pag=$pagsiguiente&filtro=$filtro";?>'> Siguiente > </a>
		   &nbsp;&nbsp;<a class="txt_num_pag" href='inicio.php<?php echo "?lugar=$lugar&pag=$ultima&filtro=$filtro";?>'> >> </a> 											  
<?php }  ?>   