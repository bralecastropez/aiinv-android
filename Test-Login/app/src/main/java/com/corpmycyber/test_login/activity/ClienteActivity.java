package com.corpmycyber.test_login.activity;

import android.os.Bundle;
import android.support.design.widget.TextInputLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.db.Database;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.AlertDialogManager;
import com.corpmycyber.test_login.session.SessionManager;

public class ClienteActivity extends AppCompatActivity {

    private static String TAG = ClienteActivity.class.getSimpleName();
    private Toolbar mToolbar;
    private Cliente cliente;
    private EditText txtNombre, txtApellido, txtCorreo, txtTelefono, txtDireccion, txtTipo, txtComentario;
    private TextInputLayout inputLayoutNombre, inputLayoutApellido, inputLayoutCorreo, inputLayoutTelefono,
            inputLayoutDireccion, inputLayoutTipo, inputLayoutComentario;
    private Button btnEjecutar, btnCancelar;
    private AlertDialogManager alerta = new AlertDialogManager();
    private SessionManager sessionManager;
    public static Database mDb;
    private Integer mantenimiento;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cliente);
        
        sessionManager = new SessionManager(getApplicationContext());
        sessionManager.verificarSesion();
        
        mToolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(mToolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        btnEjecutar = (Button) findViewById(R.id.btn_ejecutar);
        btnCancelar = (Button) findViewById(R.id.btn_cancelar);
        
        txtNombre = (EditText) findViewById(R.id.input_nombre_cliente);
        txtApellido = (EditText) findViewById(R.id.input_apellido_cliente);
        txtCorreo = (EditText) findViewById(R.id.input_correo_cliente);
        txtTelefono = (EditText) findViewById(R.id.input_telefono_cliente);
        txtDireccion = (EditText) findViewById(R.id.input_direccion_cliente);
        txtTipo = (EditText) findViewById(R.id.input_tipo_cliente);
        txtComentario = (EditText) findViewById(R.id.input_comentario_cliente);

        inputLayoutNombre = (TextInputLayout) findViewById(R.id.input_layout_nombre_cliente);
        inputLayoutApellido = (TextInputLayout) findViewById(R.id.input_layout_apellido_cliente);
        inputLayoutCorreo = (TextInputLayout) findViewById(R.id.input_layout_correo_cliente);
        inputLayoutTelefono = (TextInputLayout) findViewById(R.id.input_layout_telefono_cliente);
        inputLayoutDireccion = (TextInputLayout) findViewById(R.id.input_layout_direccion_cliente);
        inputLayoutTipo = (TextInputLayout) findViewById(R.id.input_layout_tipo_cliente);
        inputLayoutComentario = (TextInputLayout) findViewById(R.id.input_layout_comentario_cliente);

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
            Cliente clienteSeleccionado = (Cliente) getIntent().getExtras().get("clienteSeleccionado");
            if (clienteSeleccionado != null) {
                this.cliente = clienteSeleccionado;
                txtNombre.setText(cliente.getNombre());
                txtApellido.setText(cliente.getApellido());
                txtCorreo.setText(cliente.getCorreo());
                txtTelefono.setText(cliente.getTelefono());
                txtDireccion.setText(cliente.getDireccion());
                txtTipo.setText(cliente.getTipo());
                txtComentario.setText(cliente.getComentario());
            } else {
                cliente = new Cliente();
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
            cliente = new Cliente();
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
                setTitle("Editar Cliente");
                break;
            case 3:
                btnEjecutar.setText("Si");
                btnCancelar.setText("No");
                setTitle("Eliminar Cliente");
                inputLayoutNombre.setEnabled(false);
                txtNombre.setEnabled(false);
                inputLayoutApellido.setEnabled(false);
                txtApellido.setEnabled(false);
                inputLayoutCorreo.setEnabled(false);
                txtCorreo.setEnabled(false);
                inputLayoutTelefono.setEnabled(false);
                txtTelefono.setEnabled(false);
                inputLayoutDireccion.setEnabled(false);
                txtDireccion.setEnabled(false);
                inputLayoutTipo.setEnabled(false);
                txtTipo.setEnabled(false);
                inputLayoutComentario.setEnabled(false);
                txtComentario.setEnabled(false);

                btnCancelar.setFocusable(true);
                btnCancelar.setFocusableInTouchMode(true);
                btnCancelar.requestFocus();
                break;
            case 0:default:
                break;
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
            if (!validarNombre()) {
                return;
            }
            if (!validarApellido()) {
                return;
            }
            if (!validarCorreo()) {
                return;
            }
            if (!validarTelefono()) {
                return;
            }
            if (!validarDireccion()) {
                return;
            }
            if (!validarTipo()) {
                return;
            }
            if (!validarComentario()) {
                return;
            }

            mDb = new Database(ClienteActivity.this);
            mDb.open();

            cliente.setNombre(txtNombre.getText().toString());
            cliente.setApellido(txtApellido.getText().toString());
            cliente.setCorreo(txtCorreo.getText().toString());
            cliente.setTelefono(txtTelefono.getText().toString());
            cliente.setDireccion(txtDireccion.getText().toString());
            cliente.setTipo(txtTipo.getText().toString());
            cliente.setComentario(txtComentario.getText().toString());

            switch (mantenimiento) {
                case 1:
                    if (Database.mClienteDaoImplement.agregarCliente(cliente)) {
                        Toast.makeText(getApplicationContext(), "¡Cliente Agregado Exitosamente!", Toast.LENGTH_LONG).show();
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "¡Error al Agregar el Usuario!", Toast.LENGTH_LONG).show();;
                    }
                    break;
                case 2:
                    if (Database.mClienteDaoImplement.editarCliente(cliente)) {
                        Toast.makeText(getApplicationContext(), "¡Cliente Editar Exitosamente!", Toast.LENGTH_LONG).show();;
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "¡Error al Editar el Usuario!", Toast.LENGTH_LONG).show();;
                    }
                    break;
                case 3:
                    if (Database.mClienteDaoImplement.eliminarCliente(cliente)) {
                        Toast.makeText(getApplicationContext(), "¡Cliente Eliminado Exitosamente!", Toast.LENGTH_LONG).show();;
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "¡Error al Eliminar el Usuario!", Toast.LENGTH_LONG).show();;
                    }
                    break;
                case 0:default:
                    break;
            }



        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
    }

    public boolean validarNombre() {
        boolean resultado = true;
        try {
            if (txtNombre.getText().toString().trim().isEmpty()) {
                inputLayoutNombre.setError(getString(R.string.error_msg_nombre));
                requestFocus(txtNombre);
                resultado = false;
            } else {
                inputLayoutNombre.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarApellido() {
        boolean resultado = true;
        try {
            if (txtApellido.getText().toString().trim().isEmpty()) {
                inputLayoutApellido.setError(getString(R.string.error_msg_apellido));
                requestFocus(txtApellido);
                resultado = false;
            } else {
                inputLayoutApellido.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarCorreo() {
        boolean resultado = true;
        try {
            if (txtCorreo.getText().toString().trim().isEmpty()) {
                inputLayoutCorreo.setError(getString(R.string.error_msg_correo));
                requestFocus(txtCorreo);
                resultado = false;
            } else {
                inputLayoutCorreo.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarTelefono() {
        boolean resultado = true;
        try {
            if (txtTelefono.getText().toString().trim().isEmpty()) {
                inputLayoutTelefono.setError(getString(R.string.error_msg_telefono));
                requestFocus(txtTelefono);
                resultado = false;
            } else {
                inputLayoutTelefono.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarDireccion() {
        boolean resultado = true;
        try {
            if (txtDireccion.getText().toString().trim().isEmpty()) {
                inputLayoutDireccion.setError(getString(R.string.hint_cliente_direccion));
                requestFocus(txtDireccion);
                resultado = false;
            } else {
                inputLayoutDireccion.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarTipo() {
        boolean resultado = true;
        try {
            if (txtTipo.getText().toString().trim().isEmpty()) {
                inputLayoutTipo.setError(getString(R.string.error_msg_tipo));
                requestFocus(txtTipo);
                resultado = false;
            } else {
                inputLayoutTipo.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarComentario() {
        boolean resultado = true;
        try {
            if (txtComentario.getText().toString().trim().isEmpty()) {
                inputLayoutComentario.setError(getString(R.string.error_msg_comentario));
                requestFocus(txtComentario);
                resultado = false;
            } else {
                inputLayoutComentario.setErrorEnabled(false);
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
                    case R.id.input_nombre_cliente:
                        validarNombre();
                        break;
                    case R.id.input_apellido_cliente:
                        validarApellido();
                        break;
                    case R.id.input_correo_cliente:
                        validarCorreo();
                        break;
                    case R.id.input_telefono_cliente:
                        validarTelefono();
                        break;
                    case R.id.input_direccion_cliente:
                        validarDireccion();
                        break;
                    case R.id.input_tipo_cliente:
                        validarTipo();
                        break;
                    case R.id.input_comentario_cliente:
                        validarComentario();
                        break;
                }
            } catch (Exception e) {
                ErrorHelper.control(e, TAG);
            }
        }
    }

    public ClienteActivity() {}

    public Cliente getCliente() { return cliente; }
    public void setCliente(Cliente cliente) { this.cliente = cliente; }

    public Integer getMantenimiento() { return mantenimiento; }
    public void setMantenimiento(Integer mantenimiento) { this.mantenimiento = mantenimiento; }
}