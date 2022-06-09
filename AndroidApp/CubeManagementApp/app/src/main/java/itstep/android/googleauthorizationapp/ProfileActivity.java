package itstep.android.googleauthorizationapp;

import androidx.appcompat.app.AppCompatActivity;

import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.firebase.auth.FirebaseAuth;

import java.util.HashMap;
import java.util.Map;

import javax.net.ssl.HttpsURLConnection;

public class ProfileActivity extends AppCompatActivity {
    RequestQueue requestQueue;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);



        TextView tvUserName = findViewById(R.id.userName);
        TextView tvUserEmail = findViewById(R.id.userEmail);
        Button btnLogOut = findViewById(R.id.btnLogOut);


        SharedPreferences preferences = this.getSharedPreferences("MyPrefs", MODE_PRIVATE);
        String userName = preferences.getString("userName", "-");
        String userEmail = preferences.getString("userEmail", "-");

        tvUserName.setText(userName);
        tvUserEmail.setText(userEmail);

        btnLogOut.setOnClickListener(view -> {
            FirebaseAuth.getInstance().signOut();
            startActivity(new Intent(ProfileActivity.this, MainActivity.class));
        });

        Button btnAnimation1 = findViewById(R.id.btnAnimation1);
        Button btnAnimation2 = findViewById(R.id.btnAnimation2);
        Button btnAnimation3 = findViewById(R.id.btnAnimation3);
        Button btnTime = findViewById(R.id.btnTime);
        Button btnDate= findViewById(R.id.btnDate);
        Button btnSwitchOff= findViewById(R.id.btnSwitchOff);

        TextView tvCubeActionText = findViewById(R.id.cubeActionText);

        btnAnimation1.setOnClickListener(view -> {

            requestQueue = Volley.newRequestQueue(ProfileActivity.this);
            postUsingVolley("animation1","a1");
            tvCubeActionText.setText("Animation №1");
        });
        btnAnimation2.setOnClickListener(view -> {
            requestQueue = Volley.newRequestQueue(ProfileActivity.this);
            postUsingVolley("animation2","a2");
            tvCubeActionText.setText("Animation №2");
        });
//        btnAnimation2.setOnClickListener(new View.OnClickListener()  {
//            @Override
//            public void onClick(View v){
//                String url= "https://netedut.com/netedut.com/sstahnuk/TelegramBot/php/appMessaging.php";
//                StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
//                        new Response.Listener<String>() {
//                            @Override
//                            public void onResponse(String response) {
//                                Toast.makeText(ProfileActivity.this, response.trim(), Toast.LENGTH_SHORT).show();
//                            }
//                        },
//                        new Response.ErrorListener()
//                        {
//                            @Override
//                            public void onErrorResponse(VolleyError error) {
//                                Toast.makeText(ProfileActivity.this, error.toString(), Toast.LENGTH_SHORT).show();
//                            }
//                        }){
//                    @Override
//                    protected Map<String,String> getParams(){
//                        Map<String,String> params = new HashMap<String,String>();
//                        params.put("animation2","a2");
//                        return params;
//                    }
//                };
//                RequestQueue requestQueue = Volley.newRequestQueue(ProfileActivity.this);
//                requestQueue.add(stringRequest);
//            }
//        });
        btnAnimation3.setOnClickListener( new View.OnClickListener(){
            @Override
            public void onClick(View v){
                requestQueue = Volley.newRequestQueue(ProfileActivity.this);
                postUsingVolley("animation3","a3");
                tvCubeActionText.setText("Animation №3");
            }
        });
        btnTime.setOnClickListener(view -> {
            requestQueue = Volley.newRequestQueue(ProfileActivity.this);
            postUsingVolley("time","t");
            tvCubeActionText.setText("Time");
        });
//        btnTime.setOnClickListener(view -> {
//            try {
//                RequestQueue MyRequestQueue = Volley.newRequestQueue(this);
//                String url = "https://netedut.com/netedut.com/sstahnuk/TelegramBot/php/appMessaging.php";
//                StringRequest MyStringRequest = new StringRequest(Request.Method.POST, url, new Response.Listener<String>() {
//                    @Override
//                    public void onResponse(String response) {
//                        //This code is executed if the server responds, whether or not the response contains data.
//                        //The String 'response' contains the server's response.
//                    }
//                }, new Response.ErrorListener() { //Create an error listener to handle errors appropriately.
//                    @Override
//                    public void onErrorResponse(VolleyError error) {
//                        //This code is executed if there is an error.
//                    }
//                }) {
//                    protected Map<String, String> getParams() {
//                        Map<String, String> MyData = new HashMap<String, String>();
//                        MyData.put("time", "t"); //Add the data you'd like to send to the server.
//                        return MyData;
//                    }
//                };
//
//            MyRequestQueue.add(MyStringRequest);
//            }
//            catch (Exception e) {
//                Toast.makeText(ProfileActivity.this, e.getMessage(),Toast.LENGTH_SHORT).show();
//            }
//            tvCubeActionText.setText("Time");
//        });
        btnDate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                requestQueue = Volley.newRequestQueue(ProfileActivity.this);
                postUsingVolley("date","d");
                tvCubeActionText.setText("Date");
            }
        }
        );
        btnSwitchOff.setOnClickListener(view -> {
            requestQueue = Volley.newRequestQueue(ProfileActivity.this);
            postUsingVolley("off","off");
            tvCubeActionText.setText("Switched off");
        });

    }

    public void postUsingVolley(String action, String value) {

        final ProgressDialog pDialog = new ProgressDialog(ProfileActivity.this);
        pDialog.setMessage("Sending datas ...");
        pDialog.show();

        RequestQueue queue = Volley.newRequestQueue(ProfileActivity.this);
        StringRequest request = new StringRequest(Request.Method.POST, "https://netedut.com/netedut.com/sstahnuk/TelegramBot/php/appMessaging.php", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

                Log.i("My success",""+response);
                pDialog.dismiss();
                if(response.equalsIgnoreCase("true")) {

                    Toast.makeText(ProfileActivity.this, "Data Uploaded", Toast.LENGTH_SHORT).show();
                }else
                {
                    //credential not match
                    Toast.makeText(ProfileActivity.this,"Data was written",Toast.LENGTH_LONG).show();
                }
            }

        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {

                Toast.makeText(ProfileActivity.this, "my error :"+error, Toast.LENGTH_LONG).show();
                Log.i("My error",""+error);
            }
        }){
            @Override
            protected Map<String, String> getParams() {

                final HashMap<String, String> postParams = new HashMap<String, String>();
                postParams.put(action, value);
                return postParams;
            }
        };
        queue.add(request);
    }
}