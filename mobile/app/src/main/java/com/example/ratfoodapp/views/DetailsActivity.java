package com.example.ratfoodapp.views;

import android.os.Bundle;
import android.view.Menu;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.appcompat.app.AppCompatActivity;

import com.bumptech.glide.Glide;
import com.example.ratfoodapp.R;
import com.example.ratfoodapp.api.ApiBuilder;
import com.example.ratfoodapp.api.MenusApi;
import com.example.ratfoodapp.models.Menus;

import java.util.List;

import retrofit2.Call;

public class DetailsActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_details);


        ImageView imageView = findViewById(R.id.poster_image);
        TextView rating_tv = findViewById(R.id.mRating);
        TextView title_tv = findViewById(R.id.mTitle);
        TextView overview_tv = findViewById(R.id.rest_desc);

        Bundle bundle = getIntent().getExtras();

        String mTitle = bundle.getString("title");
        String mPoster = bundle.getString("poster");
        String mOverView = bundle.getString("overview");
        String mRating = bundle.getString("rating");

        Glide.with(this).load(mPoster).into(imageView);
        rating_tv.setText(mRating);
        title_tv.setText(mTitle);
        overview_tv.setText(mOverView);
    }

    public void callRest() {
        MenusApi menusApi = ApiBuilder.builderAPI().create(MenusApi.class);
        Call<List<Menus>> call = menusApi.getMenus();
    }
}