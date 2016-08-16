package com.corpmycyber.test_login.interfaces;

import com.corpmycyber.test_login.bean.Prestamo;

import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IPrestamoDao {

    Prestamo obtenerPrestamoPorId(int idPrestamo);
    List<Prestamo> obtenerListadoDePrestamos();
    List<Prestamo> obtenerListadoDePrestamos(Integer idCliente);
    boolean agregarPrestamos(List<Prestamo> Prestamos);

    boolean editarPrestamo(Prestamo Prestamo);
    boolean agregarPrestamo(Prestamo Prestamo);
    boolean eliminarPrestamo(Prestamo Prestamo);
    
}
