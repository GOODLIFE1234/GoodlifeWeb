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

        $case   = $user;
        $result = $controller->createUser($case);
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

        $result = $controller->addFoodPlanner(1, 1);
        $this->assertTrue($result);

        $result = $controller->addFoodPlanner(99, 1);
        $this->assertFalse($result);

    }
    public function testDelFoodPlanner()
    {
        $controller = new MemberController();
        Session::start();
        Session::put('foodPlanner', 'data');
        $result = $controller->delFoodPlanner(1, 1);
        $this->assertTrue($result);

        $result = $controller->delFoodPlanner(99, 1);
        $this->assertFalse($result);

    }
    public function testDisplayFoodPlanner()
    {
        $user = factory(App\User::class)->create();
        // $user          = new User();
        $profile       = new App\Models\UserProfile();
        $profile->bmr  = 0;
        $user->profile = $profile;

        $this->actingAs($user)
            ->visit('/member/food-planner')
            ->see('Food Planner');

        $user = User::find($user->id);
        $user->delete();

    }
    public function testDisplayFoodPlannerHistory()
    {
        $user = factory(App\User::class)->create();
        // $user          = new User();
        $profile       = new App\Models\UserProfile();
        $profile->bmr  = 0;
        $user->profile = $profile;

        $this->actingAs($user)
            ->visit('/member/foods-planner-history')
            ->see('Planner History');

        $user = User::find($user->id);
        $user->delete();
    }
    public function testDisplayBMR()
    {
        $user = factory(App\User::class)->create();
        // $user          = new User();
        $profile       = new App\Models\UserProfile();
        $profile->bmr  = 0;
        $user->profile = $profile;

        $this->actingAs($user)
            ->visit('/member/bmr')
            ->see('BMR');

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

        $this->actingAs($user)
            ->withSession(['foodPlanner' => ['Pizza: Amount 1 = 200.00 Kcal']])
            ->visit('/member/foods')
            ->see('Pizza: Amount 1 = 200.00 Kcal');

        $user = User::find($user->id);
        $user->delete();
    }
}
