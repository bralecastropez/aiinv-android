package com.corpmycyber.test_login.adapter;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.PopupMenu;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.activity.ClienteActivity;
import com.corpmycyber.test_login.activity.PrestamoActivity;
import com.corpmycyber.test_login.bean.Prestamo;

import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class ClientePrestamoAdapter extends RecyclerView.Adapter<ClientePrestamoAdapter.MyViewHolder>  {

    private List<Prestamo> listadoDePrestamos;
    private Context mContext;
    private Prestamo prestamoSeleccionado;

    public Prestamo getPrestamoSeleccionado() {return prestamoSeleccionado;}
    public void setPrestamoSeleccionado(Prestamo prestamoSeleccionado) {this.prestamoSeleccionado = prestamoSeleccionado;}

    public ClientePrestamoAdapter(List<Prestamo> listadoDePrestamos, Context mContext){
        this.listadoDePrestamos = listadoDePrestamos;
        this.mContext = mContext;
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView lblMontoTotal, lblMontoPendiente;
        public ImageView overflow;

        public MyViewHolder(View view) {
            super(view);
            lblMontoTotal = (TextView) view.findViewById(R.id.lblMontoTotal);
            lblMontoPendiente = (TextView) view.findViewById(R.id.lblMontoPendiente);
            overflow = (ImageView) view.findViewById(R.id.overflow);
        }
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.prestamo_list_row, parent, false);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(final MyViewHolder holder, int position) {
        Prestamo prestamo = listadoDePrestamos.get(position);
        holder.lblMontoPendiente.setText(String.valueOf(prestamo.getMontoPendiente()));
        holder.lblMontoTotal.setText(String.valueOf(prestamo.getMonto()));

        holder.overflow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showPopupMenu(holder.overflow);
            }
        });
    }

    @Override
    public int getItemCount() { return listadoDePrestamos.size(); }

    private void showPopupMenu(View view) {
        PopupMenu popup = new PopupMenu(mContext, view);
        MenuInflater inflater = popup.getMenuInflater();
        inflater.inflate(R.menu.prestamo_menu, popup.getMenu());
        popup.setOnMenuItemClickListener(new MyMenuItemClickListener());
        popup.show();
    }

    class MyMenuItemClickListener implements PopupMenu.OnMenuItemClickListener {

        public MyMenuItemClickListener() {}

        @Override
        public boolean onMenuItemClick(MenuItem menuItem) {
            switch (menuItem.getItemId()) {
                case R.id.action_edit_prestamo:
                    return true;
                case R.id.action_add_payment_lending:
                    Intent i = new Intent(mContext.getApplicationContext(), PrestamoActivity.class);
                    i.putExtra("clienteSeleccionado", prestamoSeleccionado);
                    mContext.startActivity(i);
                    return true;
                case R.id.action_delete_prestamo:
                    return true;
                default:
            }
            return false;
        }
    }
}
