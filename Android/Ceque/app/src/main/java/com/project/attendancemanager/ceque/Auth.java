package com.project.attendancemanager.ceque;

/**
 * Created by Aqsa on 30-07-2017.
 */

import android.util.Log;

import com.google.api.client.auth.oauth2.Credential;
import com.google.api.client.auth.oauth2.StoredCredential;
import com.google.api.client.extensions.java6.auth.oauth2.AuthorizationCodeInstalledApp;
import com.google.api.client.extensions.jetty.auth.oauth2.LocalServerReceiver;
import com.google.api.client.googleapis.auth.oauth2.GoogleAuthorizationCodeFlow;
import com.google.api.client.googleapis.auth.oauth2.GoogleClientSecrets;
import com.google.api.client.http.HttpTransport;
import com.google.api.client.http.javanet.NetHttpTransport;
import com.google.api.client.json.JsonFactory;
import com.google.api.client.json.jackson2.JacksonFactory;
import com.google.api.client.util.store.DataStore;
import com.google.api.client.util.store.FileDataStoreFactory;

import java.io.File;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.Reader;
import java.util.List;

/**
 * Shared class used by every sample. Contains methods for authorizing a user and caching credentials.
 */
public class Auth {


    public static final HttpTransport HTTP_TRANSPORT = new NetHttpTransport();

    public static final JsonFactory JSON_FACTORY = new JacksonFactory();

    private static final String CREDENTIALS_DIRECTORY = ".oauth-credentials";

    public static Credential authorize(List<String> scopes, String credentialDatastore) throws IOException {

        // Load client secrets.
        //InputStream is = Auth.class.getClassLoader().getResourceAsStream("C:\\Users\\Aqsa\\Desktop\\copyfolder\\team-14\\Android\\Ceque\\app\\src\\main\\res\\client_secret.json");
//        Reader clientSecretReader = new InputStreamReader(Auth.class.getClass().getResourceAsStream("C:\\Users\\Aqsa\\Desktop\\copyfolder\\team-14\\Android\\Ceque\\app\\src\\main\\res\\client_secret.json"));
        Reader clientSecretReader = new InputStreamReader(Auth.class.getResourceAsStream("/client_secret.json"));


        GoogleClientSecrets clientSecrets = GoogleClientSecrets.load(JSON_FACTORY, clientSecretReader);

        // Checks that the defaults have been replaced (Default = "Enter X here").
        if (clientSecrets.getDetails().getClientId().startsWith("8333488")
                || clientSecrets.getDetails().getClientSecret().startsWith("8333488")) {
            Log.i("auth debug",
                    "Enter Client ID and Secret from https://console.developers.google.com/project/_/apiui/credential "
                            + "into src/main/resources/client_secrets.json");

        }

        // This creates the credentials datastore at ~/.oauth-credentials/${credentialDatastore}
        FileDataStoreFactory fileDataStoreFactory = new FileDataStoreFactory(new File("/storage/emulated/0/dummy/" + CREDENTIALS_DIRECTORY));

        DataStore<StoredCredential> datastore = fileDataStoreFactory.getDataStore(credentialDatastore);

        GoogleAuthorizationCodeFlow flow = new GoogleAuthorizationCodeFlow.Builder(
                HTTP_TRANSPORT, JSON_FACTORY, clientSecrets, scopes).setCredentialDataStore(datastore)
                .build();
        LocalServerReceiver localReceiver = new LocalServerReceiver.Builder().setPort(8080).build();

        return new AuthorizationCodeInstalledApp(flow, localReceiver).authorize("user");
    }
}