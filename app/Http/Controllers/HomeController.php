<?php
namespace App\Http\Controllers;
use App\Models\Food;
class HomeController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index']]);
    }
/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        return view('home');
    }
    public function getBMI()
    {
        return view('home.bmi');
    }
    public function postBMI()
    {
        return view('home.bmi');
    }
    public function getFoods()
    {
        $data['foods'] = Food::all();
        return view('home.foods',$data);
    }
    public function postFoods()
    {
        return view('home.foods');
    }
    public function getExercise()
    {
        return view('home.exercises');
    }
    public function postExercise()
    {
        return view('home.exercises');
    }
    public function getReport(){
        return view('home.report');
    }
}
