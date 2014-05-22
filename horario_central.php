<?php
if(isset($_SESSION['wc']['nivel']) && ($_SESSION['wc']['nivel']=='E' ))
{
    include('perfil_central.php');
    $usr = $_SESSION['wc']['contrato'];
    $sql = $bd->consulta("select * from v_user_aula where contrato = '$usr'");
    $usuario=$bd->sig_reg($sql);
    $aula =  $usuario['aula'];
    switch ($aula){
        case '1':
            echo "<div>
                <h3>Horario de Clases Aula Virtual</h3> 
                <p>Observación: El acceso al aula para colombia es a las 8:30 Hr.</p>
                 <br>
                 <table class='table'>
                    <thead>
                        <tr>
                            <th>Horas</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miercoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Sabados</th>
                            <th>Clase - Lecciones</th>
                        </tr>
                        <tr>
                            <td>09:00 - 10:00</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>1 - (1)</td>
                        </tr>
                        <tr>
                            <td>10:00 - 11:00</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>1</td>
                            <td>2 - (2,3,4)</td>
                        </tr>
                        <tr>
                            <td>11:00 - 12:00</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3 - (5,6,7)</td>
                        </tr>
                        <tr>
                            <td>01:00 - 02:00</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4 - (8,9,10)</td>
                        </tr>
                        <tr>
                            <td>02:00 - 03:00</td>
                            <td>5</td>
                            <td>6</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5 - (11,12,13)</td>
                        </tr>
                        <tr>
                            <td>03:00 - 04:00</td>
                            <td>6</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6 - (14,15,16)</td>
                        </tr>
                        <tr>
                            <td>04:00 - 05:00</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td>05:00 - 06:00</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>1</td>
                        </tr>
                        <!--tr>
                            <td>06:00 - 07:00</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>6</td>
                            <td>1</td>
                            <td>2</td>
                        </tr-->
                       
                    </thead>
                </table>
            </div>";
            break;
        case '2':
            echo "<div>
                <h3>Horario de Clases Aula Virtual</h3> 
                <p>Observación: El acceso al aula para colombia es a las 8:30 Hr.</p>
                 <br>
                 <table class='table'>
                    <thead>
                        <tr>
                            <th>Horas</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miercoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Sabados</th>
                            <th>Clase - Lecciones</th>
                        </tr>
                        <tr>
                            <td>09:00 - 10:00</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>7 - (17,18,19)</td>
                        </tr>
                        <tr>
                            <td>10:00 - 11:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>8 - (20,21,22)</td>
                        </tr>
                        <tr>
                            <td>11:00 - 12:00</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>9 - (23,24,25)</td>
                        </tr>
                        <tr>
                            <td>01:00 - 02:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>02:00 - 03:00</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>03:00 - 04:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>04:00 - 05:00</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td>05:00 - 06:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <!--tr>
                            <td>06:00 - 07:00</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                            <td>7</td>
                            <td>8</td>
                            <td>9</td>
                        </tr-->
                    </thead>
                </table>
            </div>    
        ";
            break;
        case '3':
           echo "<div>
                <h3>Horario de Clases Aula Virtual</h3> 
                <p>Observación: El acceso al aula para colombia es a las 8:30 Hr.</p>
                 <br>
                 <table class='table'>
                    <thead>
                        <tr>
                            <th>Horas</th>
                            <th>Lunes</th>
                            <th>Martes</th>
                            <th>Miercoles</th>
                            <th>Jueves</th>
                            <th>Viernes</th>
                            <th>Sabados</th>
                            <th>Clase - Lecciones</th>
                        </tr>
                        <tr>
                            <td>09:00 - 10:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>1 </td>
                            <td>1 - (1)</td>
                        </tr>
                        <tr>
                            <td>10:00 - 11:00</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>2</td>
                            <td>2 - (2,3,4)</td>
                        </tr>
                        <tr>
                            <td>11:00 - 12:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>3</td>
                            <td>3 - (5,6,7)</td>
                        </tr>
                        <tr>
                            <td>01:00 - 02:00</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td>4</td>
                            <td>4 - (8,9,10)</td>
                        </tr>
                        <tr>
                            <td>02:00 - 03:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td>5</td>
                            <td>5 - (11,12,13)</td>
                        </tr>
                        <tr>
                            <td>03:00 - 04:00</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td> </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>04:00 - 05:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <tr>
                            <td>05:00 - 06:00</td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                            <td> </td>
                        </tr>
                        <!--tr>
                            <td>06:00 - 07:00</td>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                            <td>4</td>
                            <td>5</td>
                            <td></td>
                        </tr-->
                       
                    </thead>
                </table>
            </div>";
        break;
    }
    
?>
<!--div style="margin: 0 auto; float: right;">
    <p>Observación: El acceso al aula para colombia es a las 8:30 Hr.</p>
<h3>Horario de Clases Primera Semana  </h3>
<img src="images/horario.png" width="700" height="400px"/>
<br>
<h3>Segunda Semana</h3>
<img src="images/horario_dos.png" width="700" height="400px"/>

</div-->
<?php
}
?>