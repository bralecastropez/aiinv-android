package com.corpmycyber.test_login.adapter;

import android.content.Context;
import android.content.Intent;
import android.os.Parcelable;
import android.support.v7.widget.PopupMenu;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.activity.ClienteActivity;
import com.corpmycyber.test_login.activity.GrupoActivity;
import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.bean.Grupo;

import java.util.List;

/**
 * Created by Usuario on 05/08/2016.
 */
public class GrupoAdapter extends RecyclerView.Adapter<GrupoAdapter.MyViewHolder> {


    private List<Grupo> listaGrupos;
    private Context mContext;
    private Grupo gruupoSeleccionado;

    public Grupo getGruupoSeleccionado() { return gruupoSeleccionado; }
    public void setGruupoSeleccionado(Grupo gruupoSeleccionado) { this.gruupoSeleccionado = gruupoSeleccionado; }

    public GrupoAdapter(List<Grupo> listaGrupos, Context mContext){
        this.listaGrupos= listaGrupos;
        this.mContext = mContext;
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView lblGrupoNombre, lblGrupoDatos;
        public ImageView overflow;

        public MyViewHolder(View view) {
            super(view);
            lblGrupoNombre = (TextView) view.findViewById(R.id.lblGrupoNombre);
            lblGrupoDatos = (TextView) view.findViewById(R.id.lblGrupoDatos);
            overflow = (ImageView) view.findViewById(R.id.overflow);
        }
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.grupo_list_row, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(final MyViewHolder holder, int position) {
        Grupo grupo = listaGrupos.get(position);
        String nombre = grupo.getNombre();
        String datos = grupo.getDescripcion();
        holder.lblGrupoNombre.setText(nombre);
        holder.lblGrupoDatos.setText(datos);

        holder.overflow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showPopupMenu(holder.overflow);
            }
        });
    }

    @Override
    public int getItemCount() {
        return listaGrupos.size();
    }


    private void showPopupMenu(View view) {
        PopupMenu popup = new PopupMenu(mContext, view);
        MenuInflater inflater = popup.getMenuInflater();
        inflater.inflate(R.menu.grupo_menu, popup.getMenu());
        popup.setOnMenuItemClickListener(new MyMenuItemClickListener());
        popup.show();
    }

    /**
     * Click listener for popup menu items
     */
    class MyMenuItemClickListener implements PopupMenu.OnMenuItemClickListener {

        public MyMenuItemClickListener() {}

        @Override
        public boolean onMenuItemClick(MenuItem menuItem) {
            Intent i = new Intent(mContext, GrupoActivity.class);
            switch (menuItem.getItemId()) {
                case R.id.action_add_lending_grupo:
                    Toast.makeText(mContext.getApplicationContext(), gruupoSeleccionado.getNombre() + " fue seleccionado! - Prestamo", Toast.LENGTH_SHORT).show();

                    return true;
                case R.id.action_add_payment_grupo:
                    return true;
                case R.id.action_deleteG_grupo:
                    i.putExtra("mantenimiento", 3);
                    i.putExtra("gruupoSeleccionado", (gruupoSeleccionado));
                    mContext.startActivity(i);
                    return true;
                case R.id.action_editG_grupo:
                    i.putExtra("mantenimiento", 2);
                    i.putExtra("gruupoSeleccionado", gruupoSeleccionado);
                    mContext.startActivity(i);
                    return true;
                default:
            }
            return false;
        }
    }



}
