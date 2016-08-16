package com.corpmycyber.test_login.schema;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IClienteSchema {

    String TABLA_CLIENTE = "Cliente";

    String COLUMNA_ID_CLIENTE = "Id_Cliente";
    String COLUMNA_ID_GRUPO = "Id_Grupo";
    String COLUMNA_NOMBRE = "Nombre";
    String COLUMNA_APELLIDO = "Apellido";
    String COLUMNA_CORREO = "Correo";
    String COLUMNA_TELEFONO = "Telefono";
    String COLUMNA_DIRECCION = "Direccion";
    String COLUMNA_TIPO = "Tipo";
    String COLUMNA_COMENTARIO = "Comentario";

    String CREAR_TABLA_CLIENTE = "CREATE TABLE IF NOT EXISTS " + TABLA_CLIENTE + "(\n" +
            "\t" + COLUMNA_ID_CLIENTE + " INTEGER PRIMARY KEY AUTOINCREMENT,\n" +
            "\t" + COLUMNA_NOMBRE + " VARCHAR (255) NOT NULL,\n" +
            "\t" + COLUMNA_APELLIDO + " VARCHAR (255) NOT NULL,\n" +
            "\t" + COLUMNA_CORREO + " VARCHAR (50) DEFAULT NULL,\n" +
            "\t" + COLUMNA_TELEFONO + " VARCHAR (20) NOT NULL,\n" +
            "\t" + COLUMNA_DIRECCION + " VARCHAR (255) NOT NULL,\n" +
            "\t" + COLUMNA_TIPO + " VARCHAR (20) NOT NULL,\n" +
            "\t" + COLUMNA_COMENTARIO + " VARCHAR (20) NOT NULL, \n" +
            "\t" + COLUMNA_ID_GRUPO + " REFERENCES Grupo (Id_Grupo))";

    String COLUMNAS_CLIENTE[] = new String[] {COLUMNA_ID_CLIENTE, COLUMNA_NOMBRE, COLUMNA_APELLIDO, COLUMNA_CORREO,
            COLUMNA_TELEFONO, COLUMNA_DIRECCION, COLUMNA_TIPO, COLUMNA_COMENTARIO, COLUMNA_ID_GRUPO};

}
