package com.corpmycyber.test_login.helper;

import android.content.ContentValues;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;

import com.corpmycyber.test_login.bean.Cliente;
import com.corpmycyber.test_login.bean.Usuario;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public abstract class DbContentProvider {

    public SQLiteDatabase database;

    public int delete(String tableName, String selection,
                      String[] selectionArgs) {
        return database.delete(tableName, selection, selectionArgs);
    }

    public long insert(String tableName, ContentValues values) {
        return database.insert(tableName, null, values);
    }

    protected abstract <T> T cursorToEntity(Cursor cursor);

    public DbContentProvider(SQLiteDatabase db) {
        this.database = db;
    }

    public Cursor query(String tableName, String[] columns,
                        String selection, String[] selectionArgs, String sortOrder) {

        final Cursor cursor = database.query(tableName, columns,
                selection, selectionArgs, null, null, sortOrder);

        return cursor;
    }

    public Cursor query(String tableName, String[] columns,
                        String selection, String[] selectionArgs, String sortOrder,
                        String limit) {

        return database.query(tableName, columns, selection,
                selectionArgs, null, null, sortOrder, limit);
    }

    public Cursor query(String tableName, String[] columns,
                        String selection, String[] selectionArgs, String groupBy,
                        String having, String orderBy, String limit) {

        return database.query(tableName, columns, selection,
                selectionArgs, groupBy, having, orderBy, limit);
    }

    public int update(String tableName, ContentValues values,
                      String selection, String[] selectionArgs) {
        return database.update(tableName, values, selection,
                selectionArgs);
    }

    public Cursor rawQuery(String sql, String[] selectionArgs) {
        return database.rawQuery(sql, selectionArgs);
    }
}
