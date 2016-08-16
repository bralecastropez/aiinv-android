package com.corpmycyber.test_login.interfaces;

import com.corpmycyber.test_login.bean.Pago;

import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IPagoDao {

    Pago obtenerPagoPorId(int idPago);
    List<Pago> obtenerListadoDePagos();
    boolean agregarPagos(List<Pago> clientes);

    boolean editarPago(Pago cliente);
    boolean agregarPago(Pago cliente);
    boolean eliminarPago(Pago cliente);

}
