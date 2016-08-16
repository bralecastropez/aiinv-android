package com.corpmycyber.test_login.activity;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.app.Fragment;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.GestureDetector;
import android.view.LayoutInflater;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.adapter.GrupoAdapter;
import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.bean.Grupo;
import com.corpmycyber.test_login.db.Database;
import com.corpmycyber.test_login.helper.ErrorHelper;
import com.corpmycyber.test_login.session.AlertDialogManager;
import com.corpmycyber.test_login.session.SessionManager;
import com.corpmycyber.test_login.util.DividerItemDecoration;

import java.util.ArrayList;
import java.util.List;

public class GrupoFragment extends Fragment {

    private FloatingActionButton btnAddGroup;
    private List<Grupo> listaGrupos = new ArrayList<>();
    private RecyclerView recyclerView;
    private GrupoAdapter gAdapter;
    private static final String g_clase  = GrupoFragment.class.getSimpleName();
    private AlertDialogManager notificacion = new AlertDialogManager();
    private SessionManager sesion;

    public static Database mDb;
    private int contentView;

    public GrupoFragment() {
        // Required empty public constructor
    }


    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(final LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        View rootView = inflater.inflate(R.layout.fragment_grupo, container, false);
        try {
            sesion = new SessionManager(rootView.getContext());
            mDb = new Database(rootView.getContext());
            mDb.open();

            btnAddGroup = (FloatingActionButton) rootView.findViewById(R.id.btn_add_group);
            btnAddGroup.setOnClickListener((new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                    Intent g = new Intent(getActivity(), GrupoActivity.class);
                    g.putExtra("mantenimiento", 1);
                    startActivity(g);
                }
            }));
            recyclerView = (RecyclerView) rootView.findViewById(R.id.recycler_view);
            gAdapter = new GrupoAdapter(listaGrupos, this.getContext());
            recyclerView.setHasFixedSize(true);
            final RecyclerView.LayoutManager mLayoutManager = new LinearLayoutManager(rootView.getContext());
            recyclerView.setLayoutManager(mLayoutManager);
            recyclerView.addItemDecoration(new DividerItemDecoration(rootView.getContext(), LinearLayoutManager.VERTICAL));
            recyclerView.setItemAnimator(new DefaultItemAnimator());
            recyclerView.setAdapter(gAdapter);

            recyclerView.addOnItemTouchListener(new RecyclerTouchListener(rootView.getContext(), recyclerView, new ClickListener() {
                @Override
                public void onClick(View view, int position) {
                    Grupo  grupo=listaGrupos.get(position);
                    //Toast.makeText(rootView.getContext(), cliente.getNombre() + " fue seleccionado!", Toast.LENGTH_SHORT).show();
                    gAdapter.setGruupoSeleccionado(grupo);

                }

                @Override
                public void onLongClick(View view, int position) {}
            }));

            cargarDatosGrupo();
        } catch (Exception e) {
            ErrorHelper.control(e, g_clase);
        }
        return rootView;
    }

    @Override
    public void onAttach(Activity activity) { super.onAttach(activity); }

    @Override
    public void onDetach() { super.onDetach(); }


    public void cargarDatosGrupo() {
        try {
            for (Grupo grupo: Database.mGrupoDaoImplement.obtenerListadoDeGrupos()) {
                //Log.e("Cliente", cliente.getNombre() + " " + cliente.getIdCliente());
                listaGrupos.add(grupo);
            }
            gAdapter.notifyDataSetChanged();
        } catch (Exception e) {
            ErrorHelper.control(e, g_clase);
        }
    }

    @Override
    public void onResume() {
        super.onResume();
        //Agrega esto en el fragment de grupo para que se actualize solo.
        setContentView(R.layout.fragment_grupo);
    }

    public void setContentView(int contentView) {
        this.contentView = contentView;
    }

    public interface ClickListener {
        void onClick(View view, int position);
        void onLongClick(View view, int position);
    }

    public static class RecyclerTouchListener implements RecyclerView.OnItemTouchListener {

        private GestureDetector gestureDetector;
        private GrupoFragment.ClickListener clickListener;

        public RecyclerTouchListener(Context context, final RecyclerView recyclerView, final GrupoFragment.ClickListener clickListener) {
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

}
