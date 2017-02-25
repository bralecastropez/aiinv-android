</div>
</main>
</div>


<!-- SCRIPTS -->

<!-- MDL -->
<script type="text/javascript" src="css/mdl/material.min.js"></script>

<!-- JQuery -->
<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="js/tether.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!-- MDB core JavaScript -->
<script type="text/javascript" src="js/mdb.min.js"></script>


<?php if (isset($page_maintance)): ?>
<?php if (is_bool($page_maintance) === true): ?>
<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/bootstrap-material-datetimepicker.js"></script>
<script type="text/javascript" src="js/jquery.mask.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#FechaNacimiento').bootstrapMaterialDatePicker({
            format: 'YYYY-MM-DD h:mm:ss',
            time: false,
            clearButton: true
        });
        /*$material.init()*/
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.fecha').mask('0000/00/00 00:00:00');
        $(".dpi").mask("0000 00000 0000");
        $(".nit").mask("0000000-A");
        $(".telefono").mask("0000-0000");
        $('.creditodecimal').mask("##0", {
            reverse: true
        });
        $('.credito').mask("#,##0,000", {
            reverse: true
        });
    });

</script>
<script defer src="css/mdl-select/getmdl-select.min.js"></script>
<?php endif; ?>
<?php endif; ?>

</body>

</html>
