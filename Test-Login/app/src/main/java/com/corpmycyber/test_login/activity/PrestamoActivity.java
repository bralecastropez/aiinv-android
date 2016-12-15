package com.corpmycyber.test_login.activity;

import android.app.Activity;
import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.design.widget.TextInputLayout;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.Toast;
import android.widget.Toolbar;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.bean.Grupo;
import com.corpmycyber.test_login.bean.Prestamo;
import com.corpmycyber.test_login.db.Database;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.SessionManager;

import java.text.DateFormat;
import java.text.FieldPosition;
import java.text.ParseException;
import java.text.ParsePosition;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

public class PrestamoActivity extends AppCompatActivity implements AdapterView.OnItemSelectedListener {

    //region Campos
    private static final String TAG = PrestamoActivity.class.getSimpleName();
    private Toolbar mToolbar;
    private Prestamo prestamo;
    private EditText txtFechaInicial, txtFechaFinal, txtCondicion, txtMonto, txtMontoPagado,
    txtMontoPendiente, txtMontoParcial, txtEstado, txtFormaPago, txtPlazo, txtInteres, txtNoPagos;
    //private SimpleDateFormat txtFechaInicial, txtFechaFinal;
    private TextInputLayout inputLayoutFechaInicio,inputLayoutFechaFin, inputLayoutCondicion,inputLayoutMonto,
    inputLayoutMontoPagado,  inputLayoutMontoPendiente, inputLayoutMontoParcial, inputLayoutEstado, inputLayoutFormaPago, inputLayoutPlazo,
    inputLayoutInteres, inputLayoutNoPagos;
    private Button btnEjecutar, btnCancelar;
    private Integer mantenimiento;
    private ProgressDialog pDialog;
    private Spinner spinner;
    private List<Grupo> grupoList = new ArrayList<>();
    private SessionManager sessionManager;
    public static Database mDb;
    //endregion

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cliente);

        sessionManager = new SessionManager(getApplicationContext());
        sessionManager.verificarSesion();

        mToolbar = (Toolbar) findViewById(R.id.toolbar);
      //  setSupportActionBar(mToolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        btnEjecutar = (Button) findViewById(R.id.btn_ejecutar);
        btnCancelar = (Button) findViewById(R.id.btn_cancelar);


        SimpleDateFormat df = new SimpleDateFormat("dd-MM-YYYY");
        Date myDate;
        /*try{


       // myDate = df.parse(date);
        String myText = myDate.getDate()+"-"+myDate.getMonth()+"-"+myDate.getYear();
        //}catch (ParseException e){
            e.printStackTrace();
        }*/


        txtFechaFinal = (EditText) findViewById(R.id.input_fechainicio_prestamo);

        txtFechaInicial = (EditText) findViewById(R.id.input_fechafin_prestamo);
        txtCondicion = (EditText) findViewById(R.id.input_condicion_prestamo);
        txtMonto = (EditText) findViewById(R.id.input_monto_prestamo);
        txtMontoPagado = (EditText) findViewById(R.id.input_montopendiente_prestamo);
        txtMontoPendiente = (EditText) findViewById(R.id.input_montopagado_prestamo);
        txtMontoParcial = (EditText) findViewById(R.id.input_montoparcial_prestamo);
        txtEstado = (EditText) findViewById(R.id.input_estado_prestamo);
        txtFormaPago = (EditText) findViewById(R.id.input_formapago_prestamo);
        txtPlazo = (EditText) findViewById(R.id.input_plazo_prestamo);
        txtInteres = (EditText) findViewById(R.id.input_interes_prestamo);
        txtNoPagos = (EditText) findViewById(R.id.input_nopagos_prestamo);


        inputLayoutFechaInicio = (TextInputLayout) findViewById(R.id.input_layout_fechainicio_prestamo);
        inputLayoutFechaFin = (TextInputLayout) findViewById(R.id.input_layout_fechafin_prestamo);
        inputLayoutCondicion = (TextInputLayout) findViewById(R.id.input_layout_condicion_prestamo);
        inputLayoutMonto = (TextInputLayout) findViewById(R.id.input_layout_monto_prestamo);
        inputLayoutMontoPagado = (TextInputLayout) findViewById(R.id.input_layout_montopagado_prestamo);
        inputLayoutMontoPendiente = (TextInputLayout) findViewById(R.id.input_layout_montopendiente_prestamo);
        inputLayoutMontoParcial = (TextInputLayout) findViewById(R.id.input_layout_montoparcial_prestamo);
        inputLayoutEstado = (TextInputLayout) findViewById(R.id.input_layout_estado_prestamo);
        inputLayoutFormaPago = (TextInputLayout) findViewById(R.id.input_layout_formapago_prestamo);
        inputLayoutPlazo = (TextInputLayout) findViewById(R.id.input_layout_plazo_prestamo);
        inputLayoutInteres = (TextInputLayout) findViewById(R.id.input_layout_interes_prestamo);
        inputLayoutInteres = (TextInputLayout) findViewById(R.id.input_layout_interes_prestamo);
        inputLayoutNoPagos = (TextInputLayout) findViewById(R.id.input_layout_nopagos_prestamo);
        try {
            Integer mantenimientoSeleccionado = getIntent().getIntExtra("mantenimiento", 0);
            if (mantenimientoSeleccionado != 0) {
                mantenimiento = mantenimientoSeleccionado;
                //Toast.makeText(getApplicationContext(), "Mantenimiento " + mantenimiento, Toast.LENGTH_LONG).show();
            } else {
                mantenimiento = 0;
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }

        try {
            Prestamo prestamoSeleccionado = (Prestamo) getIntent().getExtras().get("prestamoSeleccionado");
            if (prestamoSeleccionado != null) {
                this.prestamo = prestamoSeleccionado;
                txtFechaFinal.setText(prestamo.getFechaInicio().toString());
                txtFechaInicial.setText(prestamo.getFechaFin().toString());
                txtCondicion.setText(prestamo.getCondicion());
                txtMonto.setText(prestamo.getMonto().toString());
                txtMontoPagado.setText(prestamo.getMontoPagado().toString());
                txtMontoPendiente.setText(prestamo.getMontoPendiente().toString());
                txtMontoParcial.setText(prestamo.getMontoParcial().toString());
                txtEstado.setText(prestamo.getEstado());
                txtFormaPago.setText(prestamo.getFormaPago());
                txtPlazo.setText(prestamo.getPlazo());
                txtInteres.setText(prestamo.getInteres().toString());
                txtNoPagos.setText(prestamo.getNoPagos());


            } else {
                prestamo = new Prestamo();
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
            prestamo = new Prestamo();
            mantenimiento = 1;
        }

        switch (mantenimiento) {
            case 1:
                btnEjecutar.setText("Agregar");
                btnCancelar.setText("Cancelar");
                setTitle("Agregar Cliente");
                break;
            case 2:
                btnEjecutar.setText("Editar");
                btnCancelar.setText("Cancelar");
                setTitle("Editar Prestamo");
                break;
            case 3:
                btnEjecutar.setText("Si");
                btnCancelar.setText("No");
                setTitle("Eliminar Prestamo");
                inputLayoutFechaInicio.setEnabled(false);
                txtFechaInicial.setEnabled(false);
                inputLayoutFechaFin.setEnabled(false);
                txtFechaFinal.setEnabled(false);
                inputLayoutCondicion.setEnabled(false);
                txtCondicion.setEnabled(false);
                inputLayoutMonto.setEnabled(false);
                txtMonto.setEnabled(false);
                inputLayoutMontoPagado.setEnabled(false);
                txtMontoPagado.setEnabled(false);
                inputLayoutMontoPendiente.setEnabled(false);
                txtMontoPendiente.setEnabled(false);
                inputLayoutMontoParcial.setEnabled(false);
                txtMontoParcial.setEnabled(false);
                inputLayoutEstado.setEnabled(false);
                txtEstado.setEnabled(false);
                inputLayoutFormaPago.setEnabled(false);
                txtFormaPago.setEnabled(false);
                inputLayoutPlazo.setEnabled(false);
                txtPlazo.setEnabled(false);
                inputLayoutInteres.setEnabled(false);
                txtInteres.setEnabled(false);
                inputLayoutNoPagos.setEnabled(false);
                txtNoPagos.setEnabled(false);
                btnCancelar.setFocusable(true);
                btnCancelar.setFocusableInTouchMode(true);
                btnCancelar.requestFocus();
                break;
            case 0:
            default:
                break;

            //     new ObtenerGrupos().execute();

        }

        btnEjecutar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                submitForm();
            }
        });

        btnCancelar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });
    }
    private void submitForm() {
        try {
            if (!validarFechaInicial()) {
                return;
            }
            if (!validarFechaFin()) {
                return;
            }
            if (!validarCondicion()) {
                return;
            }
            if (!validarMonto()) {
                return;
            }
            if (!validarMontoPagado()) {
                return;
            }
            if (!validarMontoPendiente()) {
                return;
            }
            if (!validarMontoParcial()) {
                return;
            }

            if (!validarEstado()) {
                return;
            }
            if (!validarFormaPagos()) {
                return;
            }
            if (!validarPlazo()) {
                return;
            }
            if (!validarInteres()) {
                return;
            }
            if(!validarNoPagos()){
                return;
            }

            mDb = new Database(PrestamoActivity.this);
            mDb.open();

            prestamo.setFechaInicio(txtFechaInicial.getText().toString());
            prestamo.setFechaFin(txtFechaFinal.getText().toString());
            prestamo.setCondicion(txtCondicion.getText().toString());
            prestamo.setMonto(Double.valueOf(txtMonto.getText().toString()));
            prestamo.setMontoPagado(Double.valueOf(txtMontoPagado.getText().toString()));
            prestamo.setMontoPendiente(Double.valueOf(txtMontoPendiente.getText().toString()));
            prestamo.setMontoParcial(Double.valueOf(txtMontoParcial.getText().toString()));
            prestamo.setEstado(txtEstado.getText().toString());
            prestamo.setPlazo(Integer.valueOf(txtPlazo.getText().toString()));
            prestamo.setFormaPago(txtFormaPago.getText().toString());
            prestamo.setInteres(Double.valueOf(txtInteres.getText().toString()));
            prestamo.setNoPagos(Integer.valueOf(txtNoPagos.getText().toString()));

            switch (mantenimiento) {
                case 1:
                    if (Database.mPrestamoDaoImplement.agregarPrestamo(prestamo)) {
                    } else {
                    }
                    break;
                case 2:
                    if (Database.mPrestamoDaoImplement.editarPrestamo(prestamo)) {
                        Toast.makeText(getApplicationContext(), "¡Prestamo Editar Exitosamente!", Toast.LENGTH_LONG).show();;
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "¡Error al Editar el Prestamo!", Toast.LENGTH_LONG).show();;
                    }
                    break;
                case 3:
                    if (Database.mPrestamoDaoImplement.eliminarPrestamo(prestamo)) {
                        Toast.makeText(getApplicationContext(), "¡Prestamo Eliminado Exitosamente!", Toast.LENGTH_LONG).show();;
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "¡Error al Eliminar el Prestamo!", Toast.LENGTH_LONG).show();;
                    }
                    break;
                case 0:default:
                    break;
            }



        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
    }

    public boolean validarFechaInicial() {
        boolean resultado = true;
        try {
            if (txtFechaInicial.getText().toString().trim().isEmpty()) {
                inputLayoutFechaInicio.setError(getString(R.string.error_msg_fechainicial));
                requestFocus(txtFechaInicial);
                resultado = false;
            } else {
                inputLayoutFechaInicio.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarFechaFin() {
        boolean resultado = true;
        try {
            if (txtFechaFinal.getText().toString().trim().isEmpty()) {
                inputLayoutFechaFin.setError(getString(R.string.error_msg_fechafinal));
                requestFocus(txtFechaFinal);
                resultado = false;
            } else {
                inputLayoutFechaFin.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarCondicion() {
        boolean resultado = true;
        try {
            if (txtCondicion.getText().toString().trim().isEmpty()) {
                inputLayoutCondicion.setError(getString(R.string.error_msg_condicion));
                requestFocus(txtCondicion);
                resultado = false;
            } else {
                inputLayoutCondicion.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarMonto() {
        boolean resultado = true;
        try {
            if (txtMonto.getText().toString().trim().isEmpty()) {
                inputLayoutMonto.setError(getString(R.string.error_msg_monto));
                requestFocus(txtMonto);
                resultado = false;
            } else {
                inputLayoutMonto.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarMontoPagado() {
        boolean resultado = true;
        try {
            if (txtMontoPagado.getText().toString().trim().isEmpty()) {
                inputLayoutMontoPagado.setError(getString(R.string.error_msg_montopagado));
                requestFocus(txtMontoPagado);
                resultado = false;
            } else {
                inputLayoutMontoPagado.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarMontoPendiente() {
        boolean resultado = true;
        try {
            if (txtMontoPagado.getText().toString().trim().isEmpty()) {
                inputLayoutMontoPendiente.setError(getString(R.string.error_msg_montopendiente));
                requestFocus(txtMontoPendiente);
                resultado = false;
            } else {
                inputLayoutMontoPendiente.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarMontoParcial() {
        boolean resultado = true;
        try {
            if (txtMontoParcial.getText().toString().trim().isEmpty()) {
                inputLayoutMontoParcial.setError(getString(R.string.error_msg_montoparcial));
                requestFocus(txtMontoParcial);
                resultado = false;
            } else {
                inputLayoutMontoParcial.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }


    public boolean validarEstado() {
        boolean resultado = true;
        try {
            if (txtEstado.getText().toString().trim().isEmpty()) {
                inputLayoutEstado.setError(getString(R.string.error_msg_estado));
                requestFocus(txtEstado);
                resultado = false;
            } else {
                inputLayoutEstado.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarPlazo() {
        boolean resultado = true;
        try {
            if (txtPlazo.getText().toString().trim().isEmpty()) {
                inputLayoutPlazo.setError(getString(R.string.error_msg_plazo));
                requestFocus(txtPlazo);
                resultado = false;
            } else {
                inputLayoutPlazo.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarFormaPagos() {
        boolean resultado = true;
        try {
            if (txtFormaPago.getText().toString().trim().isEmpty()) {
                inputLayoutFormaPago.setError(getString(R.string.error_msg_formapago));
                requestFocus(txtFormaPago);
                resultado = false;
            } else {
                inputLayoutFormaPago.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }


    public boolean validarInteres() {
        boolean resultado = true;
        try {
            if (txtInteres.getText().toString().trim().isEmpty()) {
                inputLayoutInteres.setError(getString(R.string.error_msg_interes));
                requestFocus(txtInteres);
                resultado = false;
            } else {
                inputLayoutInteres.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarNoPagos() {
        boolean resultado = true;
        try {
            if (txtNoPagos.getText().toString().trim().isEmpty()) {
                inputLayoutNoPagos.setError(getString(R.string.error_msg_nopagos));
                requestFocus(txtNoPagos);
                resultado = false;
            } else {
                inputLayoutNoPagos.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        boolean resultado = false;
        try {
            switch (item.getItemId()) {
                case android.R.id.home:
                    finish();
                    resultado = true;
            }
            resultado = super.onOptionsItemSelected(item);
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean onCreateOptionsMenu(Menu menu) { return true; }

    private void requestFocus(View view) {
        try {
            if (view.requestFocus()) {
                getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_ALWAYS_VISIBLE);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
    }

    private class MyTextWatcher implements TextWatcher {

        private View view;

        private MyTextWatcher(View view) { this.view = view; }

        public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {}

        public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {}

        public void afterTextChanged(Editable editable) {
            try {
                switch (view.getId()) {
                    case R.id.input_fechainicio_prestamo:
                        validarFechaInicial();
                        break;
                    case R.id.input_fechafin_prestamo:
                        validarFechaFin();
                        break;
                    case R.id.input_condicion_prestamo:
                        validarCondicion();
                        break;
                    case R.id.input_monto_prestamo:
                        validarMonto();
                        break;
                    case R.id.input_montopagado_prestamo:
                        validarMontoPagado();
                        break;
                    case R.id.input_montopendiente_prestamo:
                        validarMontoPendiente();
                        break;
                    case R.id.input_montoparcial_prestamo:
                        validarMontoParcial();
                        break;
                    case R.id.input_estado_prestamo:
                        validarEstado();

                    case R.id.input_plazo_prestamo:
                        validarPlazo();

                    case R.id.input_formapago_prestamo:
                        validarFormaPagos();

                    case R.id.input_interes_prestamo:
                        validarInteres();

                    case R.id.input_nopagos_prestamo:
                        validarNoPagos();
                }
            } catch (Exception e) {
                ErrorHelper.control(e, TAG);
            }
        }
    }

    public PrestamoActivity() {}

    public Prestamo getPrestamo() { return prestamo; }
    public void setPrestamo(Prestamo prestamo) { this.prestamo = prestamo; }

    public Integer getMantenimiento() { return mantenimiento; }
    public void setMantenimiento(Integer mantenimiento) { this.mantenimiento = mantenimiento; }
   /* private class ObtenerGrupos extends AsyncTask<Void, Void, Void> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            pDialog = new ProgressDialog(PrestamoActivity.this);
            pDialog.setMessage("Listando Grupos");
            pDialog.setCancelable(false);
            pDialog.show();
        }

        @Override
        protected Void doInBackground(Void... arg0) {
            try {
                cargarDatos();
            } catch (Exception e) {
                ErrorHelper.control(e, TAG);
            }
            return null;
        }
*/

    @Override
    public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
        try {
//            Toast.makeText(getApplicationContext(), parent.getItemAtPosition(position).toString() + " Selected" , Toast.LENGTH_LONG).show();
            if (spinner.getSelectedItem() != null) {
                Grupo grupoSeleccionado = (Grupo) spinner.getSelectedItem();
                Toast.makeText(getApplicationContext(),grupoSeleccionado.getIdGrupo() + " Selected" , Toast.LENGTH_LONG).show();
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }

    }

    @Override
    public void onNothingSelected(AdapterView<?> arg0) {}
}