package com.corpmycyber.test_login.bean;

import com.corpmycyber.test_login.helper.ErrorHelper;

import java.io.Serializable;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class Grupo implements Serializable {

    private static final String TAG = Grupo.class.getSimpleName();
    private Integer idGrupo;
    private String nombre;
    private String descripcion;

    public Integer getIdGrupo() {
        return idGrupo;
    }

    public void setIdGrupo(Integer idGrupo) {
        this.idGrupo = idGrupo;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getDescripcion() {
        return descripcion;
    }

    public void setDescripcion(String descripcion) {
        this.descripcion = descripcion;
    }

    public Grupo(){}

    public Grupo(Integer idGrupo, String nombre, String descripcion) {
        this.idGrupo = idGrupo;
        this.nombre = nombre;
        this.descripcion = descripcion;
    }

    public String toString(){
        String resultado = "";
        try {
            resultado = getNombre() + " - " + getDescripcion();
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }
}
