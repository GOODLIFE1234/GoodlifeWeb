<?php
namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Food;
use App\User;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
    public function __construct()
    {
        $this->middleware('authAdmin',['except' => ['index','postLogin']]);
    }
/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        return view('admin.login');
    }

    public function displayUserList()
    {
        $users = User::take(10)->get();
        return json_encode($users);
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user !== null) {
            return true;
        } else {
            return false;
        }
    }
    public function searchUser($name, $surname)
    {
        $user  = new User();
        $userN = null;
        $userS = null;
        if ($name !== '') {
            $userN = $user->where('name', 'like', "%$name%")->get();
        }
        if ($surname !== '') {
            $userS = $user->where('surname', 'like', "%$surname%")->get();
        }

        // ->orWhere('surname', 'like', "%$surname%")
        // ->take(10)
        // $merged = $userName->merge($userSurname);
        if ($userN === null) {
            $merged = $userS;
        }
        if ($userS === null) {
            $merged = $userN;
        }
        if ($userS !== null && $userN !== null) {
            $merged = $userN->merge($userS);
        }

        if ($merged !== null && !$merged->isEmpty()) {
            return json_encode($merged);
        } else {
            return "No User";
        }
    }
    /*BreakPoint*/
    /*Login*/
    public function postLogin(Request $request)
    {
        if ($request->has('username') && $request->has('password')) {
            if ($request->username === "admin" && $request->password === "1234") {
                Session::put('admin',true);
                return redirect('admin/users');
            }
        }
        return redirect('admin/');
    }
    /*Users*/
    public function getUsers(Request $request)
    {
        $skip = 0;
        if (isset($request->p) && is_numeric($request->p)) {
            $skip = $request->p;
        }

        $data   = new User;
        $search = "";
        if (isset($request->n)) {
            $search = $request->n;
            $data   = $data
                ->where('name', 'like', "%$search%")
                ->orWhere('surname', 'like', "%$search%")
                ->skip($skip)->take(25)->get();
        } else {
            $data = $data
                ->skip($skip)->take(25)->get();
        }

        // echo var_dump($data);
        $attach          = array();
        $attach["users"] = $data;
        return view('admin.users', $attach);
    }
    public function getEditUser($id)
    {
        if (is_numeric($id)) {
            $food = Food::find($id);
            return view('admin.editFood', ['food' => $food]);
        }
        return redirect('admin/foods');
    }
    public function getDeleteUser($id)
    {
        // $skip = 0;
        // if (isset($request->p) && is_numeric($request->p)) {
        //     $skip = $request->p;
        // }
        // $data            = User::skip($skip)->take(25)->get();
        // $attach          = array();
        // $attach["users"] = $data;
        $user = User::find($id);
        $user->delete();
        return redirect('admin/users');
    }
    public function postUpdateFUser(Request $request)
    {
        try {
            $new       = new Food();
            $new->name = $request->input("name");
            $new->kcal = $request->input("kcal");
            $new->save();
            return redirect('admin/foods');
        } catch (Exception $e) {
            return redirect('admin/foods');
        }
    }
    /*Food Methods*/
    public function getFoods()
    {
        $skip = 0;
        if (isset($request->p) && is_numeric($request->p)) {
            $skip = $request->p;
        }
        $data            = Food::skip($skip)->take(25)->get();
        $attach          = array();
        $attach["foods"] = $data;
        return view('admin.foods', $attach);
    }
    public function getAddFood()
    {
        return view('admin.addFood');
    }
    public function getEditFood($id)
    {
        if (is_numeric($id)) {
            $food = Food::find($id);
            return view('admin.editFood', ['food' => $food]);
        }
        return redirect('admin/foods');
    }
    public function getDeleteFood($id)
    {
        if (is_numeric($id)) {
            $food = Food::find($id);
            $food->delete();
        }
        return redirect('admin/foods');
    }
    public function postAddFood(Request $request)
    {
        try {
            $new       = new Food();
            $new->name = $request->input("name");
            $new->kcal = $request->input("kcal");
            $new->save();
            return redirect('admin/foods');
        } catch (Exception $e) {
            return redirect('admin/foods');
        }
    }
    public function postUpdateFood(Request $request)
    {
        try {
            $id = null;
            if ($request->has('id')) {
                $id = $request->input('id');
            } else {
                return redirect('admin/foods');
            }
            $old = Food::find($id);
            if (is_null($old)) {
                return redirect('admin/foods');
            }
            $old->name = $request->input("name");
            $old->kcal = $request->input("kcal");
            $old->save();
            return redirect('admin/foods');
        } catch (Exception $e) {
            // return redirect('admin/foods');s
        }
    }
    /*Exercise*/
    public function getExercises()
    {
        $skip = 0;
        if (isset($request->p) && is_numeric($request->p)) {
            $skip = $request->p;
        }
        $data                = Exercise::skip($skip)->take(25)->get();
        $attach              = array();
        $attach["exercises"] = $data;
        return view('admin.exercises', $attach);
    }
    public function getAddExercise()
    {
        return view('admin.addFood');
    }
    public function getEditExercise($id)
    {
        if (is_numeric($id)) {
            $exercise = Exercise::find($id);
            return view('admin.editExercise', ['exercise' => $exercise]);
        }
        return redirect('admin/exercises');
    }
    public function getDeleteExercise($id)
    {
        if (is_numeric($id)) {
            $exercise = Exercise::find($id);
            $exercise->delete();
        }
        return redirect('admin/exercises');
    }
    public function postAddExercise(Request $request)
    {
        try {
            $new       = new Exercise();
            $new->name = $request->input("name");
            $new->kcal = $request->input("kcal");
            $new->save();
            return redirect('admin/exercises');
        } catch (Exception $e) {
            return redirect('admin/exercises');
        }
    }
    public function postUpdateExercise(Request $request)
    {
        try {
            $new       = new Exercise();
            $new->name = $request->input("name");
            $new->kcal = $request->input("kcal");
            $new->save();
            return redirect('admin/exercises');
        } catch (Exception $e) {
            return redirect('admin/exercises');
        }
    }
}
