<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="col-md-8" >
    <form class="">
        <fieldset>
            <legend>Seleccione las fechas a comparar</legend>
            <div class="form-group">
                
                <select class="form-control" required="required" >
                    <option>Seleccion Mes</option>
                    <option>Mayo</option>
                    <option>Junio</option>
                </select>
            </div>
            <div class="form-group">
               
                <select class="form-control" required="required">
                    <option>Seleccion Mes</option>
                    <option>Mayo</option>
                    <option>Junio</option>
                </select>
            </div>
            <div class="form-group">
                <select class="form-control" required> 
                    <option>Seleccion Año</option>
                    <option value="2014">2014</option>
                </select>
            </div>
            <div class="form-group"><button id="buscar" type="" class="btn btn-warning">Comparar</button></div>
        </fieldset>    
    </form>    
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">comparacion Ventas</h3>
            <div class="actions pull-right">
                <i class="fa fa-chevron-down"></i>
                <i class="fa fa-times"></i>
            </div>
        </div>
        <div class="panel-body text-center">
            <canvas style="width: 400px; height: 300px;" id="doughnut" height="300" width="400"></canvas>
        </div>
    </div>
</div>    

