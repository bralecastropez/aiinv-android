package com.corpmycyber.test_login.dao;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteConstraintException;
import android.database.sqlite.SQLiteDatabase;

import com.corpmycyber.test_login.bean.Pago;
import com.corpmycyber.test_login.helper.DbContentProvider;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.interfaces.IPagoDao;
import com.corpmycyber.test_login.schema.IPagoSchema;

import java.util.ArrayList;
import java.util.Date;
import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class PagoDaoImplement extends DbContentProvider implements IPagoDao, IPagoSchema {

    private static final String NOMBRE_CLASE = UsuarioDaoImplement.class.getSimpleName();
    private Cursor cursor;
    private ContentValues initialValues;

    public PagoDaoImplement(SQLiteDatabase db) { super(db); }

    @Override
    protected Pago cursorToEntity(Cursor cursor) {
        Pago resultado = new Pago();
        try {
            int idPagoIndice;
            int idClienteIndice;
            int idPrestamoIndice;
            int idUsuarioIndice;
            int noPagoIndice;
            int fechaPagoIndice;
            int bancoIndice;
            int cantidadPagadaIndice;
            int referenciaIndice;
            int noTarjetaIndice;
            int noTransferenciaIndice;
            int autorizacionIndice;
            int tipoPagoIndice;
            int estadoIndice;
            if (cursor != null) {
                if (cursor.getColumnIndex(COLUMNA_ID_PAGO) != -1) {
                    idPagoIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_PAGO);
                    resultado.setIdPago(cursor.getInt(idPagoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ID_CLIENTE) != -1) {
                    idClienteIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_CLIENTE);
                    resultado.setIdCliente(cursor.getInt(idClienteIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ID_PRESTAMO) != -1) {
                    idPrestamoIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_PRESTAMO);
                    resultado.setIdPrestamo(cursor.getInt(idPrestamoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ID_USUARIO) != -1) {
                    idUsuarioIndice = cursor.getColumnIndexOrThrow(COLUMNA_ID_USUARIO);
                    resultado.setIdUsuario(cursor.getInt(idUsuarioIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_NO_PAGO) != -1) {
                    noPagoIndice = cursor.getColumnIndexOrThrow(COLUMNA_NO_PAGO);
                    resultado.setNoPago(cursor.getInt(noPagoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_FECHA_PAGO) != -1) {
                    fechaPagoIndice = cursor.getColumnIndexOrThrow(COLUMNA_FECHA_PAGO);
                    resultado.setFechaPago(new Date(cursor.getLong(fechaPagoIndice)));
                }
                if (cursor.getColumnIndex(COLUMNA_BANCO) != -1) {
                    bancoIndice = cursor.getColumnIndexOrThrow(COLUMNA_BANCO);
                    resultado.setBanco(cursor.getString(bancoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_CANTIDAD_PAGADA) != -1) {
                    cantidadPagadaIndice = cursor.getColumnIndexOrThrow(COLUMNA_CANTIDAD_PAGADA);
                    resultado.setCantidadPagada(cursor.getDouble(cantidadPagadaIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_REFERENCIA) != -1) {
                    referenciaIndice = cursor.getColumnIndexOrThrow(COLUMNA_REFERENCIA);
                    resultado.setReferencia(cursor.getString(referenciaIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_NO_TARJETA) != -1) {
                    noTarjetaIndice = cursor.getColumnIndexOrThrow(COLUMNA_NO_TARJETA);
                    resultado.setNoTarjeta(cursor.getString(noTarjetaIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_NO_TRANSFERENCIA) != -1) {
                    noTransferenciaIndice = cursor.getColumnIndexOrThrow(COLUMNA_NO_TRANSFERENCIA);
                    resultado.setNoTransferencia(cursor.getString(noTransferenciaIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_AUTORIZACION) != -1) {
                    autorizacionIndice = cursor.getColumnIndexOrThrow(COLUMNA_AUTORIZACION);
                    resultado.setAutorizacion(cursor.getString(autorizacionIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_TIPO_PAGO) != -1) {
                    tipoPagoIndice = cursor.getColumnIndexOrThrow(COLUMNA_TIPO_PAGO);
                    resultado.setTipoPago(cursor.getString(tipoPagoIndice));
                }
                if (cursor.getColumnIndex(COLUMNA_ESTADO) != -1) {
                    estadoIndice = cursor.getColumnIndexOrThrow(COLUMNA_ESTADO);
                    resultado.setEstado(cursor.getString(estadoIndice));
                }

            }
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return resultado;
    }

    @Override
    public Pago obtenerPagoPorId(int idPago) {
        Pago resultado = new Pago();
        try{
            final String selectionArgs[] = { String.valueOf(idPago) };
            final String selection = idPago+ " = ?";
            cursor = super.query(TABLA_PAGO,COLUMNAS_PAGO, selection,
                    selectionArgs, COLUMNA_ID_PAGO);
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
    public List<Pago> obtenerListadoDePagos() {
        List<Pago> resultado = new ArrayList<>();
        try {
            cursor = super.query(TABLA_PAGO, COLUMNAS_PAGO, null,
                    null, COLUMNA_ID_PAGO);

            if (cursor != null) {
                cursor.moveToFirst();
                while (!cursor.isAfterLast()) {
                    Pago  pago = cursorToEntity(cursor);
                    resultado.add(pago);
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
    public boolean agregarPagos(List<Pago> pagos) {
        boolean resultado = false;
        try {
            for (Pago pago: pagos) {
                setContentValue(pago);
                try {
                    resultado = super.insert(TABLA_PAGO, getContentValue()) > 0;
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
    public boolean editarPago(Pago pago) {
        boolean resultado = false;
        try {
            setContentValue(pago);
            try {
                resultado = super.update(TABLA_PAGO, getContentValue(), COLUMNA_ID_PAGO + " = ? ",
                        new String[] {String.valueOf(pago.getIdPago())}) > 0;
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
    public boolean agregarPago(Pago pago) {
        boolean resultado = false;
        try {
            setContentValue(pago);
            try {
                resultado = super.insert(TABLA_PAGO, getContentValue()) > 0;
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
    public boolean eliminarPago(Pago pago) {
        boolean resultado = false;
        try {
            setContentValue(pago);
            try {
                resultado = super.delete(TABLA_PAGO, COLUMNA_ID_PAGO + " = ? ",
                        new String[] {String.valueOf(pago.getIdPago())}) > 0;
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

    public void setContentValue(Pago pago) {
        initialValues = new ContentValues();
        initialValues.put(COLUMNA_ID_PAGO, pago.getIdPago());
        initialValues.put(COLUMNA_ID_PRESTAMO, pago.getIdPrestamo());
        initialValues.put(COLUMNA_ID_CLIENTE, pago.getIdCliente());
        initialValues.put(COLUMNA_ID_USUARIO, pago.getIdUsuario());
        initialValues.put(COLUMNA_NO_PAGO, pago.getNoPago());
        initialValues.put(COLUMNA_FECHA_PAGO, pago.getFechaPago().toString());
        initialValues.put(COLUMNA_BANCO, pago.getBanco());
        initialValues.put(COLUMNA_CANTIDAD_PAGADA, pago.getCantidadPagada());
        initialValues.put(COLUMNA_REFERENCIA, pago.getReferencia());
        initialValues.put(COLUMNA_NO_TARJETA, pago.getNoTarjeta());
        initialValues.put(COLUMNA_NO_TRANSFERENCIA, pago.getNoTransferencia());
        initialValues.put(COLUMNA_AUTORIZACION, pago.getAutorizacion());
        initialValues.put(COLUMNA_TIPO_PAGO, pago.getTipoPago());
        initialValues.put(COLUMNA_ESTADO, pago.getEstado());
    }
}
