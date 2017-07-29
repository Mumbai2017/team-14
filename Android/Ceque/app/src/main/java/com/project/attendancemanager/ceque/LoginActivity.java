package com.project.attendancemanager.ceque;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.design.widget.TextInputLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;

public class LoginActivity extends AppCompatActivity {

    EditText etLoginId,etPassword;
    Button btnLogin;
    TextInputLayout tilPassword,tilLoginId;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        etLoginId= (EditText) findViewById(R.id.etLoginId);
        etPassword= (EditText) findViewById(R.id.etPassword);
        btnLogin= (Button) findViewById(R.id.btnLogin);
        tilPassword=(TextInputLayout)findViewById(R.id.tilPassword);
        tilLoginId=(TextInputLayout)findViewById(R.id.tilLoginId);

        btnLogin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if (etLoginId.getText().toString().equals("")) {
                    tilLoginId.setError("Enter User ID");
                    return;
                }
                if(etPassword.getText().toString().equals("")){
                    tilPassword.setError("Enter Password");
                    return;

                }
                LoginConnectPhp l=new LoginConnectPhp();
                l.execute("http://54.254.248.136:80/team-14/service/login/auth.php",etLoginId.getText().toString(),etPassword.getText().toString());
            }
        });

    }

    public class LoginConnectPhp extends AsyncTask<String,Void,String>{


        @Override
        protected String doInBackground(String... params) {

            String data = null;
            try {
                data = URLEncoder.encode("username", "UTF-8")
                        + "=" + URLEncoder.encode(params[1], "UTF-8");

                data += "&" + URLEncoder.encode("password", "UTF-8") + "="
                        + URLEncoder.encode(params[2], "UTF-8");

            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }
            BufferedReader reader=null;
            try
            {
                // Defined URL  where to send data
                Log.d("T14",data);
                URL url = new URL(params[0]);

                // Send POST data request
                URLConnection conn = url.openConnection();
                conn.setDoOutput(true);
                OutputStreamWriter wr = new OutputStreamWriter(conn.getOutputStream());
                wr.write(data);
                wr.flush();

                // Get the server response
                reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                StringBuilder sb = new StringBuilder();
                String line = null;

                // Read Server Response
                while((line = reader.readLine()) != null)
                {
                    // Append server response in string
                    sb.append(line + "\n");
                    Log.d("T14",line);
                }
                JSONObject jsonObject=new JSONObject(sb.toString());
                int code=jsonObject.getInt("code");
                String msg=jsonObject.getString("msg");
                return code+":"+msg;
            }
            catch(Exception ex)
            {

            }
            finally
            {
                try
                {

                    reader.close();
                }

                catch(Exception ex) {}
            }
            return "Can't connect to the Internet.";
        }

        @Override
        protected void onPostExecute(String s) {
            String data[]=s.split(":");
            Log.d("T14",data[0]);
            if(data[0].equals("1")){
                Intent i=new Intent(LoginActivity.this,MainActivity.class);
                i.putExtra("userid",etLoginId.getText().toString());
                startActivity(i);
                finish();
            }
            else{
                Toast.makeText(LoginActivity.this, ""+s, Toast.LENGTH_SHORT).show();
            }

        }
    }
}
