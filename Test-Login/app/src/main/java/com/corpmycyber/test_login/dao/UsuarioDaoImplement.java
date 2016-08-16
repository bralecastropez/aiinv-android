package com.corpmycyber.test_login.dao;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteConstraintException;
import android.database.sqlite.SQLiteDatabase;

import com.corpmycyber.test_login.bean.Usuario;
import com.corpmycyber.test_login.helper.DbContentProvider;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.interfaces.IUsuarioDao;
import com.corpmycyber.test_login.schema.IUsuarioSchema;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class UsuarioDaoImplement extends DbContentProvider implements IUsuarioSchema, IUsuarioDao {

    private static final String NOMBRE_CLASE = UsuarioDaoImplement.class.getSimpleName();
    private Cursor cursor;
    private ContentValues initialValues;

    public UsuarioDaoImplement(SQLiteDatabase db) { super(db); }

    @Override
    protected Usuario cursorToEntity(Cursor cursor) {
        Usuario usuario = new Usuario();
        try {
            int idUsuarioIndice;
            int nombreIndice;
            int apellidoIndice;
            int correoIndice;
            int telefonoIndice;
            int rolIndice;
            int fechaIngresoIndex;
            int usuarioIndex;
            int passIndex;
            if(cursor != null) {
                if (cursor.getColumnIndex(COLUMNA_ID_USUARIO) != -1) {
                    idUsuarioIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_USUARIO);
                    usuario.setIdUsuario(cursor.getInt(idUsuarioIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_NOMBRE) != -1) {
                    nombreIndice = cursor.getColumnIndexOrThrow(COLUMNA_NOMBRE);
                    usuario.setNombre(cursor.getString(nombreIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_APELLIDO) != -1) {
                    apellidoIndice = cursor.getColumnIndexOrThrow(COLUMNA_APELLIDO);
                    usuario.setApellido(cursor.getString(apellidoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_USUARIO) != -1) {
                    usuarioIndex = cursor.getColumnIndexOrThrow(COLUMNA_USUARIO);
                    usuario.setApellido(cursor.getString(usuarioIndex));
                }
                if (cursor.getColumnIndex(COLUMNA_PASS) != -1) {
                    passIndex = cursor.getColumnIndexOrThrow(COLUMNA_PASS);
                    usuario.setApellido(cursor.getString(passIndex));
                }
                if (cursor.getColumnIndex(COLUMNA_TELEFONO) != -1) {
                    telefonoIndice = cursor.getColumnIndexOrThrow(COLUMNA_TELEFONO);
                    usuario.setApellido(cursor.getString(telefonoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_CORREO) != -1) {
                    correoIndice = cursor.getColumnIndexOrThrow(COLUMNA_CORREO);
                    usuario.setApellido(cursor.getString(correoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ROL) != -1) {
                    rolIndice = cursor.getColumnIndexOrThrow(COLUMNA_ROL);
                    usuario.setApellido(cursor.getString(rolIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_FECHA_CREADO) != -1) {
                    fechaIngresoIndex = cursor.getColumnIndexOrThrow(COLUMNA_FECHA_CREADO);
                    usuario.setFechaCreado(new Date(cursor.getLong(fechaIngresoIndex)));
                }
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return usuario;
    }

    @Override
    public Usuario obtenerUsuarioPorId(int idUsuario) {
        Usuario usuario = new Usuario();
        try{
            final String selectionArgs[] = { String.valueOf(idUsuario) };
            final String selection = idUsuario + " = ?";
            cursor = super.query(TABLA_USUARIO, COLUMNAS_USUARIO, selection,
                    selectionArgs, COLUMNA_ID_USUARIO);
            if (cursor != null) {
                cursor.moveToFirst();
                while (!cursor.isAfterLast()) {
                    usuario = cursorToEntity(cursor);
                    cursor.moveToNext();
                }
                cursor.close();
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return usuario;
    }

    @Override
    public List<Usuario> obtenerListadoDeUsuarios() {
        List<Usuario> resultado = new ArrayList<Usuario>();
        try {
            cursor = super.query(TABLA_USUARIO, COLUMNAS_USUARIO, null,
                    null, COLUMNA_ID_USUARIO);

            if (cursor != null) {
                cursor.moveToFirst();
                while (!cursor.isAfterLast()) {
                    Usuario usuario = cursorToEntity(cursor);
                    resultado.add(usuario);
                    cursor.moveToNext();
                }
                cursor.close();
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public boolean editarUsuario(Usuario usuario) {
        boolean resultado = false;
        try {
            setContentValue(usuario);
            try {
                resultado = super.update(TABLA_USUARIO, getContentValue(), COLUMNA_ID_USUARIO + " = ? ",
                        new String[] {String.valueOf(usuario.getIdUsuario())}) > 0;
            } catch (SQLiteConstraintException ex){
                ErrorHelper.control(ex, NOMBRE_CLASE);
                return false;
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public boolean agregarUsuario(Usuario usuario) {
        boolean resultado = false;
        try {
            setContentValue(usuario);
            try {
                resultado = super.insert(TABLA_USUARIO, getContentValue()) > 0;
            } catch (SQLiteConstraintException ex){
                ErrorHelper.control(ex, NOMBRE_CLASE);
                return false;
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public boolean eliminarUsuario(Usuario usuario) {
        boolean resultado = false;
        try {
            setContentValue(usuario);
            try {
                resultado = super.delete(TABLA_USUARIO, COLUMNA_ID_USUARIO + " = ? ",
                        new String[] {String.valueOf(usuario.getIdUsuario())}) > 0;
            } catch (SQLiteConstraintException ex){
                ErrorHelper.control(ex, NOMBRE_CLASE);
                return false;
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public boolean agregarUsuarios(List<Usuario> usuarios) {
        boolean resultado = false;
        try {
            for (Usuario usuario: usuarios) {
                setContentValue(usuario);
                try {
                    resultado = super.insert(TABLA_USUARIO, getContentValue()) > 0;
                } catch (SQLiteConstraintException ex){
                    ErrorHelper.control(ex, NOMBRE_CLASE);
                    return false;
                }
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public boolean eliminarTodosLosUsuarios() {
        boolean resultado = false;
        try {
            for (Usuario usuario:obtenerListadoDeUsuarios()) {
                setContentValue(usuario);
                try {
                    resultado = super.delete(TABLA_USUARIO, COLUMNA_ID_USUARIO + " = ? ",
                            new String[] {String.valueOf(usuario.getIdUsuario())}) > 0;
                } catch (SQLiteConstraintException ex){
                    ErrorHelper.control(ex, NOMBRE_CLASE);
                    return false;
                }
            }

        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    public ContentValues getContentValue() { return initialValues; }

    public void setContentValue(Usuario usuario) {
        initialValues = new ContentValues();
        initialValues.put(COLUMNA_ID_USUARIO, usuario.getIdUsuario());
        initialValues.put(COLUMNA_NOMBRE, usuario.getNombre());
        initialValues.put(COLUMNA_APELLIDO, usuario.getApellido());
        initialValues.put(COLUMNA_CORREO, usuario.getCorreo());
        initialValues.put(COLUMNA_TELEFONO, usuario.getTelefono());
        initialValues.put(COLUMNA_ROL, usuario.getRol());
        initialValues.put(COLUMNA_FECHA_CREADO, usuario.getFechaCreado().getTime());
        initialValues.put(COLUMNA_PASS, usuario.getPass());
        initialValues.put(COLUMNA_USUARIO, usuario.getUsuario());
    }
}
