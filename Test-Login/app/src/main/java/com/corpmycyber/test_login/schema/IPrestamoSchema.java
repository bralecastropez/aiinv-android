package com.corpmycyber.test_login.schema;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IPrestamoSchema {

    String TABLA_PRESTAMO = "Prestamo";

    String COLUMNA_ID_PRESTAMO = "Id_Prestamo";
    String COLUMNA_ID_USUARIO = "Id_Usuario";
    String COLUMNA_ID_CLIENTE = "Id_Cliente";
    String COLUMNA_ID_GRUPO = "Id_Grupo";
    String COLUMNA_FECHA_INICIO = "Fecha_Inicio";
    String COLUMNA_FECHA_FIN = "Fecha_Fin";
    String COLUMNA_CONDICION = "Condicion";
    String COLUMNA_MONTO = "Monto";
    String COLUMNA_ESTADO = "Estado";
    String COLUMNA_MONTO_PAGADO = "Monto_Pagado";
    String COLUMNA_MONTO_PENDIENTE = "Monto_Pendiente";
    String COLUMNA_MONTO_PARCIAL = "Monto_Parcial";
    String COLUMNA_FORMA_PAGO = "Forma_Pago";
    String COLUMNA_PLAZO = "Plazo";
    String COLUMNA_NO_PAGOS = "No_Pagos";
    String COLUMNA_INTERES = "Interes";

    String CREAR_TABLA_PRESTAMO = "CREATE TABLE IF NOT EXISTS " + TABLA_PRESTAMO + " (\n" +
            "\t" + COLUMNA_ID_PRESTAMO + " INTEGER PRIMARY KEY AUTOINCREMENT,\n" +
            "\t" + COLUMNA_ID_USUARIO + " INT REFERENCES Usuario (Id_Usuario),\n" +
            "\t" + COLUMNA_ID_CLIENTE + " INT REFERENCES Cliente (Id_Cliente) NOT NULL,\n" +
            "\t" + COLUMNA_ID_GRUPO + " INT REFERENCES Grupo (Id_Grupo) NOT NULL,\n" +
            "\t" + COLUMNA_FECHA_INICIO + " DATE NOT NULL,\n" +
            "\t" + COLUMNA_FECHA_FIN + " DATE NOT NULL,\n" +
            "\t" + COLUMNA_CONDICION + " VARCHAR (255) NOT NULL,\n" +
            "\t" + COLUMNA_MONTO + " DECIMAL (15, 2) NOT NULL,\n" +
            "\t" + COLUMNA_MONTO_PAGADO + " DECIMAL (15, 2) NOT NULL,\n" +
            "\t" + COLUMNA_MONTO_PARCIAL + " DECIMAL (15, 2) NOT NULL,\n" +
            "\t" + COLUMNA_MONTO_PENDIENTE + " DECIMAL (15, 2) NOT NULL,\n" +
            "\t" + COLUMNA_INTERES + " DECIMAL (15, 2) NOT NULL,\n" +
            "\t" + COLUMNA_FORMA_PAGO + " VARCHAR (20) NOT NULL,\n" +//Efectivo, Cheque, Transferencia Bancaria, Tarjeta de Credito
            "\t" + COLUMNA_PLAZO + " INT,\n" +//Semanal, Mensual, Bimestral, Trimestral, Anual
            "\t" + COLUMNA_NO_PAGOS + " INT (11) NOT NULL," +//Numero de Pagos que se le Asignaran
            "\t" + COLUMNA_ESTADO +" INT NOT NULL)";//Pagado, Parcial, Pendiente

    String COLUMNAS_PRESTAMO[] = new String[] {COLUMNA_ID_PRESTAMO, COLUMNA_ID_USUARIO, COLUMNA_ID_CLIENTE, COLUMNA_ID_GRUPO,
            COLUMNA_FECHA_INICIO, COLUMNA_FECHA_FIN, COLUMNA_CONDICION, COLUMNA_MONTO, COLUMNA_MONTO_PAGADO, COLUMNA_MONTO_PARCIAL,
            COLUMNA_MONTO_PENDIENTE, COLUMNA_INTERES, COLUMNA_FORMA_PAGO, COLUMNA_PLAZO, COLUMNA_NO_PAGOS, COLUMNA_ESTADO};

}
