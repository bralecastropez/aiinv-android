package com.corpmycyber.test_login.util;

import com.corpmycyber.test_login.helper.ErrorHelper;

import java.math.BigInteger;
import java.nio.charset.Charset;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;
import java.util.Locale;

/**
 * Creado por: Brandon Castro
 * Proyecto: AIINV
 */
public class GenerarPassword {

    private static final String NOMBRE_CLASE = GenerarPassword.class.getSimpleName();

    public static String getMD5(String data) {
        String result = null;
        MessageDigest md;
        try {
            md = MessageDigest.getInstance("MD5");
            md.update(data.getBytes(Charset.forName("UTF-8")));
            result = String.format(Locale.ROOT, "%032x", new BigInteger(1, md.digest()));
        } catch (NoSuchAlgorithmException e) {
            ErrorHelper.control(e, NOMBRE_CLASE);
            throw new IllegalStateException(e);
        }
        return new StringBuilder().append(result).reverse().toString();
    }

    public static String getPassword() {
        String KEY = "0123456789" + "ABCDEFGHIJKLMNOPQRSTUVWXYZ" + "abcdefghijklmnopqrstuvwxyz";
        String pswd = "";
        for (int i = 0; i < 10; i++) {
            pswd += (KEY.charAt((int)(Math.random() * KEY.length())));
        }
        return pswd;
    }

}
