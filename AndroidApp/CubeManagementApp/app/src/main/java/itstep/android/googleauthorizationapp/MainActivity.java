package itstep.android.googleauthorizationapp;


import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.util.Log;
import android.widget.Toast;

import androidx.activity.result.ActivityResult;
import androidx.activity.result.ActivityResultCallback;
import androidx.activity.result.ActivityResultLauncher;
import androidx.activity.result.contract.ActivityResultContracts;
import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.AppCompatButton;

import com.google.android.gms.auth.api.signin.GoogleSignIn;
import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInClient;
import com.google.android.gms.auth.api.signin.GoogleSignInOptions;
import com.google.android.gms.common.api.ApiException;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthCredential;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.auth.GoogleAuthProvider;

import java.util.Objects;

public class MainActivity extends AppCompatActivity {
    public static final String TAG = "GoogleSignIn";
    public static final int PW_SIGN_IN = 123;

    private AppCompatButton btnSignIn;
    private GoogleSignInClient mGoogleSignInClient;
    private FirebaseAuth mAuth;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //startActivity(new Intent(MainActivity.this, ProfileActivity.class));

        btnSignIn = findViewById(R.id.btnLogIn);
        mAuth = FirebaseAuth.getInstance();
        requestGoogleSignIn();

        btnSignIn.setOnClickListener(view -> {
            signIn();
        });
    }

    @Override
    protected void onStart() {
        super.onStart();
        FirebaseUser user = mAuth.getCurrentUser();
        if(user != null) {
            startActivity(new Intent(MainActivity.this, ProfileActivity.class));
        }
    }

    private void requestGoogleSignIn() {
        GoogleSignInOptions googleSignInOptions = new GoogleSignInOptions.Builder(GoogleSignInOptions.DEFAULT_SIGN_IN)
                .requestIdToken("220428617520-htqra0hmgr6ffckit5f8ct4u40vkvc3h.apps.googleusercontent.com")
                .requestEmail()
                .build();
        mGoogleSignInClient = GoogleSignIn.getClient(this, googleSignInOptions);
    }

    private void signIn() {
        Intent signInIntent = mGoogleSignInClient.getSignInIntent();
        signInActivityResultLauncher.launch(signInIntent);
    }

    private ActivityResultLauncher<Intent> signInActivityResultLauncher = registerForActivityResult(
            new ActivityResultContracts.StartActivityForResult(),
            new ActivityResultCallback<ActivityResult>() {
                @Override
                public void onActivityResult(ActivityResult result) {
                    if(result.getResultCode() == Activity.RESULT_OK) {
                        Intent data = result.getData();
                        Task<GoogleSignInAccount> task = GoogleSignIn.getSignedInAccountFromIntent(data);
                        try{
                            GoogleSignInAccount googleSignInAccount  = task.getResult(ApiException.class);
                            firebaseAuthWithGoogle(googleSignInAccount.getIdToken()); //  токен гугл аккаунта
                            String userName = googleSignInAccount.getDisplayName();
                            String userEmail = googleSignInAccount.getEmail();
                            String userPhoto = Objects.requireNonNull(googleSignInAccount.getPhotoUrl()).toString();
                            SharedPreferences.Editor editor = getApplicationContext()
                                    .getSharedPreferences("MyPrefs", MODE_PRIVATE).edit();

                            editor.putString("userName", userName);
                            editor.putString("userEmail", userEmail);
                            editor.putString("userPhoto", userPhoto);

                            editor.apply();

                            Log.e(TAG ,"on Activity Result Success");
                        } catch (ApiException e) {
                            Log.e(TAG ,"on Activity Result Error: " + e.getMessage());
                        }
                    }
                }
            }
    );

    private void firebaseAuthWithGoogle(String idToken) {
        AuthCredential credential = GoogleAuthProvider.getCredential(idToken, null);
        mAuth.signInWithCredential(credential)
                .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if(task.isSuccessful()) {
                            Log.e(TAG ,"Sign In success");
                            startActivity(new Intent(MainActivity.this, ProfileActivity.class));
                        } else {
                            Toast.makeText(MainActivity.this, "User authenticate error", Toast.LENGTH_SHORT).show();
                        }
                    }
                });
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent date) {
        super.onActivityResult(requestCode, resultCode, date);
    }
}