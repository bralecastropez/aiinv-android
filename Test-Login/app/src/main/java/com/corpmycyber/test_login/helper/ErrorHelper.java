package com.corpmycyber.test_login.helper;

import android.util.Log;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class ErrorHelper extends Exception {


    public static void control(Exception e, String NombreClase) {
        try {
            Log.i("Error Helper",  "Un error ha ocurrido!");
            Log.i("Error Helper", "---------------------------");
            Log.i("Error Helper", "Clase: " + NombreClase);
            Log.e("Error Helper", "Error: ");
            Log.e("Error Helper", "---> " + e.getMessage());
            e.printStackTrace();
            Log.i("Error Helper", "---------------------------");
        } catch (Exception ex) {
            Log.e("Error ---> " + NombreClase + " ---> ", ex.getMessage());
        }
    }

    public static void avoid(Throwable e, String NombreClase){
        try {
            Log.i("Error Helper",  "Un error ha ocurrido!");
            Log.i("Error Helper", "---------------------------");
            Log.i("Error Helper", "Clase: " + NombreClase);
            Log.e("Error Helper", "Error: ");
            Log.e("Error Helper", "---> " + e.getMessage());
            Log.i("Error Helper", "---------------------------");
        } catch (Exception ex) {
            Log.e("Error ---> " + NombreClase + " ---> ", ex.getMessage());
        }
    }
}
