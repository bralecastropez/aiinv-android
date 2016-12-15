package com.corpmycyber.test_login.bean;

import java.io.Serializable;
import java.util.Date;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class Prestamo implements Serializable {

    private Integer idPrestamo;
    private Integer idUsuario;
    private Integer idCliente;
    private Integer idGrupo;
    private Date fechaInicio;
    private Date fechaFin;
    private String condicion;
    private Double monto;
    private Double montoPagado;
    private Double montoPendiente;
    private Double montoParcial;
    private String estado;
    private String formaPago;
    private Integer plazo;
    private Double interes;
    private Integer noPagos;

    public Integer getIdPrestamo() {
        return idPrestamo;
    }

    public void setIdPrestamo(Integer idPrestamo) {
        this.idPrestamo = idPrestamo;
    }

    public Integer getIdUsuario() {
        return idUsuario;
    }

    public void setIdUsuario(Integer idUsuario) {
        this.idUsuario = idUsuario;
    }

    public Integer getIdCliente() {
        return idCliente;
    }

    public void setIdCliente(Integer idCliente) {
        this.idCliente = idCliente;
    }

    public Integer getIdGrupo() {
        return idGrupo;
    }

    public void setIdGrupo(Integer idGrupo) {
        this.idGrupo = idGrupo;
    }

    public Date getFechaInicio() {
        return fechaInicio;
    }

    public void setFechaInicio(Date fechaInicio) {
        this.fechaInicio = fechaInicio;
    }

    public Date getFechaFin() {
        return fechaFin;
    }

    public void setFechaFin(Date fechaFin) {
        this.fechaFin = fechaFin;
    }

    public String getCondicion() {
        return condicion;
    }

    public void setCondicion(String condicion) {
        this.condicion = condicion;
    }

    public Double getMonto() {
        return monto;
    }

    public void setMonto(Double monto) {
        this.monto = monto;
    }

    public Double getMontoPagado() {
        return montoPagado;
    }

    public void setMontoPagado(Double montoPagado) {
        this.montoPagado = montoPagado;
    }

    public Double getMontoPendiente() {
        return montoPendiente;
    }

    public void setMontoPendiente(Double montoPendiente) {
        this.montoPendiente = montoPendiente;
    }

    public Double getMontoParcial() {
        return montoParcial;
    }

    public void setMontoParcial(Double montoParcial) {
        this.montoParcial = montoParcial;
    }

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }

    public String getFormaPago() {
        return formaPago;
    }

    public void setFormaPago(String formaPago) {
        this.formaPago = formaPago;
    }

    public Integer getPlazo() {
        return plazo;
    }

    public void setPlazo(Integer plazo) {
        this.plazo = plazo;
    }

    public Integer getNoPagos() {
        return noPagos;
    }

    public void setNoPagos(Integer noPagos) {
        this.noPagos = noPagos;
    }

    public Double getInteres() {
        return interes;
    }

    public void setInteres(Double interes) {
        this.interes = interes;
    }

    public Prestamo() {
    }

    public Prestamo(Integer idPrestamo, Integer idUsuario, Integer idCliente, Integer idGrupo, Date fechaInicio, Date fechaFin, String condicion, Double monto, Double montoPagado, Double montoPendiente, Double montoParcial, String estado, String formaPago, Integer plazo, Double interes, Integer noPagos) {
        this.idPrestamo = idPrestamo;
        this.idUsuario = idUsuario;
        this.idCliente = idCliente;
        this.idGrupo = idGrupo;
        this.fechaInicio = fechaInicio;
        this.fechaFin = fechaFin;
        this.condicion = condicion;
        this.monto = monto;
        this.montoPagado = montoPagado;
        this.montoPendiente = montoPendiente;
        this.montoParcial = montoParcial;
        this.estado = estado;
        this.formaPago = formaPago;
        this.plazo = plazo;
        this.interes = interes;
        this.noPagos = noPagos;
    }


}
