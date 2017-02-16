<script type="text/javascript" src="js/moment.min.js"></script>
<script type="text/javascript" src="js/bootstrap-material-datetimepicker.js"></script>
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
