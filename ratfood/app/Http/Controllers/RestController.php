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
            "image" => "string",
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
            "image" => "string",
            "hours" => "required|string",
        ]);

        if ($req->fails()) {
            return response()->json($req->errors()->toJson(), 400);
        }

        $updates = Restaurant::where("_id", '=', $id)->update([
            "name" => $request['name'],
            "description" => $request['description'],
            "grade" => $request['grade'],
            "localization" => $request['localization'],
            "phone_number" => $request['phone_number'],
            "website" => $request['website'],
            "image" => $request['image'],
            "hours" => $request['hours'],
        ]);

        if($updates)
        {
            return response()->json([
                'message' => 'Rest changed',
            ], 200);
        }
        return response()->json([
            'message' => "Rest do not exist"
        ], 400);
    }

    /**
     * Delete Restaurants
     */
    public function deleteRestaurant($id)
    {
        $rest = Restaurant::where("_id", '=', $id)->delete();

        if ($rest) {
            return response()->json([
                'message' => 'Rest deleted',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Rest do not exist',
            ], 400);
        }
    }


    /**
     * Restaurants
     */
    public function allRestaurants()
    {
        return response()->json(Restaurant::all());
    }
}
