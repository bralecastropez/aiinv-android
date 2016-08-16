package com.corpmycyber.test_login.schema;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IPagoSchema {

    String TABLA_PAGO = "Pago";

    String COLUMNA_ID_PAGO = "Id_Pago";
    String COLUMNA_ID_CLIENTE = "Id_Cliente";
    String COLUMNA_ID_PRESTAMO = "Id_Prestamo";
    String COLUMNA_ID_USUARIO = "Id_Usuario";
    String COLUMNA_NO_PAGO = "No_Pago";
    String COLUMNA_FECHA_PAGO = "Fecha_Pago";
    String COLUMNA_ESTADO = "Estado";
    String COLUMNA_TIPO_PAGO = "Tipo_Pago";
    String COLUMNA_BANCO = "Banco";
    String COLUMNA_CANTIDAD_PAGADA = "Cantidad_Pagada";
    String COLUMNA_REFERENCIA = "Referencia";
    String COLUMNA_AUTORIZACION = "Autorizacion";
    String COLUMNA_NO_TARJETA = "No_Tarjeta";
    String COLUMNA_NO_TRANSFERENCIA = "No_Transferencia";

    String CREAR_TABLA_PAGO = "CREATE TABLE IF NOT EXISTS " + TABLA_PAGO + " (\n" +
            "\t" + COLUMNA_ID_PAGO + " INTEGER PRIMARY KEY AUTOINCREMENT,\n" +
            "\t" + COLUMNA_ID_CLIENTE + " INT REFERENCES Cliente (Id_Cliente) NOT NULL ,\n" +
            "\t" + COLUMNA_ID_PRESTAMO + " INT REFERENCES Prestamo (Id_Prestamo) NOT NULL,\n" +
            "\t" + COLUMNA_ID_USUARIO + " INT REFERENCES Usuario (Id_Usuario) NOT NULL,\n" +
            "\t" + COLUMNA_NO_PAGO + " INT NOT NULL,\n" +
            "\t" + COLUMNA_FECHA_PAGO + " DATE NOT NULL,\n" +
            "\t" + COLUMNA_ESTADO + " VARCHAR (20) NOT NULL,\n" +
            "\t" + COLUMNA_TIPO_PAGO + " VARCHAR (20) NOT NULL,\n" +
            "\t" + COLUMNA_BANCO + " VARCHAR (200) DEFAULT NULL,\n" +
            "\t" + COLUMNA_CANTIDAD_PAGADA + " DECIMAL (15, 2) NOT NULL,\n" +
            "\t" + COLUMNA_REFERENCIA + " VARCHAR (200) DEFAULT NULL,\n" +
            "\t" + COLUMNA_NO_TARJETA + " VARCHAR (200) DEFAULT NULL,\n" +
            "\t" + COLUMNA_NO_TRANSFERENCIA + " VARCHAR (200) DEFAULT NULL,\n" +
            "\t" + COLUMNA_AUTORIZACION + " VARCHAR (200) DEFAULT NULL)";

    String COLUMNAS_PAGO[] = new String[] {COLUMNA_ID_PAGO, COLUMNA_ID_CLIENTE, COLUMNA_ID_PRESTAMO, COLUMNA_ID_USUARIO,
            COLUMNA_NO_PAGO, COLUMNA_ESTADO, COLUMNA_TIPO_PAGO, COLUMNA_BANCO, COLUMNA_CANTIDAD_PAGADA, COLUMNA_REFERENCIA,
            COLUMNA_AUTORIZACION, COLUMNA_NO_TARJETA, COLUMNA_NO_TRANSFERENCIA};
}
