package com.corpmycyber.test_login.session;

import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.util.Log;

import com.corpmycyber.test_login.bean.Usuario;
import com.corpmycyber.test_login.dao.UsuarioDaoImplement;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.interfaces.IUsuarioDao;
import com.corpmycyber.test_login.interfaces.LoginDao;
import com.corpmycyber.test_login.schema.IUsuarioSchema;
import com.corpmycyber.test_login.util.GenerarPassword;

import java.util.Date;

public class LoginDataBaseAdapter implements LoginDao, IUsuarioSchema  {

    private static final String NOMBRE_CLASE = LoginDataBaseAdapter.class.getSimpleName();
    private SQLiteDatabase sqLite;

    public  LoginDataBaseAdapter(SQLiteDatabase dbe) {this.sqLite = dbe;}

    @Override
    public Usuario verificarUsuario(String usuario, String pass) {
        Usuario resultado = null;
        try {
            IUsuarioDao dao = new UsuarioDaoImplement(sqLite);
            SQLiteDatabase db = sqLite;
            String password = GenerarPassword.getMD5(pass);
            String selectQuery = "SELECT  * FROM " + TABLA_USUARIO
                    + " WHERE " + COLUMNA_USUARIO + " = '" + usuario
                    + "' AND " + COLUMNA_PASS + " = '" + password + "'";

            Log.e(NOMBRE_CLASE, selectQuery);

            Cursor c = db.rawQuery(selectQuery, null);
            if (c != null) {
                if (c.moveToFirst()){
                    Log.e(NOMBRE_CLASE, c.getClass().toString());
                    resultado = new Usuario();
                    resultado.setIdUsuario(c.getInt(c.getColumnIndex(COLUMNA_ID_USUARIO)));
                    resultado.setNombre(c.getString(c.getColumnIndex(COLUMNA_NOMBRE)));
                    resultado.setApellido(c.getString(c.getColumnIndex(COLUMNA_APELLIDO)));
                    resultado.setUsuario(c.getString(c.getColumnIndex(COLUMNA_USUARIO)));
                    resultado.setPass(c.getString(c.getColumnIndex(COLUMNA_PASS)));
                    resultado.setRol(c.getString(c.getColumnIndex(COLUMNA_ROL)));
                    resultado.setTelefono(c.getString(c.getColumnIndex(COLUMNA_TELEFONO)));
                    resultado.setCorreo(c.getString(c.getColumnIndex(COLUMNA_CORREO)));
                    resultado.setFechaCreado(new Date(c.getLong(c.getColumnIndex(COLUMNA_FECHA_CREADO))));
                }
            }


        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }

        return resultado;
    }

}