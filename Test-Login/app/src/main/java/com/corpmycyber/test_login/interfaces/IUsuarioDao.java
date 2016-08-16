package com.corpmycyber.test_login.interfaces;

import com.corpmycyber.test_login.bean.Usuario;

import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IUsuarioDao {

    Usuario obtenerUsuarioPorId(int idUsuario);
    List<Usuario> obtenerListadoDeUsuarios();

    boolean editarUsuario(Usuario usuario);
    boolean agregarUsuario(Usuario usuario);
    boolean eliminarUsuario(Usuario usuario);
    boolean agregarUsuarios(List<Usuario> usuarios);
    boolean eliminarTodosLosUsuarios();

}
