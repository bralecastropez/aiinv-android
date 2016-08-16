package com.corpmycyber.test_login.session;

import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class AlertDialogManager {

    public void mostrarMensajeDeAlerta(Context context, String titulo, String mensaje, Boolean estado) {
        AlertDialog alerta = new AlertDialog.Builder(context).create();
        alerta.setTitle(titulo);
        alerta.setMessage(mensaje);

        if(estado != null) {
            alerta.setButton("Aceptar", new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int which) {
                }
            });
        }
        alerta.show();
    }

    public void mostrarMensajeCerrar(final Context context, Boolean estado) {
        AlertDialog.Builder alerta = new AlertDialog.Builder(context);
        if (estado != null) {
            alerta.setTitle("¿Realmente desea salir de la aplicación?");
            alerta.setPositiveButton("Salir", new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int which) {
                    System.exit(0);
                }
            });
            alerta.setNegativeButton("Cancelar", null);
        }
        alerta.show();
    }

}
