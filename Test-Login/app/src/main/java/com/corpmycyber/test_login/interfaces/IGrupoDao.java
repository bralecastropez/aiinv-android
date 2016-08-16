package com.corpmycyber.test_login.interfaces;

import com.corpmycyber.test_login.bean.Grupo;

import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IGrupoDao {

    Grupo obtenerGrupoPorId(int idGrupo);
    List<Grupo> obtenerListadoDeGrupos();
    boolean agregarGrupos(List<Grupo> Grupos);

    boolean editarGrupo(Grupo Grupo);
    boolean agregarGrupo(Grupo Grupo);
    boolean eliminarGrupo(Grupo Grupo);
}
