package com.corpmycyber.test_login.dao;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteConstraintException;
import android.database.sqlite.SQLiteDatabase;

import com.corpmycyber.test_login.bean.Grupo;
import com.corpmycyber.test_login.helper.DbContentProvider;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.interfaces.IGrupoDao;
import com.corpmycyber.test_login.schema.IGrupoSchema;

import java.util.ArrayList;
import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class GrupoDaoImplement extends DbContentProvider implements IGrupoDao, IGrupoSchema {

    private static final String NOMBRE_CLASE = UsuarioDaoImplement.class.getSimpleName();
    private Cursor cursor;
    private ContentValues initialValues;

    public GrupoDaoImplement(SQLiteDatabase db) {
        super(db);
    }

    @Override
    protected Grupo cursorToEntity(Cursor cursor) {
        Grupo resultado = new Grupo();
        try {
            int idGrupoIndice;
            int nombreIndice;
            int descripcionIndice;
            if (cursor != null) {
                if (cursor.getColumnIndex(COLUMNA_ID_GRUPO) != -1) {
                    idGrupoIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_GRUPO);
                    resultado.setIdGrupo(cursor.getInt(idGrupoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_NOMBRE) != -1) {
                    nombreIndice = cursor.getColumnIndexOrThrow(COLUMNA_NOMBRE);
                    resultado.setNombre(cursor.getString(nombreIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_DESCRIPCION) != -1) {
                    descripcionIndice = cursor.getColumnIndexOrThrow(COLUMNA_DESCRIPCION);
                    resultado.setDescripcion(cursor.getString(descripcionIndice));
                }
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public Grupo obtenerGrupoPorId(int idGrupo) {
        Grupo resultado = new Grupo();
        try{
            final String selectionArgs[] = { String.valueOf(idGrupo) };
            final String selection = idGrupo+ " = ?";
            cursor = super.query(TABLA_GRUPO, COLUMNAS_GRUPO, selection,
                    selectionArgs, COLUMNA_ID_GRUPO);
            if (cursor != null) {
                cursor.moveToFirst();
                while (!cursor.isAfterLast()) {
                    resultado = cursorToEntity(cursor);
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
    public List<Grupo> obtenerListadoDeGrupos() {
        List<Grupo> resultado = new ArrayList<>();
        try {
            cursor = super.query(TABLA_GRUPO, COLUMNAS_GRUPO, null,
                    null, COLUMNA_ID_GRUPO);

            if (cursor != null) {
                cursor.moveToFirst();
                while (!cursor.isAfterLast()) {
                    Grupo  Grupo = cursorToEntity(cursor);
                    resultado.add(Grupo);
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
    public boolean agregarGrupos(List<Grupo> Grupos) {
        boolean resultado = false;
        try {
            for (Grupo Grupo: Grupos) {
                setContentValue(Grupo);
                try {
                    resultado = super.insert(TABLA_GRUPO, getContentValue()) > 0;
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
    public boolean editarGrupo(Grupo Grupo) {
        boolean resultado = false;
        try {
            setContentValue(Grupo);
            try {
                resultado = super.update(TABLA_GRUPO, getContentValue(), COLUMNA_ID_GRUPO + " = ? ",
                        new String[] {String.valueOf(Grupo.getIdGrupo())}) > 0;
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
    public boolean agregarGrupo(Grupo Grupo) {
        boolean resultado = false;
        try {
            setContentValue(Grupo);
            try {
                resultado = super.insert(TABLA_GRUPO, getContentValue()) > 0;
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
    public boolean eliminarGrupo(Grupo Grupo) {
        boolean resultado = false;
        try {
            setContentValue(Grupo);
            try {
                resultado = super.delete(TABLA_GRUPO, COLUMNA_ID_GRUPO + " = ? ",
                        new String[] {String.valueOf(Grupo.getIdGrupo())}) > 0;
            } catch (SQLiteConstraintException ex){
                ErrorHelper.control(ex, NOMBRE_CLASE);
                return false;
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    public ContentValues getContentValue() { return initialValues; }

    public void setContentValue(Grupo Grupo) {
        initialValues = new ContentValues();
        initialValues.put(COLUMNA_ID_GRUPO, Grupo.getIdGrupo());
        initialValues.put(COLUMNA_NOMBRE, Grupo.getNombre());
        initialValues.put(COLUMNA_DESCRIPCION, Grupo.getDescripcion());
    }
}
