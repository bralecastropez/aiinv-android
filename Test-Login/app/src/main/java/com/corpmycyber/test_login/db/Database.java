package com.corpmycyber.test_login.db;

import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.util.Log;

import com.corpmycyber.test_login.dao.ClienteDaoImplement;
import com.corpmycyber.test_login.dao.GrupoDaoImplement;
import com.corpmycyber.test_login.dao.PagoDaoImplement;
import com.corpmycyber.test_login.dao.PrestamoDaoImplement;
import com.corpmycyber.test_login.dao.UsuarioDaoImplement;
import com.corpmycyber.test_login.schema.IClienteSchema;
import com.corpmycyber.test_login.schema.IGrupoSchema;
import com.corpmycyber.test_login.schema.IPagoSchema;
import com.corpmycyber.test_login.schema.IPrestamoSchema;
import com.corpmycyber.test_login.schema.IUsuarioSchema;
import com.corpmycyber.test_login.session.LoginDataBaseAdapter;

import java.sql.SQLException;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class Database {

    private static final String TAG = "DbPrestamo";
    private static final String DATABASE_NAME = "prestamo.db";
    private DatabaseHelper mDbHelper;
    private static final int DATABASE_VERSION = 1;
    private final Context mContext;
    public static UsuarioDaoImplement mUsuarioDaoImplement;
    public static GrupoDaoImplement mGrupoDaoImplement;
    public static ClienteDaoImplement mClienteDaoImplement;
    public static PrestamoDaoImplement mPrestamoDaoImplement;
    public static PagoDaoImplement mPagoDaoImplement;
    public static LoginDataBaseAdapter mloginDataBaseAdapter;

    public Database open() throws SQLException {
        mDbHelper = new DatabaseHelper(mContext);
        SQLiteDatabase mDb = mDbHelper.getWritableDatabase();

        mUsuarioDaoImplement = new UsuarioDaoImplement(mDb);
        mGrupoDaoImplement = new GrupoDaoImplement(mDb);
        mClienteDaoImplement = new ClienteDaoImplement(mDb);
        mPrestamoDaoImplement = new PrestamoDaoImplement(mDb);
        mPagoDaoImplement = new PagoDaoImplement(mDb);
        mloginDataBaseAdapter = new LoginDataBaseAdapter(mDb);

        return this;
    }

    public void close() { mDbHelper.close(); }

    public Database(Context context) {
        this.mContext = context;
    }


    private static class DatabaseHelper extends SQLiteOpenHelper {

        DatabaseHelper(Context context) {
            super(context, DATABASE_NAME, null, DATABASE_VERSION);
        }

        @Override
        public void onCreate(SQLiteDatabase db) {
            db.execSQL(IUsuarioSchema.CREAR_TABLA_USUARIO);
            db.execSQL(IGrupoSchema.CREAR_TABLA_GRUPO);
            db.execSQL(IClienteSchema.CREAR_TABLA_CLIENTE);
            db.execSQL(IPrestamoSchema.CREAR_TABLA_PRESTAMO);
            db.execSQL(IPagoSchema.CREAR_TABLA_PAGO);
        }

        @Override
        public void onUpgrade(SQLiteDatabase db, int oldVersion,
                              int newVersion) {
            Log.w(TAG, "Upgrading database from version "
                    + oldVersion + " to "
                    + newVersion + " which destroys all old data");

            db.execSQL("DROP TABLE IF EXISTS " + IUsuarioSchema.TABLA_USUARIO);
            db.execSQL("DROP TABLE IF EXISTS " + IGrupoSchema.TABLA_GRUPO);
            db.execSQL("DROP TABLE IF EXISTS " + IClienteSchema.TABLA_CLIENTE);
            db.execSQL("DROP TABLE IF EXISTS " + IPrestamoSchema.TABLA_PRESTAMO);
            db.execSQL("DROP TABLE IF EXISTS " + IPagoSchema.TABLA_PAGO);
            onCreate(db);

        }
    }

}