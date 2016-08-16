package com.corpmycyber.test_login.interfaces;

import com.corpmycyber.test_login.bean.Usuario;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface LoginDao {

    Usuario verificarUsuario(String usuario, String pass);
}
