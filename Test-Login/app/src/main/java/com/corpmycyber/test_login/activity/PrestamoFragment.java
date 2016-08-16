package com.corpmycyber.test_login.activity;

import android.app.Activity;
import android.content.Context;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.bean.Usuario;
import com.corpmycyber.test_login.db.Database;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.AlertDialogManager;
import com.corpmycyber.test_login.util.GenerarPassword;

import java.util.Date;
import java.util.List;


public class PrestamoFragment extends Fragment {

    public static final String TAG = PrestamoFragment.class.getSimpleName();
    public static Database mDb;

    public PrestamoFragment() {
        // Required empty public constructor
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View rootView = inflater.inflate(R.layout.fragment_prestamo, container, false);
        Context activity = getActivity();
        try {
            mDb = new Database(activity);
            mDb.open();

            //mDb = new Database(activity.getApplicationContext());

           /* Usuario admin = new Usuario();
            admin.setNombre("Super");
            admin.setApellido("Administrador");
            admin.setCorreo("admin@host.com");
            admin.setTelefono("0000-0000");
            admin.setFechaCreado(new Date());
            admin.setPass(GenerarPassword.getMD5("admin"));
            admin.setUsuario("admin");
            admin.setRol("1");
            boolean isSafe = Database.mUsuarioDaoImplement.agregarUsuario(admin);*/

            /*Usuario usuario = new Usuario();
            usuario.setNombre("Super");
            usuario.setApellido("Usuario");
            usuario.setCorreo("user@host.com");
            usuario.setTelefono("0000-0000");
            usuario.setFechaCreado(new Date());
            usuario.setPass(GenerarPassword.getMD5("usuario"));
            usuario.setUsuario("usuario");
            usuario.setRol("2");
            boolean isSafe1 = Database.mUsuarioDaoImplement.agregarUsuario(usuario);*/

            /*if (isSafe && isSafe1) {
                new AlertDialogManager().mostrarMensajeDeAlerta(activity, "Usuarios Guardados", "Correcto", true);

                List<Usuario> usuarios = Database.mUsuarioDaoImplement.obtenerListadoDeUsuarios();

                for(Usuario usu: usuarios ) {
                    new AlertDialogManager().mostrarMensajeDeAlerta(activity, usu.getNombre() + usu.getApellido(), usu.getPass() , true);
                }

                new AlertDialogManager().mostrarMensajeDeAlerta(activity, String.valueOf(usuarios.size()), String.valueOf(usuarios.size()), true);
            }*/


        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }

        return rootView;
    }

    @Override
    public void onAttach(Activity activity) {
        super.onAttach(activity);

    }

    @Override
    public void onDetach() {
        super.onDetach();
    }

}