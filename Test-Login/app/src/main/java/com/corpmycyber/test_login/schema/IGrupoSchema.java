package com.corpmycyber.test_login.schema;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public interface IGrupoSchema {

    String TABLA_GRUPO = "Grupo";

    String COLUMNA_ID_GRUPO = "Id_Grupo";
    String COLUMNA_NOMBRE = "Nombre";
    String COLUMNA_DESCRIPCION = "Descripcion";

    String CREAR_TABLA_GRUPO = "CREATE TABLE  IF NOT EXISTS " + TABLA_GRUPO + " (\n" +
            "\t" + COLUMNA_ID_GRUPO + " INTEGER PRIMARY KEY AUTOINCREMENT,\n" +
            "\t" + COLUMNA_NOMBRE + " VARCHAR (255) NOT NULL,\n" +
            "\t" + COLUMNA_DESCRIPCION + " VARCHAR (255) DEFAULT NULL)";

    String COLUMNAS_GRUPO[] = new String[] {COLUMNA_ID_GRUPO, COLUMNA_NOMBRE, COLUMNA_DESCRIPCION};
}
