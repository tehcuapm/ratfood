package com.example.ratfoodapp.views;

import android.content.Intent;
import android.os.Bundle;

import com.example.ratfoodapp.R;
import com.google.android.material.snackbar.Snackbar;

import androidx.appcompat.app.AppCompatActivity;

import android.view.View;
import android.widget.Button;

import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.AppBarConfiguration;
import androidx.navigation.ui.NavigationUI;

import com.example.ratfoodapp.databinding.ActivityRegisterBinding;

public class ChangeActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        Button btn_rest = (Button) findViewById(R.id.btn_restaurant);
        btn_rest.setOnClickListener(view -> startActivity(new Intent(ChangeActivity.this, RestaurantsActivity.class)));

        Button btn_prof = (Button) findViewById(R.id.btn_profil);
        btn_prof.setOnClickListener(view -> startActivity(new Intent(ChangeActivity.this, Profil.class)));
    }


}