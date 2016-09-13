<?php
namespace App\Http\Controllers;

use App\Models\BMI;
use App\Models\Exercise;
use App\Models\Food;
use Illuminate\Http\Request;
use Session;

class UserController extends Controller
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
//Display
    public function displayBMI(Request $request)
    {
        $input = $request->all();
        if (!empty($input)) {
            // var_dump($input);
            $calBMI = $this->calBMI($input["weight"], $input["height"], $input["age"], $input["gender"]);
            if (is_numeric($calBMI)) {
                $detail = $this->retrieveBMI($calBMI);
                // var_dump($detail);
                return view('user.bmi', ['detail' => $detail, 'bmi' => $calBMI]);
            } else {
                return view('user.bmi', ['error' => $calBMI]);
            }
        } else {
            // return var_dump(view('user.bmi'));
            return view('user.bmi');
        }
    }
    public function displayBMR(Request $request)
    {
        $input = $request->all();
        if (!empty($input)) {
            // var_dump($input);
            $calBMI = $this->calBMR($input["weight"], $input["height"], $input["age"], $input["gender"]);
            if (is_numeric($calBMI)) {
                return view('user.bmr', ['bmi' => $calBMI]);
            } else {
                return view('user.bmr', ['error' => $calBMI]);
            }
        } else {
            return view('user.bmr');
        }
    }
    public function displayFoods(Request $request)
    {
        $foods = Food::all();
        $input = $request->all();
        $data  = ['foods' => $foods];
        if (!empty($input)) {
            if (isset($input['del'])) {
                $this->delFood($input['del']);
                return redirect('/foods-calculator');
            }
            if ($request->session()->has('foodList')) {
                $list = $request->session()->get('foodList');
            } else {
                $list = array('total' => 0);
            }
// var_dump($input);
            // var_dump($list);
            $foodList = $input['list'];
            foreach ($foodList as $key => $value) {
// var_dump($value);
                if (isset($value['id'])) {
                    $amount  = isset($list[$value['id']]['amount']) ? $list[$value['id']]['amount'] + $value['amount'] : $value['amount'];
                    $calFood = $this->calFood($value['id'], $amount);
// var_dump($calFood);
                    if (is_numeric($calFood)) {
                        $list[$value['id']]['name']    = $value['name'];
                        $list[$value['id']]['calorie'] = $value['kcal'];
                        $list[$value['id']]['total']   = $calFood;
                        if (isset($list[$value['id']]['amount'])) {
                            $list[$value['id']]['amount'] += $value['amount'];
                        } else {
                            $list[$value['id']]['amount'] = 0;
                            $list[$value['id']]['amount'] += $value['amount'];
                        }
                    } else {
                        $data['error'] = $calFood;
                        return view('user.foods', $data);
                    }
                }
            }
            $total = 0;
            foreach ($list as $key => $value) {
                if ($key !== "total") {
                    $total += $value["amount"] * $value["calorie"];
                }
            }
            $list['total'] = $total;
            $request->session()->put('foodList', $list);
            return view('user.foods', $data);
        } else {
            return view('user.foods', $data);
        }
    }
    public function displayExercises(Request $request)
    {
        $exercises = Exercise::all();
        $input     = $request->all();
        $data      = ['exercises' => $exercises];
        if (!empty($input)) {
            if (isset($input['del'])) {
                $this->delExercise($input['del']);
                return redirect('/exercises-calculator');
            }
            if ($request->session()->has('exerciseList')) {
                $list = $request->session()->get('exerciseList');
            } else {
                $list = array('total' => 0);
            }
            // var_dump($list);
            if (isset($input['id'])) {
                $exercise    = Exercise::find($input['id']);
                $time        = ($input['hours'] * 60) + $input['minutes'];
                $calExercise = $this->calExercise($input['id'], $input['weight'], $time);
                if (is_numeric($calExercise)) {
                    $list[$input['id']]['name'] = $exercise->name;
                    $list[$input['id']]['kcal'] = $calExercise;
                    $list[$input['id']]['mins'] = $time;
                } else {
                    $data['error'] = $calExercise;
                    return view('user.exercises', $data);
                }
            }
            $total = 0;
            foreach ($list as $key => $value) {
                if ($key !== "total") {
                    $total += $value["kcal"];
                }
            }
            $list['total'] = $total;
            $request->session()->put('exerciseList', $list);
            return view('user.exercises', $data);
        } else {
            return view('user.exercises', $data);
        }
    }
//Process
    public function delFood($id)
    {
        if (Session::has('foodList')) {
            $list = Session::get('foodList');
            if (isset($list[$id])) {
                $list['total'] = $list['total'] - $list[$id]['total'];
            }
        } else {
            $list = array('total' => 0);
            unset($list[$id]);
            Session::put('exerciseList', $list);
            return false;
        }
        unset($list[$id]);
        Session::put('foodList', $list);
        return true;
    }
    public function delExercise($id)
    {
        if (Session::has('exerciseList')) {
            $list = Session::get('exerciseList');
            if (isset($list[$id])) {
                $list['total'] = $list['total'] - $list[$id]['kcal'];
            }
        } else {
            $list = array('total' => 0);
            unset($list[$id]);
            Session::put('exerciseList', $list);
            return false;
        }
        unset($list[$id]);
        Session::put('exerciseList', $list);
        return true;
    }
    public function calBMI($w, $h, $a, $g)
    {
        if ($g === 0 || $g === null || $g === "") {
            return "Gender is missing";
        }
        if ($a === 0 || $a === null || $a === "") {
            return "Age is missing";
        }
        if ($w === 0 || $w === null || $w === "") {
            return "Weight is missing";
        }
        if ($h === 0 || $h === null || $h === "") {
            return "Height is missing";
        }
        $hm  = $h / 100;
        $cal = $w / ($hm * $hm);
        return round($cal, 2);
    }
    public function retrieveBMI($bmi)
    {
        if ($bmi >= 40) {
            $bmi = BMI::find(1);
            return $bmi->detail;
        } else if ($bmi >= 35) {
            $bmi = BMI::find(2);
            return $bmi->detail;
        } else if ($bmi >= 28.5) {
            $bmi = BMI::find(3);
            return $bmi->detail;
        } else if ($bmi >= 23.5) {
            $bmi = BMI::find(4);
            return $bmi->detail;
        } else if ($bmi >= 18.5) {
            $bmi = BMI::find(5);
            return $bmi->detail;
        } else {
            $bmi = BMI::find(6);
            return $bmi->detail;
        }
    }
    public function calBMR($w, $h, $a, $g)
    {
        if ($g === 0 || $g === null || $g === "") {
            return "Gender is missing";
        }
        if ($a === 0 || $a === null || $a === "") {
            return "Age is missing";
        }
        if ($w === 0 || $w === null || $w === "") {
            return "Weight is missing";
        }
        if ($h === 0 || $h === null || $h === "") {
            return "Height is missing";
        }
        $cal = 0;
        if ($g === '1') {
            $cal = (13.937 * $w) + (4.799 * $h) - (5.677 * $a) + 88.362;
        } else if ($g === '2') {
            $cal = (9.247 * $w) + (3.098 * $h) - (4.330 * $a) + 447.593;
        }
        return round($cal, 2);
    }
    public function calFood($id, $amount)
    {
        if ($id === 0 || $id === null || $id === "") {
            return "Id is missing";
        }
        if ($amount === 0 || $amount === null || $amount === "" || $amount < 0) {
            return "Amount is missing";
        }
        $food = Food::find($id);
        if ($food !== null) {
            return $food->kcal * $amount;
        } else {
            return "No food in database";
        }
    }
    public function calExercise($id, $weight, $time)
    {
        if ($id === 0 || $id === null || $id === "") {
            return "Id is missing";
        }
        if ($weight === 0 || $weight === null || $weight === "" || $weight === "0") {
            return "Weight is missing";
        }
        if ($time === 0 || $time === null || $time === "") {
            return "Time is missing";
        }
        $exercise = Exercise::find($id);
        if ($exercise !== null) {
            return ($exercise->kcal * $time * $weight) / 2000;
        } else {
            return "No exercise in database";
        }
    }
}
