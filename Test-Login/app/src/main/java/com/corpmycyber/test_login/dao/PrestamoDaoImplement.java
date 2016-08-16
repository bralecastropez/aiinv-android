package com.corpmycyber.test_login.dao;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteConstraintException;
import android.database.sqlite.SQLiteDatabase;
import android.util.Log;

import com.corpmycyber.test_login.bean.Prestamo;
import com.corpmycyber.test_login.helper.DbContentProvider;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.interfaces.IPrestamoDao;
import com.corpmycyber.test_login.schema.IPrestamoSchema;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class PrestamoDaoImplement extends DbContentProvider implements IPrestamoDao, IPrestamoSchema {

    private static final String NOMBRE_CLASE = UsuarioDaoImplement.class.getSimpleName();
    private Cursor cursor;
    private ContentValues initialValues;

    public PrestamoDaoImplement(SQLiteDatabase db) { super(db); }

    @Override
    protected Prestamo cursorToEntity(Cursor cursor) {
        Prestamo resultado = new Prestamo();
        try {
            int idPrestamoIndice;
            int idUsuarioIndice;
            int idClienteIndice;
            int idGrupoIndice;
            int fechaInicioIndice;
            int fechaFinIndice;
            int condicionIndice;
            int montoIndice;
            int montoPagadoIndice;
            int montoPendienteIndice;
            int montoParcialIndice;
            int estadoIndice;
            int formaPagoIndice;
            int plazoIndice;
            int noPagosIndice;
            int interesIndice;
            if (cursor != null) {
                if (cursor.getColumnIndex(COLUMNA_ID_PRESTAMO) != -1) {
                    idPrestamoIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_PRESTAMO);
                    resultado.setIdPrestamo(cursor.getInt(idPrestamoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ID_GRUPO) != -1) {
                    idGrupoIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_GRUPO);
                    resultado.setIdGrupo(cursor.getInt(idGrupoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ID_CLIENTE) != -1) {
                    idClienteIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_CLIENTE);
                    resultado.setIdCliente(cursor.getInt(idClienteIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ID_USUARIO) != -1) {
                    idUsuarioIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_USUARIO);
                    resultado.setIdUsuario(cursor.getInt(idUsuarioIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_FECHA_INICIO) != -1) {
                    fechaInicioIndice = cursor.getColumnIndexOrThrow(COLUMNA_FECHA_INICIO);
                    resultado.setFechaInicio(new Date(cursor.getLong(fechaInicioIndice)));
                }
                if (cursor.getColumnIndex(COLUMNA_FECHA_FIN) != -1) {
                    fechaFinIndice = cursor.getColumnIndexOrThrow(COLUMNA_FECHA_FIN);
                    resultado.setFechaFin(new Date(cursor.getLong(fechaFinIndice)));
                }
                if (cursor.getColumnIndex(COLUMNA_CONDICION) != -1) {
                    condicionIndice = cursor.getColumnIndexOrThrow(COLUMNA_CONDICION);
                    resultado.setCondicion(cursor.getString(condicionIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_MONTO) != -1) {
                    montoIndice = cursor.getColumnIndexOrThrow(COLUMNA_MONTO);
                    resultado.setMonto(cursor.getDouble(montoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_INTERES) != -1) {
                    interesIndice = cursor.getColumnIndexOrThrow(COLUMNA_INTERES);
                    resultado.setInteres(cursor.getDouble(interesIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_MONTO_PAGADO) != -1) {
                    montoPagadoIndice = cursor.getColumnIndexOrThrow(COLUMNA_MONTO_PAGADO);
                    resultado.setMontoPagado(cursor.getDouble(montoPagadoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_MONTO_PARCIAL) != -1) {
                    montoParcialIndice = cursor.getColumnIndexOrThrow(COLUMNA_MONTO_PARCIAL);
                    resultado.setMontoParcial(cursor.getDouble(montoParcialIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_MONTO_PENDIENTE) != -1) {
                    montoPendienteIndice = cursor.getColumnIndexOrThrow(COLUMNA_MONTO_PENDIENTE);
                    resultado.setMontoPendiente(cursor.getDouble(montoPendienteIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ESTADO) != -1) {
                    estadoIndice = cursor.getColumnIndexOrThrow(COLUMNA_ESTADO);
                    resultado.setEstado(cursor.getString(estadoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_FORMA_PAGO) != -1) {
                    formaPagoIndice = cursor.getColumnIndexOrThrow(COLUMNA_FORMA_PAGO);
                    resultado.setFormaPago(cursor.getString(formaPagoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_PLAZO) != -1) {
                    plazoIndice = cursor.getColumnIndexOrThrow(COLUMNA_PLAZO);
                    resultado.setPlazo(cursor.getInt(plazoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_NO_PAGOS) != -1) {
                    noPagosIndice = cursor.getColumnIndexOrThrow(COLUMNA_NO_PAGOS);
                    resultado.setNoPagos(cursor.getInt(noPagosIndice));
                }
            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public Prestamo obtenerPrestamoPorId(int idPrestamo) {
        Prestamo resultado = new Prestamo();
        try{
            final String selectionArgs[] = { String.valueOf(idPrestamo) };
            final String selection = idPrestamo + "=?";
            /*cursor = super.query(TABLA_PRESTAMO, COLUMNAS_PRESTAMO, selection,
                    selectionArgs, COLUMNA_ID_PRESTAMO);*/
            cursor = super.query(TABLA_PRESTAMO, COLUMNAS_PRESTAMO, selection, selectionArgs, null, null, null, null);
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
    public List<Prestamo> obtenerListadoDePrestamos() {
        List<Prestamo> resultado = new ArrayList<>();
        try {
            cursor = super.query(TABLA_PRESTAMO, COLUMNAS_PRESTAMO, null,
                    null, COLUMNA_ID_PRESTAMO);

            if (cursor != null) {
                cursor.moveToFirst();
                while (!cursor.isAfterLast()) {
                    Prestamo  Prestamo = cursorToEntity(cursor);
                    resultado.add(Prestamo);
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
    public List<Prestamo> obtenerListadoDePrestamos(Integer idCliente) {
        List<Prestamo> resultado = new ArrayList<>();
        try {
            String selectQuery = "SELECT  * FROM " + TABLA_PRESTAMO + " WHERE " + COLUMNA_ID_CLIENTE + " = " + idCliente ;
            Log.e("CONSULTA_PRESTAMOS", selectQuery);
            Cursor c = super.rawQuery(selectQuery, null);
            if (c.moveToFirst()) {
                do {
                    Prestamo prestamo = new Prestamo();
                    prestamo.setIdPrestamo(c.getInt(c.getColumnIndex(COLUMNA_ID_PRESTAMO)));
                    prestamo.setIdGrupo(c.getInt(c.getColumnIndex(COLUMNA_ID_GRUPO)));
                    prestamo.setIdCliente(c.getInt(c.getColumnIndex(COLUMNA_ID_CLIENTE)));
                    prestamo.setIdUsuario(c.getInt(c.getColumnIndex(COLUMNA_ID_USUARIO)));
                    prestamo.setFechaInicio(new Date(c.getLong(c.getColumnIndex(COLUMNA_FECHA_INICIO))));
                    prestamo.setCondicion(c.getString(c.getColumnIndex(COLUMNA_CONDICION)));
                    prestamo.setMonto(c.getDouble(c.getColumnIndex(COLUMNA_MONTO)));
                    prestamo.setMontoPagado(c.getDouble(c.getColumnIndex(COLUMNA_MONTO_PAGADO)));
                    prestamo.setMontoParcial(c.getDouble(c.getColumnIndex(COLUMNA_MONTO_PARCIAL)));
                    prestamo.setMontoPendiente(c.getDouble(c.getColumnIndex(COLUMNA_MONTO_PENDIENTE)));
                    prestamo.setEstado(c.getString(c.getColumnIndex(COLUMNA_ESTADO)));
                    prestamo.setFechaFin(new Date(c.getLong(c.getColumnIndex(COLUMNA_FECHA_FIN))));
                    prestamo.setFormaPago(c.getString(c.getColumnIndex(COLUMNA_FORMA_PAGO)));
                    prestamo.setPlazo(c.getInt(c.getColumnIndex(COLUMNA_PLAZO)));
                    prestamo.setNoPagos(c.getInt(c.getColumnIndex(COLUMNA_NO_PAGOS)));
                    prestamo.setInteres(c.getDouble(c.getColumnIndex(COLUMNA_INTERES)));
                    resultado.add(prestamo);
                } while (c.moveToNext());
            }
            Log.wtf("LISTADO_DE_USUARIOS ", String.valueOf(resultado.size()));
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public boolean agregarPrestamos(List<Prestamo> prestamos) {
        boolean resultado = false;
        try {
            for (Prestamo prestamo: prestamos) {
                setContentValue(prestamo);
                try {
                    resultado = super.insert(TABLA_PRESTAMO, getContentValue()) > 0;
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
    public boolean editarPrestamo(Prestamo prestamo) {
        boolean resultado = false;
        try {
            setContentValue(prestamo);
            try {
                resultado = super.update(TABLA_PRESTAMO, getContentValue(), COLUMNA_ID_PRESTAMO + " = ? ",
                        new String[] {String.valueOf(prestamo.getIdPrestamo())}) > 0;
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
    public boolean agregarPrestamo(Prestamo prestamo) {
        boolean resultado = false;
        try {
            setContentValue(prestamo);
            try {
                resultado = super.insert(TABLA_PRESTAMO, getContentValue()) > 0;
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
    public boolean eliminarPrestamo(Prestamo prestamo) {
        boolean resultado = false;
        try {
            setContentValue(prestamo);
            try {
                resultado = super.delete(TABLA_PRESTAMO, COLUMNA_ID_PRESTAMO + " = ? ",
                        new String[] {String.valueOf(prestamo.getIdPrestamo())}) > 0;
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

    public void setContentValue(Prestamo prestamo) {
        initialValues = new ContentValues();
        initialValues.put(COLUMNA_ID_PRESTAMO, prestamo.getIdPrestamo());
        initialValues.put(COLUMNA_ID_USUARIO, prestamo.getIdUsuario());
        initialValues.put(COLUMNA_ID_CLIENTE, prestamo.getIdCliente());
        initialValues.put(COLUMNA_ID_GRUPO, prestamo.getIdGrupo());
        initialValues.put(COLUMNA_FECHA_INICIO, prestamo.getFechaInicio().toString());
        initialValues.put(COLUMNA_FECHA_FIN, prestamo.getFechaFin().toString());
        initialValues.put(COLUMNA_CONDICION, prestamo.getCondicion());
        initialValues.put(COLUMNA_MONTO, prestamo.getMonto());
        initialValues.put(COLUMNA_MONTO_PAGADO, prestamo.getMontoPagado());
        initialValues.put(COLUMNA_MONTO_PARCIAL, prestamo.getMontoParcial());
        initialValues.put(COLUMNA_MONTO_PENDIENTE, prestamo.getMontoPendiente());
        initialValues.put(COLUMNA_ESTADO, prestamo.getEstado());
        initialValues.put(COLUMNA_FORMA_PAGO, prestamo.getFormaPago());
        initialValues.put(COLUMNA_PLAZO, prestamo.getPlazo());
        initialValues.put(COLUMNA_NO_PAGOS, prestamo.getNoPagos());
        initialValues.put(COLUMNA_INTERES, prestamo.getInteres());
    }
}
