package com.corpmycyber.test_login.activity;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
/*import android.support.design.widget.TextInputEditText; */
import android.support.v4.app.Fragment;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.GestureDetector;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AbsListView;
import android.widget.ArrayAdapter;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.adapter.ClienteAdapter;
import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.db.Database;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.AlertDialogManager;
import com.corpmycyber.test_login.session.SessionManager;
import com.corpmycyber.test_login.util.DividerItemDecoration;

import java.util.ArrayList;
import java.util.List;


public class ClienteFragment extends Fragment {

    //region Campos
    private static final String NOMBRE_CLASE = ClienteFragment.class.getSimpleName();
    private List<Cliente> listadoDeClientes = new ArrayList<>();
    private AlertDialogManager alerta = new AlertDialogManager();
    private FloatingActionButton btnAddCustomer;
    private RecyclerView recyclerView;
    private ClienteAdapter mAdapter;
    private SessionManager sesion;
  //  private TextInputEditText txtBuscarCliente;
    private ArrayAdapter searchAdapter;
    public static Database mDb;
    //endregion

    //region Metodos
    @Override
    public void onCreate(Bundle savedInstanceState) { super.onCreate(savedInstanceState); }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        final View rootView = inflater.inflate(R.layout.fragment_cliente, container, false);
        try {
            sesion = new SessionManager(rootView.getContext());
            sesion.verificarSesion();
            mDb = new Database(rootView.getContext());
            mDb.open();

            //txtBuscarCliente = (TextInputEditText) rootView.findViewById(R.id.txtBuscarCliente);

            btnAddCustomer = (FloatingActionButton) rootView.findViewById(R.id.btn_add_customer);
            btnAddCustomer.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    /*Toast.makeText(getActivity(), "¡Usuario o Contraseña Incorrectos!", Toast.LENGTH_LONG).show();

                    final Snackbar snackbar = Snackbar
                            .make(rootView, "Brandon", Snackbar.LENGTH_LONG)
                            .setAction("UNDO", new View.OnClickListener() {
                                @Override
                                public void onClick(View view) {
                                    Snackbar snackbar1 = Snackbar.make(rootView, "Soy Batman!!!!", Snackbar.LENGTH_SHORT);
                                    snackbar1.show();
                                }
                            });

                    snackbar.show();*/
                    Intent i = new Intent(getActivity(), ClienteActivity.class);
                    i.putExtra("mantenimiento", 1);
                    startActivity(i);
                }
            });

            recyclerView = (RecyclerView) rootView.findViewById(R.id.recycler_view);

            mAdapter = new ClienteAdapter(listadoDeClientes, this.getContext());

            recyclerView.setHasFixedSize(true);
            final RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(rootView.getContext());
            recyclerView.setLayoutManager(mLayoutManager);
            recyclerView.addItemDecoration(new DividerItemDecoration(rootView.getContext(), LinearLayoutManager.VERTICAL));
            recyclerView.setItemAnimator(new DefaultItemAnimator());
            recyclerView.setAdapter(mAdapter);

            recyclerView.addOnItemTouchListener(new RecyclerTouchListener(rootView.getContext(), recyclerView, new ClickListener() {
                @Override
                public void onClick(View view, int position) {
                    //Toast.makeText(rootView.getContext(), cliente.getNombre() + " fue seleccionado!", Toast.LENGTH_SHORT).show();
                    mAdapter.setClienteSeleccionado(listadoDeClientes.get(position));
                }

                @Override
                public void onLongClick(View view, int position) {}
            }));

            recyclerView.addOnScrollListener(new RecyclerView.OnScrollListener(){
                @Override
                public void onScrolled(RecyclerView recyclerView, int dx, int dy){
                    if (dy > 0 ||dy<0 && btnAddCustomer.isShown()) { btnAddCustomer.hide(); }
                }

                @Override
                public void onScrollStateChanged(RecyclerView recyclerView, int newState) {
                    if (newState == AbsListView.OnScrollListener.SCROLL_STATE_IDLE){ btnAddCustomer.show(); }
                    super.onScrollStateChanged(recyclerView, newState);
                }
            });

            /*txtBuscarCliente.addTextChangedListener(new TextWatcher() {

                @Override
                public void onTextChanged(CharSequence cs, int arg1, int arg2, int arg3) {
                    ClienteFragment.this.mAdapter.getAdapter().getFilter().filter(cs);
                }

                @Override
                public void beforeTextChanged(CharSequence arg0, int arg1, int arg2, int arg3) { }

                @Override
                public void afterTextChanged(Editable arg0) { }
            });*/

            cargarDatosCliente();
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
        return rootView;
    }

    @Override
    public void onAttach(Activity activity) { super.onAttach(activity); }

    @Override
    public void onDetach() { super.onDetach(); }

    public void cargarDatosCliente() {
        try {
            for (Cliente cliente: Database.mClienteDaoImplement.obtenerListadoDeClientes()) {
                //Log.e("Cliente", cliente.getNombre() + " " + cliente.getIdCliente());
                listadoDeClientes.add(cliente);
            }
            mAdapter.notifyDataSetChanged();
        } catch (Exception e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
        }
    }

    public interface ClickListener {
        void onClick(View view, int position);
        void onLongClick(View view, int position);
    }

    public static class RecyclerTouchListener implements RecyclerView.OnItemTouchListener {

        private GestureDetector gestureDetector;
        private ClienteFragment.ClickListener clickListener;

        public RecyclerTouchListener(Context context, final RecyclerView recyclerView, final ClienteFragment.ClickListener clickListener) {
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
    //endregion

    //region Constructores
    public ClienteFragment() {}
    //endregion
}