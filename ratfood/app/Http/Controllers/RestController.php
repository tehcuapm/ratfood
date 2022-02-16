<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use Validator;

class RestController extends Controller
{


    /**
     * Create Restaurant
     */
    public function createRestaurant(Request $request)
    {
        $req = Validator::make($request->all(), [
            "name" => "required|string",
            "description" => "required|string",
            "grade" => "required|numeric",
            "localization" => "required|string",
            "phone_number" => "required|string",
            "website" => "required|string",
            "hours" => "required|string",
        ]);

        if ($req->fails()) {
            return response()->json($req->errors()->toJson(), 400);
        }
        Restaurant::create($req->validated());

        return response()->json([
            'message' => 'Rest created',
        ], 201);
    }

    /**
     * Change Restaurant
     */
    public function putRestaurant(Request $request, $id)
    {
        $req = Validator::make($request->all(), [
            "name" => "required|string",
            "description" => "required|string",
            "grade" => "required|numeric",
            "localization" => "required|string",
            "phone_number" => "required|string",
            "website" => "required|string",
            "hours" => "required|string",
        ]);

        if ($req->fails()) {
            return response()->json($req->errors()->toJson(), 400);
        }

        $test = Restaurant::all()->where('_id', $id);
        dd($test);

        return response()->json([
            'message' => 'Rest changed',
        ], 200);
    }

    /**
     * Restaurants
     */
    public function allRestaurants()
    {
        return response()->json(Restaurant::all());
    }
}
