package com.corpmycyber.test_login.activity;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
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
import com.corpmycyber.test_login.bean.Grupo;
import com.corpmycyber.test_login.db.Database;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.AlertDialogManager;
import com.corpmycyber.test_login.session.SessionManager;

public class GrupoActivity extends AppCompatActivity {

    private static String TAG = GrupoActivity.class.getSimpleName();
    private Toolbar mToolbar;
    private Grupo grupo;
    private EditText txtNombreG, txtDescripcionG;
    private TextInputLayout inputLayoutNombreG, inputLayoutDescripcionG;
    private Button btnEjecutarG, btnCancelarG;
    private AlertDialogManager alerta = new AlertDialogManager();
    private SessionManager sessionManager;
    public static Database mDb;
    private Integer mantenimiento;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_grupo);

        sessionManager = new SessionManager(getApplicationContext());
        sessionManager.verificarSesion();

        mToolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(mToolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);


        btnEjecutarG = (Button) findViewById(R.id.btn_ejecutarG);
        btnCancelarG = (Button) findViewById(R.id.btn_cancelarG);

        txtNombreG = (EditText) findViewById(R.id.input_nombre_grupo);
        txtDescripcionG = (EditText) findViewById(R.id.input_descripcion_grupo);

        inputLayoutNombreG = (TextInputLayout) findViewById(R.id.input_layout_nombre_grupo);
        inputLayoutDescripcionG = (TextInputLayout) findViewById(R.id.input_layout_descripcion_grupo);


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
            Grupo grupoSeleccionado = (Grupo) getIntent().getExtras().get("gruupoSeleccionado");
            if (grupoSeleccionado != null) {
                this.grupo = grupoSeleccionado;
                txtNombreG.setText(grupo.getNombre());
                txtDescripcionG.setText(grupo.getDescripcion());
            } else {
                grupo = new Grupo();
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
            grupo = new Grupo();
            mantenimiento = 1;
        }


        switch (mantenimiento) {
            case 1:
                btnEjecutarG.setText("Agregar");
                btnCancelarG.setText("Cancelar");
                setTitle("Agregar Grupo");
                break;
            case 2:
                btnEjecutarG.setText("Editar");
                btnCancelarG.setText("Cancelar");
                setTitle("Editar Grupo");
                break;
            case 3:
                btnEjecutarG.setText("Si");
                btnCancelarG.setText("No");
                setTitle("Eliminar Grupo");
                inputLayoutNombreG.setEnabled(false);
                txtNombreG.setEnabled(false);
                inputLayoutDescripcionG.setEnabled(false);
                txtDescripcionG.setEnabled(false);

                btnCancelarG.setFocusable(true);
                btnCancelarG.setFocusableInTouchMode(true);
                btnCancelarG.requestFocus();
                break;
            case 0:default:
                break;
        }


        btnEjecutarG.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                submitForm();
            }
        });

        btnCancelarG.setOnClickListener(new View.OnClickListener() {
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
            if (!validarDescripcion()) {
                return;
            }

            mDb = new Database(GrupoActivity.this);
            mDb.open();

            grupo.setNombre(txtNombreG.getText().toString());
            grupo.setDescripcion(txtDescripcionG.getText().toString());

            switch (mantenimiento) {
                case 1:
                    if (Database.mGrupoDaoImplement.agregarGrupo(grupo)) {
                        Toast.makeText(getApplicationContext(), "¡Grupo Agregado Exitosamente!", Toast.LENGTH_LONG).show();
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "¡Error al Agregar el Grupo!", Toast.LENGTH_LONG).show();;
                    }
                    break;
                case 2:
                    if (Database.mGrupoDaoImplement.editarGrupo(grupo)) {
                        Toast.makeText(getApplicationContext(), "¡Grupo Editar Exitosamente!", Toast.LENGTH_LONG).show();;
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "¡Error al Editar el Grupo!", Toast.LENGTH_LONG).show();;
                    }
                    break;
                case 3:
                    if (Database.mGrupoDaoImplement.eliminarGrupo(grupo)) {
                        Toast.makeText(getApplicationContext(), "¡Grupo Eliminado Exitosamente!", Toast.LENGTH_LONG).show();;
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "¡Error al Eliminar el Grupo!", Toast.LENGTH_LONG).show();;
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
            if (txtNombreG.getText().toString().trim().isEmpty()) {
                inputLayoutNombreG.setError(getString(R.string.error_msg_nombreGrupo));
                requestFocus(txtNombreG);
                resultado = false;
            } else {
                inputLayoutNombreG.setErrorEnabled(false);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public boolean validarDescripcion() {
        boolean resultado = true;
        try {
            if (txtDescripcionG.getText().toString().trim().isEmpty()) {
                inputLayoutDescripcionG.setError(getString(R.string.error_msg_descripcion));
                requestFocus(txtDescripcionG);
                resultado = false;
            } else {
                inputLayoutDescripcionG.setErrorEnabled(false);
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
                    case R.id.input_nombre_grupo:
                        validarNombre();
                        break;
                    case R.id.input_descripcion_grupo:
                        validarDescripcion();
                        break;
                }
            } catch (Exception e) {
                ErrorHelper.control(e, TAG);
            }
        }
    }

    public GrupoActivity() {}

    public Grupo getGrupo() { return grupo; }
    public void setGrupo(Grupo grupo) { this.grupo = grupo; }

    public Integer getMantenimiento() { return mantenimiento; }
    public void setMantenimiento(Integer mantenimiento) { this.mantenimiento = mantenimiento; }


}
