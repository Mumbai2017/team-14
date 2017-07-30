package com.project.attendancemanager.ceque;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Debug;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.ArrayList;

public class LessonDisplay extends AppCompatActivity {

    TextView tvName,tvSubject,tvGrade,tvLanguage,tvDescription,tvFeedback;
    EditText etMsg;
    Button btnSend;
    ArrayList<String >  feedbackMsg=new ArrayList<>();
    ArrayList<String >  feedbackFrom=new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_lesson_display);
        tvFeedback= (TextView) findViewById(R.id.tvFeedback);
        etMsg= (EditText) findViewById(R.id.etMsg);
        btnSend= (Button) findViewById(R.id.btnSend);
        tvName= (TextView) findViewById(R.id.tvTitle);
        tvSubject= (TextView) findViewById(R.id.tvSubject);
        tvGrade= (TextView) findViewById(R.id.tvGrade);
        tvLanguage= (TextView) findViewById(R.id.tvLanguage);
        tvDescription= (TextView) findViewById(R.id.tvDescription);

        Intent i=getIntent();
        int id=i.getIntExtra("l_id1",0);
        String json=i.getStringExtra("pi");
        final String userid=i.getStringExtra("userid3");
        Log.d("debug55",json+"");

        try {
            JSONObject jsonObject=new JSONObject(json);
            JSONArray cast=jsonObject.getJSONArray("list");
            jsonObject=cast.getJSONObject(id);
            final String lpid=jsonObject.getString("id");
            Log.d("debug55",lpid);
            tvName.setText(jsonObject.getString("name"));
            tvSubject.setText(jsonObject.getString("subject"));
            tvGrade.setText(jsonObject.getString("grade"));
            tvLanguage.setText(jsonObject.getString("language"));
            tvDescription.setText(jsonObject.getString("desc"));

            btnSend.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    if(etMsg.equals("")){
                        etMsg.setError("Enter Comment");
                        return;
                    }
                    Task1 t=new Task1();
                    t.execute("http://54.254.248.136/team-14/service/feedback/feedbackLessonPlan.php",userid,lpid,etMsg.getText().toString());

                }
            });


            Task t=new Task();
            t.execute("http://54.254.248.136/team-14/service/feedback/getLPFeeback.php",lpid);

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }
    class Task1 extends AsyncTask<String,Void,String> {

        @Override
        protected String doInBackground(String... params) {
            String data = "";
            try {
                data = URLEncoder.encode("lp_id", "UTF-8") + "=" + URLEncoder.encode(params[2], "UTF-8");
                data += "&" + URLEncoder.encode("feedback", "UTF-8") + "=" + URLEncoder.encode(params[3], "UTF-8");
                data += "&" + URLEncoder.encode("sme_id", "UTF-8") + "=" + URLEncoder.encode(params[1], "UTF-8");
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }
            BufferedReader reader = null;
            try {
                URL url = new URL(params[0]);
                // Send POST data request
                URLConnection conn = url.openConnection();
                conn.setDoOutput(true);
                OutputStreamWriter wr = new OutputStreamWriter(conn.getOutputStream());
                wr.write(data);
                wr.flush();

                reader = new BufferedReader(new InputStreamReader(conn.getInputStream()));
                StringBuilder sb = new StringBuilder();
                String line = "";

                // Read Server Response
                while((line = reader.readLine()) != null)
                {
                    // Append server response in string
                    sb.append(line + "\n");
                    //Log.d("debug123",line);

                }
                if(sb.toString().equals("FeedBack Inserted")){
                    Toast.makeText(LessonDisplay.this, "Feedback Submitted Successfully.", Toast.LENGTH_SHORT).show();
                }
                else{
                    Toast.makeText(LessonDisplay.this, "Feedback Submit Failed.", Toast.LENGTH_SHORT).show();
                }

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            cancel(true);
        }
    }
    public class Task extends AsyncTask<String,Void,String> {

        @Override
        protected String doInBackground(String... params) {

            String data = null;
            try {
                data = URLEncoder.encode("lp_id", "UTF-8") + "=" + URLEncoder.encode(params[1], "UTF-8");
            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }
            BufferedReader reader=null;
            try
            {
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
                String line = "";

                // Read Server Response
                while((line = reader.readLine()) != null)
                {
                    // Append server response in string
                    sb.append(line + "\n");
                    //Log.d("debug123",line);

                }
                Log.d("debug55",sb.toString());
                JSONObject jsonObject=new JSONObject(sb.toString());

                JSONArray cast = jsonObject.getJSONArray("feedback");
                for (int i=0; i<cast.length(); i++) {
                    JSONObject actor = cast.getJSONObject(i);
                    feedbackMsg.add(actor.getString("feedback"));
                    feedbackFrom.add(actor.getString("name"));
                }
                return null;
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
            return null;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            String s1="";
            for(int i=0;i<feedbackMsg.size();i++){
                s1=feedbackMsg.get(i)+feedbackFrom.get(i)+"\n";
            }
            tvFeedback.setText(s1);
            cancel(true);
        }
    }
}
