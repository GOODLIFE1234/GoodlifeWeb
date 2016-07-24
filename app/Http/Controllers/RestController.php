<?php
namespace App\Http\Controllers;

use App\Models\Food;

class RestController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
/*    public function __construct()
{
$this->middleware('auth', ['only' => ['index']]);
}*/
/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
    public function getFoods()
    {
        $foods = Food::all();
        return json_encode($foods);
    }
    public function getExercises()
    {
        $foods = Food::all();
        return json_encode($foods);
    }
    public function getFoodPlanner($id)
    {
        $planner = FoodPlanner::where("user_id", "=", $id)->get();
        return json_encode($planner);
    }
    public function postFoodPlanner($food)
    {
        try {
            $data         = json_decode($food);
            $new          = new FoodPlanner();
            $new->user_id = $data->user_id;
            $new->food_id = $data->food_id;
            $new->amount  = $data->amount;
            $new - save();
            return $new->id;
        } catch (Exception $e) {
            return false;
        }
    }
    public function getExercisePlanner()
    {
        $planner = ExercisePlanner::where("user_id", "=", $id)->get();
        return json_encode($planner);
    }
    public function postExercisePlanner()
    {
        try {
            $data         = json_decode($food);
            $new          = new ExercisePlanner();
            $new->user_id = $data->user_id;
            $new->exercise_id = $data->exercise_id;
            $new->amount  = $data->amount;
            $new - save();
            return $new->id;
        } catch (Exception $e) {
            return false;
        }
    }
}
