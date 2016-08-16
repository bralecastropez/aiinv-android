package com.corpmycyber.test_login.dao;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteConstraintException;
import android.database.sqlite.SQLiteDatabase;

import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.helper.DbContentProvider;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.interfaces.IClienteDao;
import com.corpmycyber.test_login.schema.IClienteSchema;

import java.util.ArrayList;
import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class ClienteDaoImplement extends DbContentProvider implements IClienteDao, IClienteSchema {

    private static final String NOMBRE_CLASE = UsuarioDaoImplement.class.getSimpleName();
    private Cursor cursor;
    private ContentValues initialValues;

    public ClienteDaoImplement(SQLiteDatabase db) {
        super(db);
    }

    @Override
    protected Cliente cursorToEntity(Cursor cursor) {
        Cliente resultado = new Cliente();
        try {
            int idClienteIndice;
            int idGrupoIndice;
            int nombreIndice;
            int apellidoIndice;
            int correoIndice;
            int telefonoIndice;
            int direccionIndice;
            int comentarioIndice;
            int tipoIndice;
            if (cursor != null) {
                if (cursor.getColumnIndex(COLUMNA_ID_CLIENTE) != -1) {
                    idClienteIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_CLIENTE);
                    resultado.setIdCliente(cursor.getInt(idClienteIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ID_GRUPO) != -1) {
                    idGrupoIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_GRUPO);
                    resultado.setIdGrupo(cursor.getInt(idGrupoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_NOMBRE) != -1) {
                    nombreIndice = cursor.getColumnIndexOrThrow(COLUMNA_NOMBRE);
                    resultado.setNombre(cursor.getString(nombreIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_APELLIDO) != -1) {
                    apellidoIndice = cursor.getColumnIndexOrThrow(COLUMNA_APELLIDO);
                    resultado.setApellido(cursor.getString(apellidoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_CORREO) != -1) {
                    correoIndice = cursor.getColumnIndexOrThrow(COLUMNA_CORREO);
                    resultado.setCorreo(cursor.getString(correoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_TELEFONO) != -1) {
                    telefonoIndice = cursor.getColumnIndexOrThrow(COLUMNA_TELEFONO);
                    resultado.setTelefono(cursor.getString(telefonoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_DIRECCION) != -1) {
                    direccionIndice = cursor.getColumnIndexOrThrow(COLUMNA_DIRECCION);
                    resultado.setDireccion(cursor.getString(direccionIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_COMENTARIO) != -1) {
                    comentarioIndice = cursor.getColumnIndexOrThrow(COLUMNA_COMENTARIO);
                    resultado.setComentario(cursor.getString(comentarioIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_TIPO) != -1) {
                    tipoIndice = cursor.getColumnIndexOrThrow(COLUMNA_TIPO);
                    resultado.setTipo(cursor.getString(tipoIndice));
                }
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public Cliente obtenerClientePorId(int idCliente) {
        Cliente resultado = new Cliente();
        try{
            final String selectionArgs[] = { String.valueOf(idCliente) };
            final String selection = idCliente+ " = ?";
            cursor = super.query(TABLA_CLIENTE,COLUMNAS_CLIENTE, selection,
                    selectionArgs, COLUMNA_ID_CLIENTE);
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
    public List<Cliente> obtenerListadoDeClientes() {
        List<Cliente> resultado = new ArrayList<>();
        try {
            cursor = super.query(TABLA_CLIENTE, COLUMNAS_CLIENTE, null,
                    null, COLUMNA_ID_CLIENTE);

            if (cursor != null) {
                cursor.moveToFirst();
                while (!cursor.isAfterLast()) {
                    Cliente  cliente = cursorToEntity(cursor);
                    resultado.add(cliente);
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
    public boolean agregarClientes(List<Cliente> clientes) {
        boolean resultado = false;
        try {
            for (Cliente cliente: clientes) {
                setContentValue(cliente);
                try {
                    resultado = super.insert(TABLA_CLIENTE, getContentValue()) > 0;
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
    public boolean editarCliente(Cliente cliente) {
        boolean resultado = false;
        try {
            setContentValue(cliente);
            try {
                resultado = super.update(TABLA_CLIENTE, getContentValue(), COLUMNA_ID_CLIENTE + " = ? ",
                        new String[] {String.valueOf(cliente.getIdCliente())}) > 0;
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
    public boolean agregarCliente(Cliente cliente) {
        boolean resultado = false;
        try {
            setContentValue(cliente);
            try {
                resultado = super.insert(TABLA_CLIENTE, getContentValue()) > 0;
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
    public boolean eliminarCliente(Cliente cliente) {
        boolean resultado = false;
        try {
            setContentValue(cliente);
            try {
                resultado = super.delete(TABLA_CLIENTE, COLUMNA_ID_CLIENTE + " = ? ",
                        new String[] {String.valueOf(cliente.getIdCliente())}) > 0;
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

    public void setContentValue(Cliente cliente) {
        initialValues = new ContentValues();
        initialValues.put(COLUMNA_ID_CLIENTE, cliente.getIdCliente());
        initialValues.put(COLUMNA_NOMBRE, cliente.getNombre());
        initialValues.put(COLUMNA_APELLIDO, cliente.getApellido());
        initialValues.put(COLUMNA_CORREO, cliente.getCorreo());
        initialValues.put(COLUMNA_TELEFONO, cliente.getTelefono());
        initialValues.put(COLUMNA_DIRECCION, cliente.getDireccion());
        initialValues.put(COLUMNA_TIPO, cliente.getTipo());
        initialValues.put(COLUMNA_COMENTARIO, cliente.getComentario());
    }
}
