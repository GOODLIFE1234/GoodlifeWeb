<?php
use App\Http\Controllers\MemberController;
use App\User;

// use Session;
class MemberControllerTest extends TestCase
{
/**
 * A basic functional test example.
 *
 * @return void
 */
    public function testCreateUser()
    {
        $controller     = new MemberController();
        $user           = new User();
        $user->name     = 'Secamt001';
        $user->surname  = 'Secamt001';
        $user->nickname = 'Secamt001';
        $user->email    = 'a@a.com';
        $case           = $user;
        $result         = $controller->createUser($case);
        $this->assertTrue($result);
        $case       = $user;
        $case->name = null;
        $result     = $controller->createUser($case);
        $this->assertFalse($result);
        $case          = $user;
        $case->surname = null;
        $result        = $controller->createUser($case);
        $this->assertFalse($result);
        $case           = $user;
        $case->nickname = null;
        $result         = $controller->createUser($case);
        $this->assertFalse($result);
        $case          = $user;
        $case->surname = null;
        $result        = $controller->createUser($case);
        $this->assertFalse($result);
        $case   = new User();
        $result = $controller->createUser($case);
        $this->assertFalse($result);
    }
    public function testUpdateUser()
    {
        $controller     = new MemberController();
        $user           = new User();
        $user->id       = '99998';
        $user->name     = 'Secamt001';
        $user->surname  = 'Secamt001';
        $user->nickname = 'Secamt001';
        $user->email    = 'a@b.com';
        $user->save();
        $case   = $user;
        $result = $controller->updateUser($case);
        $this->assertTrue($result);
        $case       = $user;
        $case->name = null;
        $result     = $controller->updateUser($case);
        $this->assertFalse($result);
        $case          = $user;
        $case->surname = null;
        $result        = $controller->updateUser($case);
        $this->assertFalse($result);
        $case           = $user;
        $case->nickname = null;
        $result         = $controller->updateUser($case);
        $this->assertFalse($result);
        $case          = $user;
        $case->surname = null;
        $result        = $controller->updateUser($case);
        $this->assertFalse($result);
        $case   = new User;
        $result = $controller->updateUser($case);
        $this->assertFalse($result);
        $user->delete();
    }
    public function testAddFoodPlanner()
    {
        $controller = new MemberController();
        $result     = $controller->addFoodPlanner(1, 1);
        $this->assertTrue($result);
        $result = $controller->addFoodPlanner(99999, 1);
        $this->assertFalse($result);
    }
    public function testDelFoodPlanner()
    {
        $controller = new MemberController();
        Session::start();
        Session::put('foodPlanner', 'data');
        $result = $controller->delFoodPlanner(1, 1);
        $this->assertTrue($result);
        $result = $controller->delFoodPlanner(99999, 1);
        $this->assertFalse($result);
    }
    public function testDisplayFoodPlanner()
    {
        $user = factory(App\User::class)->create();
// $user          = new User();
        $profile       = new App\Models\UserProfile();
        $profile->bmr  = 0;
        $profile->raw  = null;
        $profile->user_id = $user->id;
        $profile->save();

        $this->be($user);
        $response = $this->action('GET', 'MemberController@displayFoodPlanner')->original;
        error_log($response, 3, "goodlife.log");
        $this->assertEquals('Monday', $response['Day']);
        $this->assertEquals('Pizza:1=200Kcal', $response['Breakfast']);
        $this->assertEquals('-', $response['Lunch']);
        $this->assertEquals('-', $response['Dinner']);
        $this->assertEquals('-', $response['Snack']);
        $this->assertEquals('2000', $response['BMR']);
        $this->assertEquals('200', $response['Calorie']);
        $this->assertEquals('1800', $response['Today']);
// ->assertViewHas('Day', 'Monday')
        // ->assertViewHas('Breakfast', 'Pizza:1=200Kcal')
        // ->assertViewHas('Lunch', '-')
        // ->assertViewHas('Dinner', '-')
        // ->assertViewHas('Snack', '-')
        // ->assertViewHas('BMR', '2000')
        // ->assertViewHas('Calorie', '200')
        // ->assertViewHas('Today', '1800');
        $user = User::find($user->id);
        $user->delete();
        $profile->delete();
    }
    public function testDisplayFoodPlannerHistory()
    {
        $user = factory(App\User::class)->create();
// $user          = new User();
        $profile       = new App\Models\UserProfile();
        $profile->bmr  = 0;
        $user->profile = $profile;
        $this->be($user);
        $response = $this->action('GET', 'MemberController@displayFoodPlannerHistory')->original;
        $this->assertEquals('Monday', $response['Day']);
        $this->assertEquals('Pizza:1=200Kcal', $response['Breakfast']);
        $this->assertEquals('-', $response['Lunch']);
        $this->assertEquals('-', $response['Dinner']);
        $this->assertEquals('-', $response['Snack']);
        $this->assertEquals('2000', $response['BMR']);
        $this->assertEquals('200', $response['Calorie']);
        $this->assertEquals('1800', $response['Today']);
        $user = User::find($user->id);
        $user->delete();
    }
    public function testDisplayBMR()
    {
        $user = factory(App\User::class)->create();
// $user          = new User();
        $profile       = new App\Models\UserProfile();
        $profile->bmr  = 2000;
        $user->profile = $profile;
// $this->actingAs($user)
        //     ->visit('/member/bmr')
        //     ->assertViewHas('BMR', 2000);
        $this->be($user);
        $response = $this->action('GET', 'MemberController@displayBMR')->original;
        $this->assertEquals('2000', $response['BMR']);
        $user = User::find($user->id);
        $user->delete();
    }
    public function testDisplayFoods()
    {
        $user = factory(App\User::class)->create();
// $user          = new User();
        $profile       = new App\Models\UserProfile();
        $profile->bmr  = 0;
        $user->profile = $profile;
// $this->actingAs($user)
        //     ->withSession(['planner' => 'Pizza: Amount 1 = 200.00 Kcal'])
        //     ->visit('/member/foods')
        //     ->assertViewHas('planner', 'Pizza: Amount 1 = 200.00 Kcal');
        $this->be($user);
        $this->session(['planner' => 'Pizza: Amount 1 = 200.00 Kcal']);
        $response = $this->action('GET', 'MemberController@displayFoods')->original;
        $this->assertEquals('Pizza: Amount 1 = 200.00 Kcal', $response['planner']);
        $user = User::find($user->id);
        $user->delete();
    }
    public function testDisplayChallenge()
    {
        $user = factory(App\User::class)->create();
// $user          = new User();
        $profile            = new App\Models\UserProfile();
        $profile->user_id   = $user->id;
        $profile->challenge = 100;
        $profile->percent   = 0;
        $profile->record    = 200;
        $profile->age       = 20;
        $profile->height    = 175;
        $profile->weight    = 80;
        $profile->bmi       = 21;
        $profile->bmr       = 2000;
        $profile->raw       = '{"todayFood":0,"todayExercise":0,"todayVelocity":0,"todayDistance":0,"todayTime":0,"todayCalories":0}';
        $profile->save();
// $user->profile      = $profile;
        $this->be($user);
        $response = $this->action('GET', 'MemberController@displayChallenge')->original;
// var_dump($response);

        $this->assertEquals('Today Challenge: 200cal Your Status Goal: 500 cal Today Distance: 50m Today Velocity: 5km/h Next Challenge: 550 cal', $response["test"]);
        $user = User::find($user->id);
        $user->delete();
        $profile->delete();
    }
    public function testSaveChallenge()
    {
        $controller = new MemberController();
        $result     = $controller->saveChallenge(null, null);
        $this->assertEquals("Please input data", $result);
        $result = $controller->saveChallenge(null, 1);
        $this->assertEquals("User id is missing", $result);
        $result = $controller->saveChallenge(1, null);
        $this->assertEquals("Percent is missing", $result);
        $user             = factory(App\User::class)->create();
        $profile          = new App\Models\UserProfile();
        $profile->user_id = $user->id;
        $profile->save();
        $result = $controller->saveChallenge($user->id, 10);
        $this->assertEquals(10, $result);
        $user = User::find($user->id);
        $user->delete();
        $profile->delete();
    }
    public function testSaveProgress()
    {
        $controller = new MemberController();
        $result     = $controller->saveProgress(null, null);
        $this->assertEquals("Please input data", $result);
        $result = $controller->saveProgress(null, 1);
        $this->assertEquals("User id is missing", $result);
        $result = $controller->saveProgress(1, null);
        $this->assertEquals("Distance is missing", $result);
        $user             = factory(App\User::class)->create();
        $profile          = new App\Models\UserProfile();
        $profile->user_id = $user->id;
        $profile->save();
        $result = $controller->saveProgress($user->id, 10);
        $this->assertEquals(10, $result);
        $user = User::find($user->id);
        $user->delete();
        $profile->delete();
    }
    public function testNotifyChallenge()
    {
        $controller = new MemberController();
        $user       = factory(App\User::class)->create();
// $user          = new User();
        $profile            = new App\Models\UserProfile();
        $profile->challenge = 100;
        $profile->record    = 100;
        $user->profile      = $profile;
        $this->be($user);
        $response = $this->action('GET', 'MemberController@notifyChallenge')->original;
        $this->assertEquals('You have succeed the challenge', $response);
        $user = User::find($user->id);
        $user->delete();
    }
    public function testDisplayReport()
    {
        $user = factory(App\User::class)->create();
// $user          = new User();
        $profile            = new App\Models\UserProfile();
        $profile->user_id   = $user->id;
        $profile->challenge = 100;
        $profile->percent   = 0;
        $profile->record    = 200;
        $profile->age       = 20;
        $profile->height    = 175;
        $profile->weight    = 80;
        $profile->bmi       = 21;
        $profile->bmr       = 2000;
        $profile->raw       = '{"todayFood":0,"todayExercise":0,"todayVelocity":0,"todayDistance":0,"todayTime":0,"todayCalories":0}';
        $profile->save();
// $user->profile      = $profile;
        $this->be($user);
        $response = $this->action('GET', 'MemberController@displayReport')->original;
        $this->assertEquals('Height: 175cm Weight: 80kg Age: 20 BMI: 21 “If you are overweight Dental Federation as diabetes, high cholesterol or trying to lose weight, a Document Name Good Life_TestPlan_V1.0 Owner PIS,WP Page 25/73 Document Type Test Plan Release Date 15/12/2016 Print Date 15/12/2016 body mass index lower than 23” BMR: 2000 Today Calorie: 0 Exercise: 100 cal Accelometer: 200cal Left: 2300', $response['test']);
        $user = User::find($user->id);
        $user->delete();
        $profile->delete();
    }
}
