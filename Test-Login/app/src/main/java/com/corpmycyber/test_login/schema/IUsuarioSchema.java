package com.corpmycyber.test_login.schema;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IUsuarioSchema {

    String TABLA_USUARIO = "Usuario";

    String COLUMNA_ID_USUARIO = "Id_Usuario";
    String COLUMNA_NOMBRE = "Nombre";
    String COLUMNA_APELLIDO = "Apellido";
    String COLUMNA_TELEFONO = "Telefono";
    String COLUMNA_CORREO = "Correo";
    String COLUMNA_USUARIO = "Usuario";
    String COLUMNA_PASS = "Pass";
    String COLUMNA_ROL = "Rol";
    String COLUMNA_FECHA_CREADO = "Fecha_Creacion";

    String CREAR_TABLA_USUARIO = "CREATE TABLE IF NOT EXISTS " + TABLA_USUARIO + " (\n" +
            "\t" + COLUMNA_ID_USUARIO + " INTEGER PRIMARY KEY AUTOINCREMENT,\n" +
            "\t" + COLUMNA_NOMBRE + " VARCHAR (255) NOT NULL,\n" +
            "\t" + COLUMNA_APELLIDO + " VARCHAR (255) NOT NULL,\n" +
            "\t" + COLUMNA_TELEFONO + " VARCHAR (20) NOT NULL,\n" +
            "\t" + COLUMNA_CORREO + " VARCHAR (25) DEFAULT NULL,\n" +
            "\t" + COLUMNA_ROL + " VARCHAR (20) NOT NULL,\n" +
            "\t" + COLUMNA_FECHA_CREADO + " DATE NOT NULL,\n" +
            "\t" + COLUMNA_USUARIO + " VARCHAR (25) NOT NULL,\n" +
            "\t" + COLUMNA_PASS + " VARCHAR (100) NOT NULL)";

    String COLUMNAS_USUARIO[] = new String[] {COLUMNA_ID_USUARIO, COLUMNA_NOMBRE, COLUMNA_APELLIDO, COLUMNA_TELEFONO,
            COLUMNA_CORREO, COLUMNA_USUARIO, COLUMNA_PASS, COLUMNA_ROL, COLUMNA_FECHA_CREADO};
}
