<?php
    require_once("config/db/session.php");
    $page_title = "Agregar Prestamo";
    $page_maintance = true;
    require_once("config/page/header.php");

    $idpre = mysql_fetch_array(mysql_query("select (max(IdPrestamo) + 1) as 'idpre' from prestamo"))['idpre']; 
    
    if ($idpre < 9) {
        $CodigoPrestamo = "PRE00000" . $idpre;
    } else {
        if ($idpre > 100) {
            if ($idpre > 1000) {
                $CodigoPrestamo = "PRE00" . $idpre;
            } else {
                $CodigoPrestamo = "PRE000" . $idpre;
            }
        } else {
            $CodigoPrestamo = "PRE0000" . $idpre;
        }
    }
    
    if (isset($_POST['submitted'])) { 
        foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
        $sql = "INSERT INTO `prestamo` ( `IdUsuario` ,  `IdCliente` ,  `CodigoPrestamo` ,  `FechaDesembolso` ,  `FechaCorte` ,  `Mora` ,  `PeriodoPago` ,  `InteresMensual` ,  `Plazo` ,  `Detalle` ,  `Estado` ,  `MontoPagado` ,  `MontoParcial` ,  `MontoPendiente` ,    `CuotaDiaria` ,  `CuotaSemanal` ,  `CuotaBisemanal` ,  `CuotaMensual` ,  `CuotasPagadas` ,  `CuotasRestantes`  ) VALUES(  '{$_POST['IdUsuario']}' ,  '{$_POST['IdCliente']}' ,  '{$_POST['CodigoPrestamo']}' ,  '{$_POST['FechaDesembolso']}' ,  '{$_POST['FechaCorte']}' ,  '{$_POST['Mora']}' ,  '{$_POST['PeriodoPago']}' ,  '{$_POST['InteresMensual']}' ,  '{$_POST['Plazo']}' ,  '{$_POST['Detalle']}' ,  '{$_POST['Estado']}' ,  '{$_POST['MontoPagado']}' ,  '{$_POST['MontoParcial']}' ,  '{$_POST['MontoPendiente']}' ,  '{$_POST['CuotaDiaria']}' ,  '{$_POST['CuotaSemanal']}' ,  '{$_POST['CuotaBisemanal']}' ,  '{$_POST['CuotaMensual']}' ,  '{$_POST['CuotasPagadas']}' ,  '{$_POST['CuotasRestantes']}'  ) "; 
        mysql_query($sql) or die(mysql_error()); 
        echo "Added row.<br />"; 
        echo "<a href='listarPrestamos.php'>Back To Listing</a>"; 
    } 
?>


    <style type="text/css">
        .vSeparator {
            border-left: 1px dotted #000000;
            margin-left: 10px;
            padding-left: 10px;
        }

    </style>

    <div class="Container100">
        <div class="ContainerIndent">
            <br/>
            <form method="post" action="" data-toggle="validator" role="form">
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <div class="Container100">
                            <div class="ContainerIndent TextAlCenter">
                                <h5>Datos del Referente</h5>
                            </div>
                            <hr/>
                        </div>
                        <div>
                            <p><b>Ingrese un C&oacute;digo de Prestamo: </b></p>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input" type="text" name="CodigoPrestamo" id="CodigoPrestamo" placeholder="C&oacute;digo del Prestamo" value="<?php echo $CodigoPrestamo; ?>" />
                                <label class="mdl-textfield__label" for="CodigoPrestamo">C&oacute;digo del Prestamo</label>
                                <span class="mdl-textfield__error">Debe ingresar un c&oacute;digo v&aacute;lido</span>
                            </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese un T&iacute;tulo: </b></p>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input" type="text" maxlength="40" required pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Titulo" id="Titulo" />
                                <label class="mdl-textfield__label" for="Titulo">T&iacute;tulo</label>
                                <span class="mdl-textfield__error">Debe ingresar un t&iacute;tulo v&aacute;lido</span>
                            </div>
                        </div><br/>
                        <div>
                            <p><b>Ingrese un detalle del Prestamo: </b></p>
                            <div class="mdl-textfield mdl-js-textfield">
                                <input class="mdl-textfield__input" type="text" maxlength="40" required pattern="^[A-Za-z\s]{1,}[\.]{0,1}[A-Za-z\s]{0,}$" name="Detalle" id="Detalle" />
                                <label class="mdl-textfield__label" for="Detalle">Detalle</label>
                                <span class="mdl-textfield__error">Debe ingresar un detalle v&aacute;lido</span>
                            </div>
                        </div><br/>
                    </div>
                </div>
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <div class="Container100">
                            <div class="ContainerIndent TextAlCenter">
                                <h5>Datos del Referente</h5>
                            </div>
                            <hr/>
                        </div>
                        <div>
                            <p><b>Seleccione un Estado:</b></p>
                            <div class="mdl-selectfield mdl-js-selectfield mdl-selectfield--floating-label">
                                <select id="Estado" name="Estado" class="mdl-selectfield__select" required>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                                <label class="mdl-textfield__label" for="Estado">Estado</label>
                            </div>
                        </div><br/>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <form action='' method='POST'>
        <input type="text" name="cantidad1" id="cantidad1" onkeyup="cambio1(this.value)" />
        <input type="text" name="cantidad2" id="cantidad2" onkeyup="cambio2(this.value)" />

        <input type="text" value="<?php echo $CodigoPrestamo; ?>" />
        <h6>Resultado:
            <p name="result" id="result"></p>
        </h6>

        <!--<p><b>IdUsuario:</b><br /><input type='text' name='IdUsuario' /></p>
<p><b>IdCliente:</b><br /><input type='text' name='IdCliente' /></p>
<p><b>CodigoPrestamo:</b><br /><input type='text' name='CodigoPrestamo' /></p>
<p><b>FechaDesembolso:</b><br /><input type='text' name='FechaDesembolso' /></p>
<p><b>FechaCorte:</b><br /><input type='text' name='FechaCorte' /></p>
<p><b>Mora:</b><br /><input type='text' name='Mora' /></p>
<p><b>PeriodoPago:</b><br /><input type='text' name='PeriodoPago' /></p>
<p><b>InteresMensual:</b><br /><input type='text' name='InteresMensual' /></p>
<p><b>Plazo:</b><br /><input type='text' name='Plazo' /></p>
<p><b>Detalle:</b><br /><textarea name='Detalle'></textarea></p>
<p><b>Estado:</b><br /><input type='text' name='Estado' /></p>
<p><b>MontoPagado:</b><br /><input type='text' name='MontoPagado' /></p>
<p><b>MontoParcial:</b><br /><input type='text' name='MontoParcial' /></p>
<p><b>MontoPendiente:</b><br /><input type='text' name='MontoPendiente' /></p>
<p><b>CuotaDiaria:</b><br /><input type='text' name='CuotaDiaria' /></p>
<p><b>CuotaSemanal:</b><br /><input type='text' name='CuotaSemanal' /></p>
<p><b>CuotaBisemanal:</b><br /><input type='text' name='CuotaBisemanal' /></p>
<p><b>CuotaMensual:</b><br /><input type='text' name='CuotaMensual' /></p>
<p><b>CuotasPagadas:</b><br /><input type='text' name='CuotasPagadas' /></p>
<p><b>CuotasRestantes:</b><br /><input type='text' name='CuotasRestantes' /></p>
<p><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted' /></p>-->

    </form>



    <?php require_once("config/page/footer.php"); ?>

    <script type="text/javascript">
        var cambio1 = function(val) {
            var value = $("#cantidad2").val();
            $("#result").text((val / 18));
        };
        var cambio2 = function(val) {
            var value = $("#cantidad1").val();
            $("#result").text((val * value));
        };

    </script>
