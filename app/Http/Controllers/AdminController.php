<?php
namespace App\Http\Controllers;

class AdminController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
    public function __construct()
    {
        $this->middleware('auth');
    }
/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        return view('admin');
    }
    public function getUser()
    {
        $data           = User::all();
        $attach         = array();
        $attach["user"] = $data;
        return view('admin.users', $attach);
    }
    public function getFoods()
    {
        $data           = Food::all();
        $attach         = array();
        $attach["user"] = $data;
        return view('admin.foods', $attach);
    }
    public function postFoods($food)
    {
        try {
            $new       = new Food();
            $new->name = $food->name;
            $new->kcal = $food->kcal;
            $new - save();
            return redirect('foods');
        } catch (Exception $e) {
            return redirect('foods');
        }

    }
    public function getExercise()
    {
        $data           = Exercise::all();
        $attach         = array();
        $attach["user"] = $data;
        return view('admin.exercises', $attach);
    }
    public function postExercise($exercise)
    {
        try {
            $new       = new Exercise();
            $new->name = $exercise->name;
            $new->kcal = $exercise->kcal;
            $new - save();
            return redirect('exercises');
        } catch (Exception $e) {
            return redirect('exercises');
        }
    }
}
