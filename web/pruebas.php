<?php 
        require_once("config/db/session.php");
        $page_title = "Pruebas";
        $page_maintance = true;
        require_once("config/page/header.php");
?>

<section class="mdl-stepper-demo Wid100">
    <div class="mdl-grid Wid100" align="center">
        <div class="mdl-cell Wid100">
            <!-- markup -->
            <ul class="mdl-stepper mdl-stepper--feedback mdl-stepper--horizontal" id="demo-stepper-horizontal-linear-feedback">
                <li class="mdl-step" data-step-transient-message="Step 1 looks great! Step 2 is coming up.">
                    <span class="mdl-step__label">
              <span class="mdl-step__title">
                <span class="mdl-step__title-text">Prestamista</span>
                    </span>
                    </span>
                    <div class="mdl-step__content">
                    </div>
                    <div class="mdl-step__actions">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored" data-stepper-next>
            Continuar
          </button>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-cancel>
            Cancelar
          </button>

                    </div>
                </li>
                <li class="mdl-step" data-step-transient-message="Step 2 looks great! Step 3 is coming up.">
                    <span class="mdl-step__label">
          <span class="mdl-step__title">
            <span class="mdl-step__title-text">Prestamo/Plazo</span>
                    </span>
                    </span>
                    <div class="mdl-step__content">
                        <form action="#">
                            <div class="mdl-textfield mdl-js-textfield">
                                <input autocomplete="off" class="mdl-textfield__input" type="text" id="stepper-transient-message">
                                <label class="mdl-textfield__label" for="stepper-transient-message">Transient message for current step</label>
                                <span class="mdl-textfield__error">Invalid input</span>
                            </div>
                        </form>

                    </div>
                    <div class="mdl-step__actions">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored" data-stepper-next>
            Continue
          </button>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-cancel>
            Cancel
          </button>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-back>
            Back
          </button>
                    </div>
                </li>
                <li class="mdl-step" data-step-transient-message="Step 2 looks great! Step 3 is coming up.">
                    <span class="mdl-step__label">
          <span class="mdl-step__title">
            <span class="mdl-step__title-text">Agregar Prestamo</span>
                    </span>
                    </span>
                    <div class="mdl-step__content">
                        <form action="#">
                            <div class="mdl-textfield mdl-js-textfield">
                                <input autocomplete="off" class="mdl-textfield__input" type="text" id="stepper-transient-message">
                                <label class="mdl-textfield__label" for="stepper-transient-message">Transient message for current step</label>
                                <span class="mdl-textfield__error">Invalid input</span>
                            </div>
                        </form>

                    </div>
                    <div class="mdl-step__actions">
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--colored" data-stepper-next>
            Continue
          </button>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-cancel>
            Cancel
          </button>
                        <button class="mdl-button mdl-js-button mdl-js-ripple-effect" data-stepper-back>
            Back
          </button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>



<?php 
require_once("config/page/footer.php");
?>
