package com.corpmycyber.test_login.activity;

import android.content.Context;
import android.content.Intent;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.view.GestureDetector;
import android.view.MenuItem;
import android.view.MotionEvent;
import android.view.View;
import android.widget.AbsListView;
import android.widget.Toast;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.adapter.ClientePrestamoAdapter;
import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.bean.Prestamo;
import com.corpmycyber.test_login.db.Database;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.AlertDialogManager;
import com.corpmycyber.test_login.session.SessionManager;
import com.corpmycyber.test_login.util.DividerItemDecoration;

import java.util.ArrayList;
import java.util.List;

public class ClientePrestamoActivity extends AppCompatActivity {

    private static final String TAG = ClientePrestamoActivity.class.getSimpleName();
    private List<Prestamo> listadoDePrestamos = new ArrayList<>();
    private Toolbar mToolbar;
    private FloatingActionButton btnAgregarPrestamo;
    private AlertDialogManager alerta = new AlertDialogManager();
    private RecyclerView recyclerView;
    private ClientePrestamoAdapter mAdapter;
    private SessionManager sesion;
    public static Database mDb;
    private Prestamo prestamo;
    private Cliente cliente;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        try {
            super.onCreate(savedInstanceState);
            setContentView(R.layout.activity_cliente_prestamo);

            mToolbar = (Toolbar) findViewById(R.id.toolbar);

            setSupportActionBar(mToolbar);
            getSupportActionBar().setDisplayHomeAsUpEnabled(true);
            setTitle("Prestamos del Cliente");


            sesion = new SessionManager(getApplicationContext());
            sesion.verificarSesion();

            try {
                Cliente clienteSeleccionado = (Cliente) getIntent().getExtras().get("clienteSeleccionado");
                if (clienteSeleccionado != null) {
                    this.cliente = clienteSeleccionado;
                    this.prestamo = new Prestamo();
                    //this.prestamo = Database.mPrestamoDaoImplement.obtenerPrestamoPorId(clienteSeleccionado.getid);
                } else {
                    prestamo = new Prestamo();
                    cliente = new Cliente();
                }
            } catch (Exception e) {
                ErrorHelper.control(e, TAG);
                prestamo = new Prestamo();
                cliente = new Cliente();
            }
            try {

            }catch (Exception e) {
                ErrorHelper.control(e, TAG);
                prestamo = new Prestamo();
            }

            mDb = new Database(getApplicationContext());
            mDb.open();

            btnAgregarPrestamo = (FloatingActionButton) findViewById(R.id.btn_add_prestamos);
            btnAgregarPrestamo.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent i = new Intent(getApplicationContext(), PrestamoActivity.class);
                    i.putExtra("mantenimiento", 1);
                    startActivity(i);
                }
            });

            recyclerView = (RecyclerView) findViewById(R.id.recycler_view_prestamos);

            mAdapter = new ClientePrestamoAdapter(listadoDePrestamos, this);

            recyclerView.setHasFixedSize(true);
            final RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(this);
            recyclerView.setLayoutManager(mLayoutManager);
            recyclerView.addItemDecoration(new DividerItemDecoration(this, LinearLayoutManager.VERTICAL));
            recyclerView.setItemAnimator(new DefaultItemAnimator());
            recyclerView.setAdapter(mAdapter);

            recyclerView.addOnItemTouchListener(new RecyclerTouchListener(this, recyclerView, new ClickListener() {
                @Override
                public void onClick(View view, int position) {
                    Prestamo prestamo = listadoDePrestamos.get(position);
                    mAdapter.setPrestamoSeleccionado(prestamo);
                    Toast.makeText(getApplicationContext(), prestamo.getMonto().toString() + " Selected" , Toast.LENGTH_LONG).show();
                }

                @Override
                public void onLongClick(View view, int position) {}
            }));

            recyclerView.addOnScrollListener(new RecyclerView.OnScrollListener(){
                @Override
                public void onScrolled(RecyclerView recyclerView, int dx, int dy){
                    if (dy > 0 ||dy<0 && btnAgregarPrestamo.isShown()) { btnAgregarPrestamo.hide(); }
                }

                @Override
                public void onScrollStateChanged(RecyclerView recyclerView, int newState) {
                    if (newState == AbsListView.OnScrollListener.SCROLL_STATE_IDLE){ btnAgregarPrestamo.show(); }
                    super.onScrollStateChanged(recyclerView, newState);
                }
            });

            cargarDatosPrestamos();
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        boolean resultado = false;
        try {
            switch (item.getItemId()) {
                case android.R.id.home:
                    finish();
                    resultado = true;
            }
            resultado = super.onOptionsItemSelected(item);
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
        return resultado;
    }

    public void cargarDatosPrestamos() {
        try {
            for (Prestamo prestamo: Database.mPrestamoDaoImplement.obtenerListadoDePrestamos(cliente.getIdCliente())) {
                listadoDePrestamos.add(prestamo);
            }
            mAdapter.notifyDataSetChanged();
        } catch (Exception e) {
            ErrorHelper.control(e, TAG);
        }
    }

    public interface ClickListener {
        void onClick(View view, int position);
        void onLongClick(View view, int position);
    }

    public static class RecyclerTouchListener implements RecyclerView.OnItemTouchListener {

        private GestureDetector gestureDetector;
        private ClientePrestamoActivity.ClickListener clickListener;

        public RecyclerTouchListener(Context context, final RecyclerView recyclerView, final ClientePrestamoActivity.ClickListener clickListener) {
            this.clickListener = clickListener;
            gestureDetector = new GestureDetector(context, new GestureDetector.SimpleOnGestureListener() {
                @Override
                public boolean onSingleTapUp(MotionEvent e) { return true; }

                @Override
                public void onLongPress(MotionEvent e) {
                    View child = recyclerView.findChildViewUnder(e.getX(), e.getY());
                    if (child != null && clickListener != null) {
                        clickListener.onLongClick(child, recyclerView.getChildPosition(child));
                    }
                }
            });
        }

        @Override
        public boolean onInterceptTouchEvent(RecyclerView rv, MotionEvent e) {
            View child = rv.findChildViewUnder(e.getX(), e.getY());
            if (child != null && clickListener != null && gestureDetector.onTouchEvent(e)) {
                clickListener.onClick(child, rv.getChildPosition(child));
            }
            return false;
        }

        @Override
        public void onTouchEvent(RecyclerView rv, MotionEvent e) { }

        @Override
        public void onRequestDisallowInterceptTouchEvent(boolean disallowIntercept) { }
    }

    public Prestamo getPrestamo() {return prestamo;}
    public void setPrestamo(Prestamo prestamo) {this.prestamo = prestamo;}

    public Cliente getCliente() {return cliente;}
    public void setCliente(Cliente cliente) {this.cliente = cliente;}
}
