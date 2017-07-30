package com.project.attendancemanager.ceque;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.Adapter;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.lang.reflect.Array;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.ArrayList;

public class MainActivity extends AppCompatActivity {

    Context context=this;
    Button btnUpload,btnLessons;
    ListView lvVideos;
    Toolbar main_toolbar;
    ArrayList<String> allTitles = new ArrayList<>();
    ArrayList<Integer> allId=new ArrayList<>();
    JSONObject jsonObject;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        main_toolbar= (Toolbar) findViewById(R.id.main_toolbar);
        main_toolbar.setTitle("Teachers Video Page");
        main_toolbar.setTitleTextColor(Color.WHITE);
        setSupportActionBar(main_toolbar);
        Intent i=getIntent();
        final String userid=i.getIntExtra("user_id",0)+"";
        btnUpload= (Button) findViewById(R.id.btnUpload);
        lvVideos=(ListView)findViewById(R.id.lvVideos);
        btnLessons=(Button)findViewById(R.id.btnLessons);

        btnLessons.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(MainActivity.this,LessonsActivity.class);
                i.putExtra("userid1",userid);
                startActivity(i);
            }
        });

        btnUpload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent i=new Intent(MainActivity.this,UploadActivity.class);
                i.putExtra("userid2",userid);
                startActivity(i);
            }
        });

        Task t=new Task();
        t.execute("http://54.254.248.136:80/team-14/service/video/getVideo.php",userid);

    }
    public class Task extends AsyncTask<String,Void,String>{

        @Override
        protected String doInBackground(String... params) {

            String data = null;
            try {
                data = URLEncoder.encode("teacherid", "UTF-8")
                        + "=" + URLEncoder.encode(params[1], "UTF-8");

            } catch (UnsupportedEncodingException e) {
                e.printStackTrace();
            }
            BufferedReader reader=null;
            try
            {
                // Defined URL  where to send data
                //Log.d("T14",data);
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

                }
                jsonObject=new JSONObject(sb.toString());

                JSONArray cast = jsonObject.getJSONArray("video");
                for (int i=0; i<cast.length(); i++) {
                    JSONObject actor = cast.getJSONObject(i);
                    allTitles.add(actor.getString("title"));
                    allId.add(actor.getInt("id"));
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

            ArrayAdapter adapter=new ArrayAdapter<String>(context, android.R.layout.simple_expandable_list_item_1,allTitles);
            lvVideos.setAdapter(adapter);
        }
    }
}
