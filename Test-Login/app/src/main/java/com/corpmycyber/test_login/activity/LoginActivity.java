package com.corpmycyber.test_login.activity;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.TextInputLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.text.Editable;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.util.Log;
import android.util.Patterns;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.bean.Grupo;
import com.corpmycyber.test_login.bean.Pago;
import com.corpmycyber.test_login.bean.Prestamo;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.AlertDialogManager;
import com.corpmycyber.test_login.session.SessionManager;
import com.corpmycyber.test_login.util.GenerarPassword;
import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.bean.Usuario;
import com.corpmycyber.test_login.db.Database;

import java.io.File;
import java.util.Date;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class LoginActivity extends AppCompatActivity {

    //region Campos
    private Toolbar mToolbar;
    private EditText inputUser, inputPassword;
    private TextInputLayout inputLayoutUser, inputLayoutPassword;
    private Button btnLogin;
    private static final String TAG = LoginActivity.class.getSimpleName();
    private AlertDialogManager alerta = new AlertDialogManager();
    private SessionManager sesion;
    public static Database mDb;
    //endregion

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        sesion = new SessionManager(getApplicationContext());
        inputLayoutUser = (TextInputLayout) findViewById(R.id.input_layout_name);
        inputLayoutPassword = (TextInputLayout) findViewById(R.id.input_layout_password);
        inputUser = (EditText) findViewById(R.id.input_user);
        inputPassword = (EditText) findViewById(R.id.input_password);
        btnLogin = (Button) findViewById(R.id.btn_login);
        mToolbar = (Toolbar) findViewById(R.id.toolbar);
        inputUser.addTextChangedListener(new MyTextWatcher(inputUser));
        inputPassword.addTextChangedListener(new MyTextWatcher(inputPassword));
        setSupportActionBar(mToolbar);
        getSupportActionBar().setDisplayShowHomeEnabled(true);
        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                submitForm();
            }
        });
    }

    /**
     * Validating form
     */
    private void submitForm() {
        try {
            if (!validateName()) { return; }

            if (!validatePassword()) { return; }

            mDb = new Database(LoginActivity.this);
            mDb.open();


            File database = getApplicationContext().getDatabasePath("prestamo.db");

            if (!(database.exists())) {
                Log.i("Base de Datos: ", "No se ha creado!");
            } else {
                Log.i("Base de Datos: ", "Se encontro base de datos!");
            }

            if (!(Database.mUsuarioDaoImplement.obtenerListadoDeUsuarios().size() > 0)) {
                Usuario admin = new Usuario();
                admin.setNombre("Super");
                admin.setApellido("Administrador");
                admin.setCorreo("admin@host.com");
                admin.setTelefono("0000-0000");
                admin.setFechaCreado(new Date());
                admin.setPass(GenerarPassword.getMD5("admin"));
                admin.setUsuario("admin");
                admin.setRol("1");
                Database.mUsuarioDaoImplement.agregarUsuario(admin);

                for(int i = 1; i < 6; i++) {
                    Grupo grupo = new Grupo();
                    grupo.setNombre("Grupo " + i);
                    grupo.setDescripcion("Descripcion grupo " + i);
                    Database.mGrupoDaoImplement.agregarGrupo(grupo);
                }

                for(int i = 1; i < 6; i++) {
                    Cliente cliente = new Cliente();
                    cliente.setIdGrupo(i);
                    cliente.setNombre("Cliente " + i);
                    cliente.setApellido("Apellido " + i);
                    cliente.setTipo("Tipo " + i);
                    cliente.setComentario(" Comentario CLiente " + i);
                    cliente.setCorreo("cliente" + i +"@host.com");
                    cliente.setDireccion("Direccion del Cliente " + i);
                    cliente.setTelefono("000" + i + "-0000");
                    Database.mClienteDaoImplement.agregarCliente(cliente);
                }

                for (int i = 0; i < 6; i++) {
                    Prestamo prestamo = new Prestamo();
                    prestamo.setIdGrupo(i);
                    prestamo.setIdCliente(i);
                    prestamo.setIdUsuario(1);
                    prestamo.setFechaInicio(new Date());
                    prestamo.setCondicion("Ninguna");
                    prestamo.setMonto(Double.parseDouble(i + "0000"));
                    prestamo.setMontoPagado(Double.parseDouble("0000"));
                    prestamo.setMontoParcial(Double.parseDouble("0000"));
                    prestamo.setMontoPendiente(Double.parseDouble(i + "0000"));
                    if ((i % 2) != 0) {prestamo.setEstado("2");} else {prestamo.setEstado("1");}
                    prestamo.setFechaFin(new Date());
                    prestamo.setFormaPago("1");
                    prestamo.setPlazo(6);
                    prestamo.setNoPagos(i);
                    prestamo.setInteres(5.5);
                    Database.mPrestamoDaoImplement.agregarPrestamo(prestamo);
                    for (int j = 0; j < prestamo.getNoPagos(); j++) {
                        Pago pago = new Pago();
                        pago.setIdUsuario(1);
                        pago.setIdPrestamo(i);
                        pago.setIdCliente(Database.mPrestamoDaoImplement.obtenerPrestamoPorId(i).getIdCliente());
                        pago.setTipoPago("1");
                        pago.setReferencia("");
                        pago.setNoTarjeta("");
                        pago.setNoTransferencia("");
                        pago.setAutorizacion("");
                        pago.setBanco("Banco del " + j);
                        pago.setEstado("");
                        pago.setCantidadPagada(Double.parseDouble(j + "00"));
                        Database.mPagoDaoImplement.agregarPago(pago);
                    }
                }
            }



            //new AlertDialogManager().mostrarMensajeDeAlerta(LoginActivity.this, "Numero de Usuarios", String.valueOf(Database.mUsuarioDaoImplement.obtenerListadoDeUsuarios().size()), true);
            Usuario usuarioConectado = Database.mloginDataBaseAdapter.verificarUsuario(inputUser.getText().toString(), inputPassword.getText().toString());
            /*try {
                usuarioConectado = Database.mloginDataBaseAdapter.verificarUsuario(inputUser.getText().toString(), inputPassword.getText().toString());
            } catch (Exception e) {
                usuarioConectado = new Usuario();
            }

            */

            try {
                if (usuarioConectado.getIdUsuario() != null) {
                    sesion.crearSesion(usuarioConectado.getIdUsuario().toString(), usuarioConectado.getNombre() + " " + usuarioConectado.getApellido(), usuarioConectado.getUsuario(), usuarioConectado.getCorreo());
                    //alerta.mostrarMensajeDeAlerta(LoginActivity.this, usuarioConectado.getIdUsuario().toString() + usuarioConectado.getUsuario(), usuarioConectado.getNombre() + usuarioConectado.getApellido(), true);
                    Intent i = new Intent(getApplicationContext(), MainActivity.class);
                    startActivity(i);
                    finish();
                } else {
                    //alerta.mostrarMensajeDeAlerta(LoginActivity.this, "Inicio de Sesion Fallido", "Usuario o Contraseña Incorrectos", false);
                    Toast.makeText(LoginActivity.this, "¡Usuario o Contraseña Incorrectos!", Toast.LENGTH_LONG).show();
                }
            } catch (Exception e) {
                Toast.makeText(LoginActivity.this, "¡Usuario o Contraseña Incorrectos!", Toast.LENGTH_LONG).show();
            }


            /*Usuario admin = new Usuario();
            admin.setNombre("Super");
            admin.setApellido("Administrador");
            admin.setCorreo("admin@host.com");
            admin.setTelefono("0000-0000");
            admin.setFechaCreado(new Date());
            admin.setPass(GenerarPassword.getMD5("admin"));
            admin.setUsuario("admin");
            admin.setRol("1");
            boolean superAdmin = Database.mUsuarioDaoImplement.agregarUsuario(admin);*/

            /*Usuario usuario = new Usuario();
            usuario.setNombre("Super");
            usuario.setApellido("Usuario");
            usuario.setCorreo("user@host.com");
            usuario.setTelefono("0000-0000");
            usuario.setFechaCreado(new Date());
            usuario.setPass(GenerarPassword.getMD5("usuario"));
            usuario.setUsuario("usuario");
            usuario.setRol("2");
            boolean superCliente = Database.mUsuarioDaoImplement.agregarUsuario(usuario);*/

            /*if(superAdmin && superCliente) {
                if(inputUser.getText().toString().equals("admin") && inputPassword.getText().toString().equals("admin")) {
                    sesion.crearSesion("1", "Super Administrador", "admin");
                    Intent i = new Intent(getApplicationContext(), MainActivity.class);
                    startActivity(i);
                    finish();
                } else {
                    alerta.mostrarMensajeDeAlerta(LoginActivity.this, "Inicio de Sesion Fallido", "Usuario o Contraseña Incorrectos", false);
                }
            }*/
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
    }

    private boolean validateName() {
        boolean resultado = true;
        try {
            if (inputUser.getText().toString().trim().isEmpty()) {
                inputLayoutUser.setError(getString(R.string.err_msg_user));
                requestFocus(inputUser);
                resultado = false;
            } else {
                inputLayoutUser.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    private boolean validatePassword() {
        boolean resultado = true;
        try {
            if (inputPassword.getText().toString().trim().isEmpty()) {
                inputLayoutPassword.setError(getString(R.string.err_msg_password));
                requestFocus(inputPassword);
                resultado =  false;
            } else {
                inputLayoutPassword.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    /*private static boolean isValidEmail(String email) {
        return !TextUtils.isEmpty(email) && android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches();
    }*/

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
                    case R.id.input_user:
                        validateName();
                        break;
                    case R.id.input_password:
                        validatePassword();
                        break;
                }
            } catch (Exception e) {
                ErrorHelper.control(e, TAG);
            }
        }
    }

    @Override
    public void onBackPressed() {
        alerta.mostrarMensajeCerrar(LoginActivity.this, true);
        //super.onBackPressed();
    }
}