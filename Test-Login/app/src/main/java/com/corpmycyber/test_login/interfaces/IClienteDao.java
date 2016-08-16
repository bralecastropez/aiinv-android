package com.corpmycyber.test_login.interfaces;

import com.corpmycyber.test_login.bean.Cliente;

import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IClienteDao {

    Cliente obtenerClientePorId(int idCliente);
    List<Cliente> obtenerListadoDeClientes();
    boolean agregarClientes(List<Cliente> clientes);

    boolean editarCliente(Cliente cliente);
    boolean agregarCliente(Cliente cliente);
    boolean eliminarCliente(Cliente cliente);

}
