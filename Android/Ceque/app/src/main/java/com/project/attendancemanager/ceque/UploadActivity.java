package com.project.attendancemanager.ceque;

import android.content.Context;
import android.content.Intent;
import android.database.Cursor;
import android.graphics.Color;
import android.net.Uri;
import android.provider.MediaStore;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.ImageButton;
import android.widget.Toast;

public class UploadActivity extends AppCompatActivity {

    ImageButton ibUpload,ibLessons;
    String videoPath="";
    Toolbar upload_toolbar;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_upload);
        Intent i=getIntent();
        String userid=i.getStringExtra("userid2");

        ibLessons= (ImageButton) findViewById(R.id.ibLesson);
        ibUpload= (ImageButton) findViewById(R.id.ibUpload);
        upload_toolbar= (Toolbar) findViewById(R.id.upload_toolbar);
        upload_toolbar.setTitle("UploadS");
        upload_toolbar.setTitleTextColor(Color.WHITE);
        setSupportActionBar(upload_toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);
        ibUpload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(Intent.ACTION_PICK);
                intent.setType("video/*");
                intent.setAction(Intent.ACTION_GET_CONTENT);
                startActivityForResult(Intent.createChooser(intent, "Select Video"), 111 );
            }
        });

    }

    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        // After camera screen this code will excuted

        if (requestCode == 111) {

            if (resultCode == RESULT_OK) {
                Uri uri = data.getData();
                String realpath = getRealPathFromURI(this, uri);
                Toast.makeText(this, ""+realpath, Toast.LENGTH_SHORT).show();
            }
        }
    }
    public String getRealPathFromURI(Context context, Uri contentUri) {
        Cursor cursor = null;
        try {
            String[] proj = { MediaStore.Images.Media.DATA };
            cursor = context.getContentResolver().query(contentUri,  proj, null, null, null);
            int column_index = cursor.getColumnIndexOrThrow(MediaStore.Images.Media.DATA);
            cursor.moveToFirst();
            return cursor.getString(column_index);
        } finally {
            if (cursor != null) {
                cursor.close();
            }
        }
    }
}
