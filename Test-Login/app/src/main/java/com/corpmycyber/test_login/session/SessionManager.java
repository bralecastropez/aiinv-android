package com.corpmycyber.test_login.session;

import java.util.HashMap;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;

import com.corpmycyber.test_login.activity.LoginActivity;
import com.corpmycyber.test_login.helper.ErrorHelper;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class SessionManager {

    //region Campos
    private static final String NOMBRE_CLASE = SessionManager.class.getSimpleName();
    SharedPreferences pref;
    Editor editor;
    Context _context;
    int PRIVATE_MODE = 0;
    private static final String PREF_NAME = "AIINVPref";
    private static final String IS_LOGIN = "IsLoggedIn";
    public static final String KEY_NAME = "nombre";
    public static final String KEY_ID = "idUsuario";
    public static final String KEY_USER = "usuario";
    public static final String KEY_MAIL = "correo";
    //endregion

    //region Constructores
    public SessionManager(Context context){
        try {
            this._context = context;
            pref = _context.getSharedPreferences(PREF_NAME, PRIVATE_MODE);
            editor = pref.edit();
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
    }
    //endregion

    //region Metodos

    public void crearSesion(String idUsuario, String nombre, String usuario, String correo){
        try {
            editor.putBoolean(IS_LOGIN, true);
            editor.putString(KEY_ID, idUsuario);
            editor.putString(KEY_NAME, nombre);
            editor.putString(KEY_USER, usuario);
            editor.putString(KEY_MAIL, correo);
            editor.commit();
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
    }

    public void verificarSesion() {
        try {
            if(!this.estaConectado()){
                Intent i = new Intent(_context, LoginActivity.class);
                i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                _context.startActivity(i);
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
    }

    public HashMap<String, String> obtenerDatosDelUsuario(){
        HashMap<String, String> user = new HashMap<String, String>();
        try {
            user.put(KEY_NAME, pref.getString(KEY_NAME, null));
            user.put(KEY_ID, pref.getString(KEY_ID, null));
            user.put(KEY_USER, pref.getString(KEY_USER, null));
            user.put(KEY_MAIL, pref.getString(KEY_MAIL, null));
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return user;
    }

    public void desconectarUsuario() {
        try {
            editor.clear();
            editor.commit();
            Intent i = new Intent(_context, LoginActivity.class);
            i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
            i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            _context.startActivity(i);
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
    }

    public boolean estaConectado(){
        return pref.getBoolean(IS_LOGIN, false);
    }
    //endregion
}