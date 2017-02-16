<?php
    require_once("config/db/session.php");
    $page_title = "AIINV - Usuarios";
    require_once("config/page/header.php"); 
    $result = mysql_query("SELECT * FROM `Usuario`") or trigger_error(mysql_error()); 
?>
    <a id="add-maintance" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" href="agregarUsuario.php">
        <i class="material-icons" style="color: white;">add</i>
    </a>
    <div class="mdl-tooltip" data-mdl-for="add-maintance">
        Agregar Usuario
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="panel panel-default">
                <!--<div class="panel-heading">
                    <h4>
                        Listado de Usuarios
                    </h4>
                </div>-->
                <table class="table table-fixed">
                    <thead>
                        <tr>
                            <th class="col-xs-2">#</th>
                            <th class="col-xs-8">Name</th>
                            <th class="col-xs-2">Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr onclick="window.location='agregarUsuario.php'">
                            <td class="col-xs-2">1</td>
                            <td class="col-xs-8">Mike Adams</td>
                            <td class="col-xs-2">23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">2</td>
                            <td class="col-xs-8">Holly Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">3</td>
                            <td class="col-xs-8">Mary Shea</td>
                            <td class="col-xs-2">86</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">4</td>
                            <td class="col-xs-8">Jim Adams</td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">5</td>
                            <td class="col-xs-8">Henry Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">6</td>
                            <td class="col-xs-8">Bob Shea</td>
                            <td class="col-xs-2">26</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">7</td>
                            <td class="col-xs-8">Andy Parks</td>
                            <td class="col-xs-2">56</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">8</td>
                            <td class="col-xs-8">Bob Skelly</td>
                            <td class="col-xs-2">96</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">9</td>
                            <td class="col-xs-8">William Defoe</td>
                            <td class="col-xs-2">13</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">10</td>
                            <td class="col-xs-8">Will Tripp</td>
                            <td class="col-xs-2">16</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">11</td>
                            <td class="col-xs-8">Bill Champion</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">12</td>
                            <td class="col-xs-8">Lastly Jane</td>
                            <td class="col-xs-2">6</td>
                        </tr>
                        <tr onclick="window.location='agregarUsuario.php'">
                            <td class="col-xs-2">1</td>
                            <td class="col-xs-8">Mike Adams</td>
                            <td class="col-xs-2">23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">2</td>
                            <td class="col-xs-8">Holly Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">3</td>
                            <td class="col-xs-8">Mary Shea</td>
                            <td class="col-xs-2">86</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">4</td>
                            <td class="col-xs-8">Jim Adams</td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">5</td>
                            <td class="col-xs-8">Henry Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">6</td>
                            <td class="col-xs-8">Bob Shea</td>
                            <td class="col-xs-2">26</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">7</td>
                            <td class="col-xs-8">Andy Parks</td>
                            <td class="col-xs-2">56</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">8</td>
                            <td class="col-xs-8">Bob Skelly</td>
                            <td class="col-xs-2">96</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">9</td>
                            <td class="col-xs-8">William Defoe</td>
                            <td class="col-xs-2">13</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">10</td>
                            <td class="col-xs-8">Will Tripp</td>
                            <td class="col-xs-2">16</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">11</td>
                            <td class="col-xs-8">Bill Champion</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">12</td>
                            <td class="col-xs-8">Lastly Jane</td>
                            <td class="col-xs-2">6</td>
                        </tr>
                        <tr onclick="window.location='agregarUsuario.php'">
                            <td class="col-xs-2">1</td>
                            <td class="col-xs-8">Mike Adams</td>
                            <td class="col-xs-2">23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">2</td>
                            <td class="col-xs-8">Holly Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">3</td>
                            <td class="col-xs-8">Mary Shea</td>
                            <td class="col-xs-2">86</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">4</td>
                            <td class="col-xs-8">Jim Adams</td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">5</td>
                            <td class="col-xs-8">Henry Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">6</td>
                            <td class="col-xs-8">Bob Shea</td>
                            <td class="col-xs-2">26</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">7</td>
                            <td class="col-xs-8">Andy Parks</td>
                            <td class="col-xs-2">56</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">8</td>
                            <td class="col-xs-8">Bob Skelly</td>
                            <td class="col-xs-2">96</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">9</td>
                            <td class="col-xs-8">William Defoe</td>
                            <td class="col-xs-2">13</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">10</td>
                            <td class="col-xs-8">Will Tripp</td>
                            <td class="col-xs-2">16</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">11</td>
                            <td class="col-xs-8">Bill Champion</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">12</td>
                            <td class="col-xs-8">Lastly Jane</td>
                            <td class="col-xs-2">6</td>
                        </tr>
                        <tr onclick="window.location='agregarUsuario.php'">
                            <td class="col-xs-2">1</td>
                            <td class="col-xs-8">Mike Adams</td>
                            <td class="col-xs-2">23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">2</td>
                            <td class="col-xs-8">Holly Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">3</td>
                            <td class="col-xs-8">Mary Shea</td>
                            <td class="col-xs-2">86</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">4</td>
                            <td class="col-xs-8">Jim Adams</td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">5</td>
                            <td class="col-xs-8">Henry Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">6</td>
                            <td class="col-xs-8">Bob Shea</td>
                            <td class="col-xs-2">26</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">7</td>
                            <td class="col-xs-8">Andy Parks</td>
                            <td class="col-xs-2">56</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">8</td>
                            <td class="col-xs-8">Bob Skelly</td>
                            <td class="col-xs-2">96</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">9</td>
                            <td class="col-xs-8">William Defoe</td>
                            <td class="col-xs-2">13</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">10</td>
                            <td class="col-xs-8">Will Tripp</td>
                            <td class="col-xs-2">16</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">11</td>
                            <td class="col-xs-8">Bill Champion</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">12</td>
                            <td class="col-xs-8">Lastly Jane</td>
                            <td class="col-xs-2">6</td>
                        </tr>
                        <tr onclick="window.location='agregarUsuario.php'">
                            <td class="col-xs-2">1</td>
                            <td class="col-xs-8">Mike Adams</td>
                            <td class="col-xs-2">23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">2</td>
                            <td class="col-xs-8">Holly Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">3</td>
                            <td class="col-xs-8">Mary Shea</td>
                            <td class="col-xs-2">86</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">4</td>
                            <td class="col-xs-8">Jim Adams</td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">5</td>
                            <td class="col-xs-8">Henry Galivan</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">6</td>
                            <td class="col-xs-8">Bob Shea</td>
                            <td class="col-xs-2">26</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">7</td>
                            <td class="col-xs-8">Andy Parks</td>
                            <td class="col-xs-2">56</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">8</td>
                            <td class="col-xs-8">Bob Skelly</td>
                            <td class="col-xs-2">96</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">9</td>
                            <td class="col-xs-8">William Defoe</td>
                            <td class="col-xs-2">13</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">10</td>
                            <td class="col-xs-8">Will Tripp</td>
                            <td class="col-xs-2">16</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">11</td>
                            <td class="col-xs-8">Bill Champion</td>
                            <td class="col-xs-2">44</td>
                        </tr>
                        <tr>
                            <td class="col-xs-2">12</td>
                            <td class="col-xs-8">Lastly Jane</td>
                            <td class="col-xs-2">6</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
