package com.corpmycyber.test_login.activity;

import android.os.Bundle;
import android.support.design.widget.CoordinatorLayout;
import android.support.design.widget.NavigationView;
import android.support.design.widget.Snackbar;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarActivity;
import android.support.v7.widget.Toolbar;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Toast;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.db.Database;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.AlertDialogManager;
import com.corpmycyber.test_login.session.SessionManager;

public class MainActivity extends ActionBarActivity implements FragmentDrawer.FragmentDrawerListener {

private static String TAG = MainActivity.class.getSimpleName();

    private Toolbar mToolbar;
    private FragmentDrawer drawerFragment;
    private AlertDialogManager alerta = new AlertDialogManager();
    private SessionManager sessionManager;
    private NavigationView navigationView;
    private CoordinatorLayout coordinatorLayout;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        mToolbar = (Toolbar) findViewById(R.id.toolbar);
        sessionManager = new SessionManager(getApplicationContext());
        sessionManager.verificarSesion();
        setSupportActionBar(mToolbar);
        getSupportActionBar().setDisplayShowHomeEnabled(true);

        drawerFragment = (FragmentDrawer) getSupportFragmentManager().findFragmentById(R.id.fragment_navigation_drawer);
        drawerFragment.setUp(R.id.fragment_navigation_drawer, (DrawerLayout) findViewById(R.id.drawer_layout), mToolbar);
        drawerFragment.setDrawerListener(this);
        displayView(0);

        coordinatorLayout = (CoordinatorLayout) findViewById(R.id.coordinatorLayout);

        navigationView = (NavigationView) findViewById(R.id.navigation_view);

        navigationView.setNavigationItemSelectedListener(new NavigationView.OnNavigationItemSelectedListener() {
            @Override
            public boolean onNavigationItemSelected(MenuItem menuItem) {
                //if(menuItem.isChecked()) {
                    //menuItem.setChecked(false);
                //} else {
                    menuItem.setChecked(false);
                //}


                switch (menuItem.getItemId()){
                    case R.id.settings:
                        alerta.mostrarMensajeDeAlerta(MainActivity.this, "Configuracion", "Configuracion", true);
                        final Snackbar snackbar = Snackbar
                                .make(coordinatorLayout, "Brandon", Snackbar.LENGTH_LONG)
                                .setAction("UNDO", new View.OnClickListener() {
                                    @Override
                                    public void onClick(View view) {
                                        Snackbar snackbar1 = Snackbar.make(coordinatorLayout , "Soy Batman!!!!", Snackbar.LENGTH_SHORT);
                                        snackbar1.show();
                                    }
                                });

                        snackbar.show();
                        return true;
                    case R.id.about:
                        alerta.mostrarMensajeDeAlerta(MainActivity.this, "Ayuda", "Ayuda", true);
                        return true;
                    default:
                        Toast.makeText(MainActivity.this,"Error ...",Toast.LENGTH_SHORT).show();
                        return true;
                }
            }
        });
    }


    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        try {
            int id = item.getItemId();

            switch (id) {
                case R.id.action_logout:
                    sessionManager.desconectarUsuario();
                    finish();
                    break;
                case R.id.action_search:
                    Toast.makeText(getApplicationContext(), "Soy Batman...", Toast.LENGTH_SHORT).show();
                    alerta.mostrarMensajeDeAlerta(MainActivity.this, "Numero de Usuarios", String.valueOf(Database.mUsuarioDaoImplement.obtenerListadoDeUsuarios().size()), true);
                    alerta.mostrarMensajeDeAlerta(MainActivity.this, "Numero de Grupos", String.valueOf(Database.mGrupoDaoImplement.obtenerListadoDeGrupos().size()), true);
                    alerta.mostrarMensajeDeAlerta(MainActivity.this, "Numero de Clientes", String.valueOf(Database.mClienteDaoImplement.obtenerListadoDeClientes().size()), true);
                    return true;
                case R.id.action_settings:
                    Toast.makeText(getApplicationContext(), "Configuracion", Toast.LENGTH_SHORT).show();
                    return true;
                case R.id.action_exit:
                    alerta.mostrarMensajeCerrar(MainActivity.this, true);
                    return true;
            }
            //HashMap<String, String> user = sessionManager.obtenerDatosDelUsuario();
            //String name = user.get(SessionManager.KEY_NAME);
            //String idD = user.get(SessionManager.KEY_ID);
            //String usuario = user.get(SessionManager.KEY_USER);
                //String dato = "";
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return super.onOptionsItemSelected(item);
    }

    @Override
    public void onDrawerItemSelected(View view, int position) {
        displayView(position);
    }

    private void displayView(int position) {
        Fragment fragment = null;
        String title = getString(R.string.app_name);
        switch (position) {
            case 0:
                fragment = new HomeFragment();
                title = getString(R.string.title_home);
                break;
            case 1:
                fragment = new ClienteFragment();
                title = getString(R.string.title_customers);
                break;
            case 2:
                fragment = new PrestamoFragment();
                title = getString(R.string.title_lendings);
                break;
            case 3:
                fragment = new GrupoFragment();
                title= getString(R.string.title_groups);
            default:
                break;
        }

        if (fragment != null) {
            FragmentManager fragmentManager = getSupportFragmentManager();
            FragmentTransaction fragmentTransaction = fragmentManager.beginTransaction();
            fragmentTransaction.replace(R.id.container_body, fragment);
            fragmentTransaction.commit();

            // set the toolbar title
            getSupportActionBar().setTitle(title);
        }
    }

}