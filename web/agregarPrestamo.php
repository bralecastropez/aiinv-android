<?php
    require_once("config/db/session.php");
    require_once("config/db/handler.php");
    $page_title = "Agregar Prestamo";
    $page_maintance = true;
    require_once("config/page/header.php");

    if(isset($_GET['IdCliente'])) {
        $IdCliente = $_GET['IdCliente'];
    }

    $idpre = mysql_fetch_array(mysql_query("select (max(IdPrestamo) + 1) as 'idpre' from prestamo"))['idpre'];
    $sql_cli = "select * from cliente where idcliente = " . $IdCliente . " ";
    $Cliente = mysql_fetch_array(mysql_query($sql_cli));
    
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
    <br/>
    <br/>
    <section class="mdl-stepper-demo Wid100">
        <div align="center">
            <ul class="mdl-stepper mdl-stepper--feedback mdl-stepper--horizontal" id="demo-stepper-horizontal-linear-feedback">
                <li class="mdl-step">
                    <span class="mdl-step__label">
              <span class="mdl-step__title">
                <span class="mdl-step__title-text">Prestamista</span>
                    </span>
                    </span>
                    <div class="mdl-step__content">

                    </div>
                    <div class="mdl-step__actions mdl-card--border">
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored" data-stepper-next>
                            Continuar
                        </button>
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-cancel>
                            Cancelar
                        </button>
                    </div>
                </li>
                <li class="mdl-step">
                    <span class="mdl-step__label">
                        <span class="mdl-step__title">
                            <span class="mdl-step__title-text">Prestamo/Plazo</span>
                    </span>
                    </span>
                    <div class="mdl-step__content">
                        <div class="Container100">
                            <div class="Container50 MaintanceResponsive">
                                <div class="ContainerIndent">
                                    <div>
                                        <p><b>Seleccione un Estado:</b></p>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth">
                                            <input class="mdl-textfield__input" type="text" id="Estado" min="6" value="Activo" required readonly tabIndex="-1" />
                                            <ul for="Estado" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                                <li class="mdl-menu__item">Activo</li>
                                                <li class="mdl-menu__item">Inactivo</li>
                                            </ul>
                                            <span class="mdl-textfield__error">Seleccione un estado</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p><b>Seleccione la Fecha de Desembolso:</b></p>
                                        <div class="mdl-textfield mdl-js-textfield">
                                            <input type="text" id="FechaDesembolso" required name="FechaDesembolso" class="mdl-textfield__input" />
                                            <!--                                        <label class="mdl-textfield__label" for="FechaDesembolso">Fecha de Desembolso</label>
                                        <span class="mdl-textfield__error">Debe seleccionar una fecha v&aacute;lida</span>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Container50 MaintanceResponsive">
                                <div class="ContainerIndent">
                                    <div>
                                        <p><b>Seleccione el Impuesto por Retraso (Mora):</b></p>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth">
                                            <input class="mdl-textfield__input" type="text" id="Mora" min="6" value="1% x Dia" required readonly tabIndex="-1" />
                                            <ul for="Mora" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                                <li class="mdl-menu__item">1% x Dia</li>
                                                <li class="mdl-menu__item">3% x Dia</li>
                                                <li class="mdl-menu__item">10% x Semana</li>
                                                <li class="mdl-menu__item">12% x Semana</li>
                                                <li class="mdl-menu__item">15% x Semana</li>
                                                <li class="mdl-menu__item">10% x Mes</li>
                                                <li class="mdl-menu__item">12% x Mes</li>
                                                <li class="mdl-menu__item">15% x Mes</li>
                                            </ul>
                                            <span class="mdl-textfield__error">Seleccione un estado</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p><b>Fecha de Corte:</b></p>
                                        <div class="mdl-textfield mdl-js-textfield">
                                            <input type="text" id="FechaDesembolso" disabled readonly name="FechaDesembolso" class="mdl-textfield__input" />
                                            <!--                                        <label class="mdl-textfield__label" for="FechaDesembolso">Fecha de Desembolso</label>
                                        <span class="mdl-textfield__error">Debe seleccionar una fecha v&aacute;lida</span>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Container100 Fleft">
                                <div class="ContainerIndent">
                                    <div>
                                        <p><b>Seleccione el Tipo de Pagos:</b></p><br/>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
  <input type="radio" id="option-1" class="mdl-radio__button" name="options" value="1" checked>
  <span class="mdl-radio__label">Generar Pagos Automaticamente (Recomendado)</span>
</label>
                                        <br/>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
  <input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2">
  <span class="mdl-radio__label">No Generar Pagos</span>
</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mdl-step__actions">
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored" data-stepper-next>
                            Continuar
                        </button>
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-cancel>
                            Cancelar
                        </button>
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-back>
                            Regresar
                        </button>
                    </div>
                </li>
                <li class="mdl-step">
                    <span class="mdl-step__label">
                        <span class="mdl-step__title">
                            <span class="mdl-step__title-text">Agregar Prestamo</span>
                    </span>
                    </span>
                    <div class="mdl-step__content">

                    </div>
                    <div class="mdl-step__actions">
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored" data-stepper-next>
                            Continuar
                        </button>
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-cancel>
                            Cancelar
                        </button>
                        <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-back>
                            Regresar
                        </button>
                    </div>
                </li>
            </ul>
        </div>
    </section>
    <br/>
    <br/>
    <div class="Container100">
        <div class="ContainerIndent">
            <br/>
            <form method="post" action="" data-toggle="validator" role="form">
                <div class="Container50 MaintanceResponsive">
                    <div class="ContainerIndent">
                        <div class="Container100">
                            <div class="ContainerIndent TextAlCenter">
                                <h5>Datos del Prestamista</h5>
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
                                <h5>Datos del Prestamo</h5>
                            </div>
                            <hr/>
                        </div>
                        <div class="Container100">
                            <div class="Container50 MaintanceResponsive">
                                <div class="ContainerIndent">
                                    <div>
                                        <p><b>Seleccione un Estado:</b></p>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth">
                                            <input class="mdl-textfield__input" type="text" id="Estado" min="6" value="Activo" required readonly tabIndex="-1" />
                                            <ul for="Estado" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                                <li class="mdl-menu__item">Activo</li>
                                                <li class="mdl-menu__item">Inactivo</li>
                                            </ul>
                                            <span class="mdl-textfield__error">Seleccione un estado</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p><b>Seleccione la Fecha de Desembolso:</b></p>
                                        <div class="mdl-textfield mdl-js-textfield">
                                            <input type="text" id="FechaDesembolso" required name="FechaDesembolso" class="mdl-textfield__input" />
                                            <!--                                        <label class="mdl-textfield__label" for="FechaDesembolso">Fecha de Desembolso</label>
                                        <span class="mdl-textfield__error">Debe seleccionar una fecha v&aacute;lida</span>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Container50 MaintanceResponsive">
                                <div class="ContainerIndent">
                                    <div>
                                        <p><b>Seleccione el Impuesto por Retraso (Mora):</b></p>
                                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth">
                                            <input class="mdl-textfield__input" type="text" id="Mora" min="6" value="1% x Dia" required readonly tabIndex="-1" />
                                            <ul for="Mora" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                                <li class="mdl-menu__item">1% x Dia</li>
                                                <li class="mdl-menu__item">3% x Dia</li>
                                                <li class="mdl-menu__item">10% x Semana</li>
                                                <li class="mdl-menu__item">12% x Semana</li>
                                                <li class="mdl-menu__item">15% x Semana</li>
                                                <li class="mdl-menu__item">10% x Mes</li>
                                                <li class="mdl-menu__item">12% x Mes</li>
                                                <li class="mdl-menu__item">15% x Mes</li>
                                            </ul>
                                            <span class="mdl-textfield__error">Seleccione un estado</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p><b>Fecha de Corte:</b></p>
                                        <div class="mdl-textfield mdl-js-textfield">
                                            <input type="text" id="FechaDesembolso" disabled readonly name="FechaDesembolso" class="mdl-textfield__input" />
                                            <!--                                        <label class="mdl-textfield__label" for="FechaDesembolso">Fecha de Desembolso</label>
                                        <span class="mdl-textfield__error">Debe seleccionar una fecha v&aacute;lida</span>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="Container100">
                                <div class="ContainerIndent">

                                    <div>
                                        <p><b>Seleccione el Tipo de Pagos:</b></p>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
  <input type="radio" id="option-1" class="mdl-radio__button" name="options" value="1" checked>
  <span class="mdl-radio__label">Generar Pagos Automaticamente (Recomendado)</span>
</label>
                                        <br/>
                                        <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
  <input type="radio" id="option-2" class="mdl-radio__button" name="options" value="2">
  <span class="mdl-radio__label">No Generar Pagos</span>
</label>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Container100">
                    <div class="ContainerIndent">
                        <div class="Container100">
                            <div class="ContainerIndent TextAlCenter">
                                <h5>Monto/Plazo/Inter&eacute;s</h5>
                            </div>
                            <hr/>
                        </div>
                        <div class="Container100">
                            <div class="Container50">
                                <div class="Container50">
                                    <div class="ContainerIndent">
                                        <p><b>Seleccione el Plazo: </b></p>
                                        <div class="input-group">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth">
                                                <input class="mdl-textfield__input" onkeyup="actualizarPrestamoPlazo(this.value); visualizar();" type="text" id="Plazo" min="6" value="6" required readonly tabIndex="-1" />
                                                <ul for="Plazo" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                                    <li class="mdl-menu__item">3</li>
                                                    <li class="mdl-menu__item">6</li>
                                                    <li class="mdl-menu__item">12</li>
                                                    <li class="mdl-menu__item">18</li>
                                                    <li class="mdl-menu__item">24</li>
                                                    <li class="mdl-menu__item">36</li>
                                                    <li class="mdl-menu__item">48</li>
                                                </ul>
                                                <span class="mdl-textfield__error">Seleccione un estado v&aacute;lido</span>
                                            </div>
                                            <span class="input-group-addon">Meses</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="Container50">
                                    <div class="ContainerIndent">
                                        <p><b>Seleccione el Inter&eacute;s: </b></p>
                                        <div class="input-group">
                                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select getmdl-select__fullwidth">
                                                <input class="mdl-textfield__input" type="text" id="Interes" onclick="actualizarPrestamoInteres(this.value); visualizar();" onkeyup="actualizarPrestamoInteres(this.value); visualizar();" min="6" value="12" required readonly tabIndex="-1" />
                                                <ul for="Interes" class="mdl-menu mdl-menu--bottom-left mdl-js-menu">
                                                    <li class="mdl-menu__item ">10</li>
                                                    <li class="mdl-menu__item ">12</li>
                                                    <li class="mdl-menu__item ">14</li>
                                                    <li class="mdl-menu__item ">16</li>
                                                    <li class="mdl-menu__item ">18</li>
                                                </ul>
                                                <span class="mdl-textfield__error">Seleccione un inter&eacute;s v&aacute;lido</span>
                                            </div>
                                            <span class="input-group-addon">%</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="Container100">
                                    <div>
                                        <p><b>Ingrese un Monto: </b></p>
                                        <p>Monto M&aacute;ximo Permitido: (<b>Q. <?php echo $Cliente['LimiteCredito']; ?></b>)</p>
                                        <div class="input-group">
                                            <span class="input-group-addon">Q</span>
                                            <div class="mdl-textfield mdl-js-textfield">
                                                <input class="monto mdl-textfield__input creditodecimal" type="text" name="Monto" id="Monto" required onkeyup="actualizarPrestamoMonto(this.value); visualizar();" />
                                                <span class="mdl-textfield__error">Debe ingresar un monto v&aacute;lido</span>
                                            </div>
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                    </div>
                                    <br/>
                                    <br/>
                                </div>
                            </div>
                            <div class="Container50">
                                <div class="ContainerIndent">
                                    <div class="mdl-card__supporting-text">
                                        <div class="col-md-12">
                                            <div>
                                                <button type="button" onclick="actualizarPrestamo();" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">
                                                  Actualizar
                                                </button>
                                                <hr/>
                                            </div>
                                            <div>
                                                <h6>
                                                    <b>Cuota Diaria:  Q. <b id="Diaria"></b></b>
                                                </h6>
                                            </div>
                                            <div>
                                                <h6>
                                                    <b>Cuota Semanal:  Q. <b id="Semanal"></b></b>
                                                </h6>
                                            </div>
                                            <div>
                                                <h6>
                                                    <b>Cuota Quincenal:  Q. <b id="Quincenal"></b></b>
                                                </h6>
                                            </div>
                                            <div>
                                                <h6>
                                                    <b>Cuota Mensual:  Q. <b id="Mensual"></b></b>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Container100 ">
                    <hr/>
                    <div class="ContainerIndent ">
                        <div>
                            <button type="button" class="mdl-button mdl-js-button mdl-button--accent " onclick="regresar() ">
                                Cancelar
                            </button>
                            <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent " type='submit' style="color: white; ">
                                Agregar
                            </button>
                            <input type='hidden' value='1' name='submitteded' />
                        </div><br/>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require_once("config/page/footer.php"); ?>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#FechaDesembolso').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD h:mm:ss',
                time: false,
                clearButton: true
            });
            $('#FechaCorte').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD h:mm:ss',
                time: false,
                clearButton: true
            });
            $('#Monto').mask('##0', {
                reverse: true
            });
        });

    </script>
    <script type="text/javascript">
        var actualizarPrestamoMonto = function(Monto) {
            var Interes = ($("#Interes").val() / 100) + 1;
            var MontoAPagar = Monto * Interes;
            var Plazo = $("#Plazo").val();
            var CuotaMensual = MontoAPagar / Plazo;
            var CuotaQuincenal = CuotaMensual / 2;
            var CuotaSemanal = CuotaQuincenal / 2;
            var CuotaDiaria = CuotaSemanal / 7;
            $("#Mensual").text(CuotaMensual);
            $("#Quincenal").text(CuotaQuincenal);
            $("#Semanal").text(CuotaSemanal);
            $("#Diaria").text(CuotaDiaria);
        };

        var actualizarPrestamoPlazo = function(Plazo) {
            var Interes = ($("#Interes").val() / 100) + 1;
            var Monto = $("#Monto").val();
            var MontoAPagar = Monto * Interes;
            var CuotaMensual = MontoAPagar / Plazo;
            var CuotaQuincenal = CuotaMensual / 2;
            var CuotaSemanal = CuotaQuincenal / 2;
            var CuotaDiaria = CuotaSemanal / 7;
            $("#Mensual").text(CuotaMensual);
            $("#Quincenal").text(CuotaQuincenal);
            $("#Semanal").text(CuotaSemanal);
            $("#Diaria").text(CuotaDiaria);
        };

        var actualizarPrestamoInteres = function(Interes1) {
            var Interes = (Interes1 / 100) + 1;
            var Monto = $("#Monto").val();
            var Plazo = $("#Plazo").val();
            var MontoAPagar = Monto * Interes;
            var CuotaMensual = MontoAPagar / Plazo;
            var CuotaQuincenal = CuotaMensual / 2;
            var CuotaSemanal = CuotaQuincenal / 2;
            var CuotaDiaria = CuotaSemanal / 7;
            $("#Mensual").text(CuotaMensual);
            $("#Quincenal").text(CuotaQuincenal);
            $("#Semanal").text(CuotaSemanal);
            $("#Diaria").text(CuotaDiaria);
        };

        var actualizarPrestamo = function() {
            var Interes = ($("#Monto").val() / 100) + 1;
            var Monto = $("#Monto").val();
            var Plazo = $("#Plazo").val();
            var MontoAPagar = Monto * Interes;
            var CuotaMensual = MontoAPagar / Plazo;
            var CuotaQuincenal = CuotaMensual / 2;
            var CuotaSemanal = CuotaQuincenal / 2;
            var CuotaDiaria = CuotaSemanal / 7;
            $("#Mensual").text(CuotaMensual);
            $("#Quincenal").text(CuotaQuincenal);
            $("#Semanal").text(CuotaSemanal);
            $("#Diaria").text(CuotaDiaria);
        };

        var visualizar = function() {
            $('#Diaria').mask('##0.00');
            $('#Semanal').mask('##0.00');
            $('#Quincenal').mask('##0.00');
            $('#Mensual').mask('##0.00');
        };

    </script>
    <!-- script -->
    <script>
        (function() {
            var stepperHorizontal = function() {
                var selector = '.mdl-stepper#demo-stepper-horizontal-linear-feedback';
                var stepperElement = document.querySelector(selector);
                var Stepper;

                if (!stepperElement) return;

                Stepper = stepperElement.MaterialStepper;

                if (!Stepper) {
                    console.error('MaterialStepper instance is not available for selector: ' + selector + '.');
                    return;
                }
                stepperElement.addEventListener('onstepnext', function(event) {
                    Stepper.next();
                });
                stepperElement.addEventListener('onstepback', function(event) {
                    Stepper.back();
                });
            };

            window.addEventListener('load', stepperHorizontal)
        })();

    </script>
