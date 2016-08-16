package com.corpmycyber.test_login.adapter;

import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.PopupMenu;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.corpmycyber.test_login.R;
import com.corpmycyber.test_login.activity.ClienteActivity;
import com.corpmycyber.test_login.activity.ClientePrestamoActivity;
import com.corpmycyber.test_login.bean.Cliente;

import java.util.ArrayList;
import java.util.List;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class ClienteAdapter extends RecyclerView.Adapter<ClienteAdapter.MyViewHolder> {

    private List<Cliente> listadoDeClientes;
    private Context mContext;
    private Cliente clienteSeleccionado;
    private ArrayAdapter<String> adapter;

    public Cliente getClienteSeleccionado() { return clienteSeleccionado; }
    public void setClienteSeleccionado(Cliente clienteSeleccionado) { this.clienteSeleccionado = clienteSeleccionado; }

    public ArrayAdapter<String> getAdapter() { return adapter; }
    public void setAdapter(ArrayAdapter<String> adapter) { this.adapter = adapter; }

    public ClienteAdapter(List<Cliente> listadoDeClientes, Context mContext){
        this.listadoDeClientes = listadoDeClientes;
        this.mContext = mContext;
    }

    public class MyViewHolder extends RecyclerView.ViewHolder {
        public TextView lblClienteNombre, lblClienteDatos;
        public ImageView overflow;

        public MyViewHolder(View view) {
            super(view);
            lblClienteNombre = (TextView) view.findViewById(R.id.lblClienteNombre);
            lblClienteDatos = (TextView) view.findViewById(R.id.lblClienteDatos);
            overflow = (ImageView) view.findViewById(R.id.overflow);
        }
    }

    @Override
    public MyViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.cliente_list_row, parent, false);
        List<String> nombres = new ArrayList<>();
        adapter = new ArrayAdapter<>(parent.getContext(), R.layout.cliente_list_row, R.id.lblClienteNombre, nombres);
        return new MyViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(final MyViewHolder holder, int position) {
        Cliente cliente= listadoDeClientes.get(position);
        String nombre = cliente.getNombre() + " " + cliente.getApellido();
        String datos = cliente.getTelefono() + " " + cliente.getCorreo();
        holder.lblClienteNombre.setText(nombre);
        holder.lblClienteDatos.setText(datos);

        holder.overflow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                showPopupMenu(holder.overflow);
            }
        });
    }

    @Override
    public int getItemCount() { return listadoDeClientes.size(); }


    private void showPopupMenu(View view) {
        PopupMenu popup = new PopupMenu(mContext, view);
        MenuInflater inflater = popup.getMenuInflater();
        inflater.inflate(R.menu.cliente_menu, popup.getMenu());
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
            Intent i = new Intent(mContext, ClienteActivity.class);
            switch (menuItem.getItemId()) {
                case R.id.action_add_lending_cliente:
                    //Toast.makeText(mContext.getApplicationContext(), clienteSeleccionado.getNombre() + " fue seleccionado! - Prestamo", Toast.LENGTH_SHORT).show();
                    Intent prestamoCliente = new Intent(mContext.getApplicationContext(), ClientePrestamoActivity.class);
                    prestamoCliente.putExtra("clienteSeleccionado", clienteSeleccionado);
                    mContext.startActivity(prestamoCliente);
                    return true;
                case R.id.action_delete_cliente:
                    //Toast.makeText(mContext.getApplicationContext(), clienteSeleccionado.getNombre() + " fue seleccionado! - Eliminar", Toast.LENGTH_SHORT).show();
                    //Toast.makeText(mContext, "Eliminar", Toast.LENGTH_SHORT).show();
                    i.putExtra("mantenimiento", 3);
                    i.putExtra("clienteSeleccionado", clienteSeleccionado);
                    mContext.startActivity(i);
                    return true;
                case R.id.action_edit_cliente:
                    //Toast.makeText(mContext.getApplicationContext(), clienteSeleccionado.getNombre() + " fue seleccionado! - Editar", Toast.LENGTH_SHORT).show();
                    //Toast.makeText(mContext, "Editar", Toast.LENGTH_SHORT).show();
                    i.putExtra("mantenimiento", 2);
                    i.putExtra("clienteSeleccionado", clienteSeleccionado);
                    mContext.startActivity(i);
                    return true;
                /*case R.id.action_add_cliente:
                    mContext.startActivity(i);
                    i.putExtra("mantenimiento", 1);
                    break;*/
                default:
            }
            return false;
        }
    }

}
