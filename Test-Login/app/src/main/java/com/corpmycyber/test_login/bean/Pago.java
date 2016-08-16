package com.corpmycyber.test_login.bean;

import java.io.Serializable;
import java.util.Date;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class Pago implements Serializable {

    private Integer idPago;
    private Integer idCliente;
    private Integer idPrestamo;
    private Integer idUsuario;
    private Integer noPago;
    private Date fechaPago;
    private String banco;
    private Double cantidadPagada;
    private String referencia;
    private String noTarjeta;
    private String noTransferencia;
    private String autorizacion;
    private String tipoPago;
    private String estado;

    public Integer getIdPago() {
        return idPago;
    }

    public void setIdPago(Integer idPago) {
        this.idPago = idPago;
    }

    public Integer getIdCliente() {
        return idCliente;
    }

    public void setIdCliente(Integer idCliente) {
        this.idCliente = idCliente;
    }

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

    public Integer getNoPago() {
        return noPago;
    }

    public void setNoPago(Integer noPago) {
        this.noPago = noPago;
    }

    public Date getFechaPago() {
        return fechaPago;
    }

    public void setFechaPago(Date fechaPago) {
        this.fechaPago = fechaPago;
    }

    public String getBanco() {
        return banco;
    }

    public void setBanco(String banco) {
        this.banco = banco;
    }

    public Double getCantidadPagada() {
        return cantidadPagada;
    }

    public void setCantidadPagada(Double cantidadPagada) {
        this.cantidadPagada = cantidadPagada;
    }

    public String getReferencia() {
        return referencia;
    }

    public void setReferencia(String referencia) {
        this.referencia = referencia;
    }

    public String getNoTarjeta() {
        return noTarjeta;
    }

    public void setNoTarjeta(String noTarjeta) {
        this.noTarjeta = noTarjeta;
    }

    public String getNoTransferencia() {
        return noTransferencia;
    }

    public void setNoTransferencia(String noTransferencia) {
        this.noTransferencia = noTransferencia;
    }

    public String getAutorizacion() {
        return autorizacion;
    }

    public void setAutorizacion(String autorizacion) {
        this.autorizacion = autorizacion;
    }

    public String getTipoPago() {
        return tipoPago;
    }

    public void setTipoPago(String tipoPago) {
        this.tipoPago = tipoPago;
    }

    public String getEstado() {
        return estado;
    }

    public void setEstado(String estado) {
        this.estado = estado;
    }

    public Pago(){}

    public Pago(Integer idPago, Integer idCliente, Integer idPrestamo, Integer idUsuario, Integer noPago, Date fechaPago, String banco, Double cantidadPagada, String referencia, String noTarjeta, String noTransferencia, String autorizacion, String tipoPago, String estado) {
        this.idPago = idPago;
        this.idCliente = idCliente;
        this.idPrestamo = idPrestamo;
        this.idUsuario = idUsuario;
        this.noPago = noPago;
        this.fechaPago = fechaPago;
        this.banco = banco;
        this.cantidadPagada = cantidadPagada;
        this.referencia = referencia;
        this.noTarjeta = noTarjeta;
        this.noTransferencia = noTransferencia;
        this.autorizacion = autorizacion;
        this.tipoPago = tipoPago;
        this.estado = estado;
    }
}
