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
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStreamWriter;
import java.io.UnsupportedEncodingException;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.ArrayList;

public class LessonsActivity extends AppCompatActivity {

    Context context=this;
    ListView lvLessons;
    Toolbar lesson_toolbar;
    String p;
    ArrayList<String> lTitle=new ArrayList<>();
    ArrayList<Integer> lId=new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_lessons);

        Intent i=getIntent();
        final String userid=i.getStringExtra("userid1");
        //Log.d("teacher_id",userid+"");
        lvLessons= (ListView) findViewById(R.id.lvLessons);
        lesson_toolbar= (Toolbar) findViewById(R.id.lessons_toolbar);
        lesson_toolbar.setTitle("Lessons Uploaded");
        lesson_toolbar.setTitleTextColor(Color.WHITE);
        setSupportActionBar(lesson_toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);


        Task t=new Task();
        t.execute("http://54.254.248.136:80/team-14/service/feedback/getLPlist.php",userid);

        lvLessons.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent intent=new Intent(LessonsActivity.this,LessonDisplay.class);
                intent.putExtra("l_id1",position);
                intent.putExtra("pi",p);
                intent.putExtra("userid3",userid);
                startActivity(intent);
            }
        });
    }

    public class Task extends AsyncTask<String,Void,String> {

        @Override
        protected String doInBackground(String... params) {

            String data = null;
            try {
                data = URLEncoder.encode("teacherid", "UTF-8") + "=" + URLEncoder.encode(params[1], "UTF-8");
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
                p=sb.toString();
                JSONObject jsonObject=new JSONObject(sb.toString());

                JSONArray cast = jsonObject.getJSONArray("list");
                for (int i=0; i<cast.length(); i++) {
                    JSONObject actor = cast.getJSONObject(i);
                    lTitle.add(actor.getString("name"));
                    lId.add(actor.getInt("id"));
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
            ArrayAdapter adapter=new ArrayAdapter<String>(context, android.R.layout.simple_expandable_list_item_1,lTitle);
            lvLessons.setAdapter(adapter);
            cancel(true);
        }
    }
}
