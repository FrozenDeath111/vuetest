<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\LikedFood;
use App\Models\User;
use App\Models\Workplace;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function userInfo()
    {
        $users = User::all();
        $likedFoods = LikedFood::all();
        return response()->json([
            "users" => $users,
            "foods" => $likedFoods,
        ]);
    }

    public function getChoices()
    {
        $workplaces = Workplace::all();
        $foods = Food::all();

        return response()->json([
            "workplaces" => $workplaces,
            "foods" => $foods,
        ]);
    }

    public function insertUser(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->roll = $request->roll;
        $user->workplace = $request->workplace;

        try {
            //code...
            $user->save();
            foreach ($request->foods as $food) {
                $likedFoods = new LikedFood();
                $likedFoods->user_id = $user->id;
                $likedFoods->food_id = $food;

                $likedFoods->save();
            }
            return response()->json([
                "status" => "success",
                "message" => "Data Inserted Successfully",
                "code" => 200,
            ]);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage(),
                "code" => 400,
            ]);
        }
    }
}
