<?php
namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodPlanner;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class MemberController extends Controller
{
/**
 * Create a new controller instance.
 *
 * @return void
 */
    protected $template      = null;
    protected $testData      = null;
    protected $testChallenge = null;
    protected $testReport    = null;
    public function __construct()
    {
        $this->template = [
            "Week"      => date('W'),
            "Monday"    => [
                "breakfast" => new \StdClass(),
                "lunch"     => new \StdClass(),
                "dinner"    => new \StdClass(),
                "snack"     => new \StdClass(),
            ],
            "Tuesday"   => [
                "breakfast" => new \StdClass(),
                "lunch"     => new \StdClass(),
                "dinner"    => new \StdClass(),
                "snack"     => new \StdClass(),
            ],
            "Wednesday" => [
                "breakfast" => new \StdClass(),
                "lunch"     => new \StdClass(),
                "dinner"    => new \StdClass(),
                "snack"     => new \StdClass(),
            ],
            "Thursday"  => [
                "breakfast" => new \StdClass(),
                "lunch"     => new \StdClass(),
                "dinner"    => new \StdClass(),
                "snack"     => new \StdClass(),
            ],
            "Friday"    => [
                "breakfast" => new \StdClass(),
                "lunch"     => new \StdClass(),
                "dinner"    => new \StdClass(),
                "snack"     => new \StdClass(),
            ],
            "Saturday"  => [
                "breakfast" => new \StdClass(),
                "lunch"     => new \StdClass(),
                "dinner"    => new \StdClass(),
                "snack"     => new \StdClass(),
            ],
            "Sunday"    => [
                "breakfast" => new \StdClass(),
                "lunch"     => new \StdClass(),
                "dinner"    => new \StdClass(),
                "snack"     => new \StdClass(),
            ],
        ];
        $this->middleware('auth', ['only' => ['displayProfile', 'displayFoodPlanner', 'displayBMR', 'displayChallenge', 'displayReport']]);
        $this->testData = [
            'Day'       => "Monday",
            'Breakfast' => 'Pizza:1=200Kcal',
            'Lunch'     => '-',
            'Dinner'    => '-',
            'Snack'     => '-',
            'BMR'       => '2000',
            'Calorie'   => '200',
            'Today'     => '1800',
        ];
        $this->testChallenge = "Today Challenge: 200cal Your Status Goal: 500 cal Today Distance: 50m Today Velocity: 5km/h Next Challenge: 550 cal";
        $this->testReport    = "Height: 175cm Weight: 80kg Age: 20 BMI: 21 “If you are overweight Dental Federation as diabetes, high cholesterol or trying to lose weight, a Document Name Good Life_TestPlan_V1.0 Owner PIS,WP Page 25/73 Document Type Test Plan Release Date 15/12/2016 Print Date 15/12/2016 body mass index lower than 23” BMR: 2000 Today Calorie: 0 Exercise: 100 cal Accelometer: 200cal Left: 2300";
    }
/**
 * Show the application dashboard.
 *
 * @return \Illuminate\Http\Response
 */

    public function displayProfile($id)
    {
        $data = User::find($id);
        if (Auth::user()->id != $id || $data === null) {
            return redirect('login');
        }
        $attach["user"] = $data;
        return view('user.profile', $attach);
    }
    public function createUser(User $user)
    {
        if ($user->name !== null &&
            $user->surname !== null &&
            $user->nickname !== null &&
            $user->email !== null) {
            return true;
        } else {
            return false;
        }
    }
    public function updateUser(User $user)
    {
        if ($user->id !== null &&
            $user->name !== null &&
            $user->surname !== null &&
            $user->nickname !== null &&
            $user->email !== null) {

            $update           = User::find($user->id);
            $update->name     = $user->name;
            $update->surname  = $user->surname;
            $update->nickname = $user->nickname;
            $update->email    = $user->email;
            // $update->save();

            return true;
        } else {
            return false;
        }
    }
    public function addFoodPlanner($id = null, $amount = null)
    {
        if ($id !== null &&
            $amount !== null) {
            $food = Food::find($id);
            if ($food !== null) {
                Session::put('foodPlanner', [$food->id => ['food' => $food, 'amount' => $amount]]);
                return true;
            }
        }
        return false;
    }
    public function delFoodPlanner($id = null, $amount = null)
    {
        if ($id !== null &&
            $amount !== null) {
            $food    = Food::find($id);
            $planner = Session::get('foodPlanner');
            if ($food !== null && $planner !== null) {
                Session::put('foodPlanner', [$food->id => null]);
                return true;
            }
        }
        return false;
    }
    public function displayBMR()
    {
        if (Auth::Check()) {
            $user    = Auth::user();
            $profile = $user->profile;
            return view('welcome', ['BMR' => $profile->bmr]);
        }
        return view('welcome');
    }
    public function displayFoods()
    {
        $planner = Session::get('planner');
        if ($planner !== null) {
            return view('welcome', ['planner' => $planner]);
        }
        return view('welcome');
    }
/**Progress 3*/
    public function displayChallenge()
    {
        if (Auth::Check()) {
            $auth = Auth::user();
            $user = User::find($auth->id);
            return view('user.challenge', ['user' => $user, 'test' => $this->testChallenge]);
        }
        return view('welcome');
    }
    public function displayReport()
    {
        if (Auth::Check()) {
            $auth = Auth::user();
            $user = User::find($auth->id);
            return view('user.report', ['user' => $user, 'test' => $this->testReport]);
        }
        return view('welcome');
    }
    public function saveChallenge($userId, $percent)
    {
        if ($userId === null && $percent === null) {
            return "Please input data";
        } else if ($userId === null) {
            return "User id is missing";
        } else if ($percent === null) {
            return "Percent is missing";
        }
        $data = User::find($userId);
        if ($data !== null) {
            $data->profile->percent = $percent;
        }
        return $percent;
    }
    public function saveProgress($userId, $distance)
    {
        if ($userId === null && $distance === null) {
            return "Please input data";
        } else if ($userId === null) {
            return "User id is missing";
        } else if ($distance === null) {
            return "Distance is missing";
        }
        $data = User::find($userId);
        if ($data !== null) {
            $data->profile->record += $distance;
        }
        return $distance;
    }
    public function notifyChallenge()
    {
        if (Auth::user() === null) {
            return "Please login";
        }
        $user = Auth::user();
        if ($user->profile->challenge <= $user->profile->record) {
            return "You have succeed the challenge";
        } else {
            return "";
        }
    }
/*Break Point*/
    public function displayAddFoods(Request $request)
    {
        $foods = Food::all();
        $input = $request->all();
        $data  = ['foods' => $foods];
        return view('user.fadd', $data);
    }
    public function postUpdateUser(Request $request)
    {
        if ($request->has('id') && $request->has('name') && $request->has('surname') && $request->has('nickname') && $request->has('email')) {
            $user           = User::find($request->id);
            $user->name     = $request->name;
            $user->surname  = $request->surname;
            $user->nickname = $request->nickname;
            $user->email    = $request->email;
            $user->save();
            return redirect()->action(
                'MemberController@displayProfile', ['id' => $user->id]
            );
        } else {
            return back()->with('error', 'Please insert all fields.');
        }
    }
    public function displayFoodPlanner()
    {
        $auth    = Auth::user();
        $rawUser = User::find($auth->id);
        $raw     = $rawUser->profile->raw;
        if ($raw === null || $raw === "") {
            $raw = $rawUser->profile->saveRaw();
        }
        Session::put("rawData", json_decode($raw));

        $planner = FoodPlanner::where('user_id', '=', Auth::user()->id)->first();
        if ($planner === null) {

            $planner            = new FoodPlanner();
            $planner->user_id   = Auth::user()->id;
            $planner->today     = json_encode($this->template);
            $planner->yesterday = json_encode($this->template);
            $planner->save();
        }
        $today       = json_decode($planner->today);
        $currentWeek = date('W');
        if ($today->Week !== $currentWeek) {
            $planner->yesterday = json_encode($today);
            $planner->today     = json_encode($this->template);
            $planner->save();
        }
        Session::put('today', json_decode($planner->today));
        Session::put('yesterday', json_decode($planner->yesterday));
        $attach = $this->testData;
        return view('user.fplanner', $attach);
    }
    public function displayFoodPlannerHistory()
    {
        $planner = FoodPlanner::where('user_id', '=', Auth::user()->id)->first();
        if ($planner === null) {
            $planner            = new FoodPlanner();
            $planner->user_id   = Auth::user()->id;
            $planner->today     = json_encode($this->template);
            $planner->yesterday = json_encode($this->template);
            $planner->save();
        }
        $today       = json_decode($planner->today);
        $currentWeek = date('W');
        if ($today->Week !== $currentWeek) {
            $planner->yesterday = json_encode($today);
            $planner->today     = json_encode($this->template);
            $planner->save();
        }
        Session::put('today', json_decode($planner->today));
        Session::put('yesterday', json_decode($planner->yesterday));
        $attach = $this->testData;
        return view('user.history', $attach);
    }
    public function postAddFoodPlanner(Request $request)
    {
        $today   = date('l');
        $planner = Session::get('today');
        $data    = FoodPlanner::where('user_id', '=', Auth::user()->id)->first();
        if ($data) {
            if ($request->has('time') && $request->has('list')) {
                $foodList = $request->list;
                $time     = $request->time;
                if ($time === '1') {
                    foreach ($foodList as $key => $value) {
                        if (isset($value['id'])) {
                            $planner->$today->breakfast->$value['id'] = $value;
                        }
                    }
                } else if ($time === '2') {
                    foreach ($foodList as $key => $value) {
                        if (isset($value['id'])) {
                            $planner->$today->lunch->$value['id'] = $value;
                        }
                    }
                } else if ($time === '3') {
                    foreach ($foodList as $key => $value) {
                        if (isset($value['id'])) {
                            $planner->$today->dinner->$value['id'] = $value;
                        }
                    }
                } else if ($time === '4') {
                    foreach ($foodList as $key => $value) {
                        if (isset($value['id'])) {
                            $planner->$today->snack->$value['id'] = $value;
                        }
                    }
                }
                $data->today = json_encode($planner);
                $data->save();
                Session::put('today', json_decode($data->today));
            }
        }
        return redirect('member/food-planner');
    }
    public function postDelFoodPlanner(Request $request)
    {
        if ($request->has('d') && $request->has('t') && $request->has('id')) {
            if (Session::has('today')) {
                $today = Session::get('today');
                $day   = $request->d;
                $time  = $request->t;
                $id    = $request->id;
                // echo var_dump($today->$day->$time);
                $today->$day->$time->$id = null;
                unset($today->$day->$time->$id);
                Session::put('today', $today);

                $data        = FoodPlanner::where('user_id', '=', Auth::user()->id)->first();
                $data->today = json_encode($today);
                $data->save();
            }
        }
        return back();
    }
    public function postChangeChallenge(Request $request)
    {
        if (!$request->has('id')) {
            return back()->with('error', 'User id is missng');
        }
        if (!$request->has('percent')) {
            return back()->with('error', 'Percent is missng');
        }
        if ($request->percent < 0) {
            return back()->with('error', 'Percent must not be negative value.');
        }
        $user                   = User::find($request->id);
        $user->profile->percent = $request->percent;
        $user->profile->save();
        return back();
    }
    public function postSaveProgress(Request $request)
    {
        if ($request->has('id') && $request->has('time')) {
            $user                   = User::find($request->id);
            $raw = json_decode($user->profile->raw);
            $raw->todayTime += $request->time;
            $user->profile->raw = json_encode($raw);
            $user->profile->save();
            return true;
        }
        return false;
    }
}
