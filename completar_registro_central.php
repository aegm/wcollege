<script type="text/javascript">
<!--
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
//-->
</script>
<!--************************************************************************************************************-->

      
                
<center><strong><p>Debe Igresar la siguiente informaci&oacute;n para poder continuar</p></strong></center>                
<div id="comp_regist">  
            
 <form  action="inicio.php" method="post">
        <div class="input_comp_regist_subtitulo"> Datos personales:</div>
        <div class="input_comp_regist"> *  Pais:&nbsp;
        <select id="pais" name="pais">
                <option value="">Seleccione</option>
                 <?php $sql = $bd->consulta("select * from pais");
                while($consulta = $bd->sig_reg($sql))
                {
                if($consulta['id_pais'] == $usuario['pais'])
                        $variable = "selected";
                else
                        $variable = "";
                ?>
                <option value="<?=$consulta['id_pais']?>"<?=$variable?>><?=$consulta['nombre']?></option>
                <?php } ?>
        </select>
        </div>
        <div class="input_comp_regist"> * Estado:&nbsp;
         <select id="estado" name="estado">
                <option value="">Seleccione</option>
              <?php $sql = $bd->consulta("select * from estados where id_pais = ".$usuario['pais']);
              while($consultas = $bd->sig_reg($sql))
              {
              if($consultas['id_estado'] == $usuario['estado'])
                      $variable = "selected";
              else
                      $variable = "";
              ?>
              <option value="<?=$consultas['id_estado']?>"<?=$variable?>><?=$consultas['nombre']?></option>
              <?php
              }   
              ?>
         </select>
        </div>
        <div class="input_comp_regist"> * Ciudad:&nbsp;
            <select id="ciudades" name="ciudades">
               <option value="">Seleccione</option>
              <?php $sql = $bd->consulta("select * from ciudades where id_estado = ".$usuario['estado']);
              while($consultas = $bd->sig_reg($sql))
              {
              if($consultas['id_ciudad'] == $usuario['ciudad'])
                      $variable = "selected";
              else
                      $variable = "";
              ?>
              <option value="<?=$consultas['id_ciudad']?>"<?=$variable?>><?=$consultas['nombre']?></option>
              <?php
              }   
              ?>
           </select>
        </div>     
        <div class="input_comp_regist"> *  Email Personal: &nbsp;<input name="Email_Personal" type="text" id="email" value="<?php echo $usuario['email'];?> "/></div>
        &nbsp;Si aqui aparece su correo actual, no lo modifique.          
        <div class="input_comp_regist">*  Telefono personal:&nbsp;<input name="Telefono_Personal" type="text" id="telefonop"/></div>	
        <!--div class="input_comp_regist_subtitulo"> Datos Referido 1:</div>
        <div class="input_comp_regist"> *  Email:&nbsp;<input name="Email_Referido_1" type="text" id="email1"/></div>   
        <div class="input_comp_regist"> *  Telefono:&nbsp;<input name="Telefono_referido_1" type="text" id="telefonor1"/></div>
        <div class="input_comp_regist_subtitulo"> Datos Referido 2:</div>
        <div class="input_comp_regist"> Email:&nbsp;<input name="email2" type="text" id="email2" /></div>
        <div class="input_comp_regist_subtitulo"> Datos Referido 3:</div>
        <div class="input_comp_regist"> Email:&nbsp;<input name="email3" type="text" id="email3" /></div-->    
        
        <div class="input_comp_regist"><input type="submit" name="registrado" value="registrado" /></div>
        
        <input type="hidden" name="aceptar" value="1" />
        <input type="hidden" name="contrato" value="<?php echo $usuario['contrato'];?>" />
        <input type="hidden" name="clave" value="<?php echo $usuario['clave'];?>" />
        <input type="hidden" name="lugar" value="<?php echo $_GET['lugar'];?>" />
        <input type="hidden" name="lecc" value="<?php echo $_GET['lecc'];?>" />
        <input type="hidden" name="libro" value="<?php echo $_GET['libro'];?>" />
        <input type="hidden" name="dir" value="<?php echo $_GET['dir'];?>" />
        <input type="hidden" name="pag" value="<?php echo $_GET['pag'];?>" />
       
 </form>
</div>
 <div style="width:400px; float:left;"><a href="javascript:hideLightbox('fade','over')">cerrar</a></div>