<?php
use App\Http\Controllers\UserController;

// use Session;

class UserControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testDisplayBMi()
    {
        $this->visit('/bmi')
            ->see('BMI Calculator');

    }
    public function testDisplayBMR()
    {
        $this->visit('/bmr')
            ->see('BMR Calculator');

    }
    public function testDisplayFood()
    {
        $this->visit('/foods-calculator')
            ->see('Foods Calculator');

    }
    public function testDisplayExercise()
    {
        $this->visit('/exercises-calculator')
            ->see('Exercise Calculator');

    }
    public function testDelFood()
    {
        Session::start();
        $controller = new UserController();

        $result = $controller->delFood(1);
        $this->assertFalse($result);

        Session::put('foodList', ['total' => 0, 1 => ['total' => 0]]);
        $result = $controller->delFood(1);
        $this->assertTrue($result);
    }
    public function testDelExercise()
    {
        Session::start();
        $controller = new UserController();

        $result = $controller->delExercise(1);
        $this->assertFalse($result);

        Session::put('foodList', ['total' => 0, 1 => ['total' => 0]]);
        $result = $controller->delExercise(1);
        $this->assertTrue($result);

    }
    public function testCalBMI()
    {
        $controller = new UserController();
        $result     = $controller->calBMI(null, 1, 1, 1);
        $this->assertEquals($result, "Weight is missing");

        $result = $controller->calBMI(1, null, 1, 1);
        $this->assertEquals($result, "Height is missing");

        $result = $controller->calBMI(1, 1, null, 1);
        $this->assertEquals($result, "Age is missing");

        $result = $controller->calBMI(1, 1, 1, null);
        $this->assertEquals($result, "Gender is missing");

        $result = $controller->calBMI(1, 20, 80, 180);
        $this->assertEquals(round($result), 25);
    }
    public function testRetrieveBMI()
    {
        $controller = new UserController();
        $result     = $controller->retrieveBMI(40);
        $this->assertEquals($result, "Obesity superlatives.");

        $result = $controller->retrieveBMI(35);
        $this->assertEquals($result, "Obesity level 2. Your risk of diseases that accompany obesity. If you have a waist circumference greater than normal, you run the risk of disease is high. You must control diet And serious exercise.");

        $result = $controller->retrieveBMI(28.5);
        $this->assertEquals($result, " obesity levels. If you have a waist circumference greater than 90 cm(men), 80 cm (women) you will have a chance to disease, diabetes, high blood pressure need to diet, And exercise.");

        $result = $controller->retrieveBMI(23.5);
        $this->assertEquals($result, "If you are overweight Dental Federation as diabetes, high cholesterol ortrying to lose weight, a body mass index lower than 23.");

        $result = $controller->retrieveBMI(18.5);
        $this->assertEquals($result, "Normal weight and fat content were normal. Usually do not have the disease The incidence of diabetes High blood pressure than obese people than this.");

        $result = $controller->retrieveBMI(18);
        $this->assertEquals($result, "Too little weight. This may be due to the athletes who exercise a lot. Moreover, inadequate nutrition. Solutions need to eat quality food. And a sufficient amount of energy And exercise properly.");
    }
    public function testCalBMR()
    {
        $controller = new UserController();
        $result     = $controller->calBMR(null, 1, 1, 1);
        $this->assertEquals($result, "Weight is missing");

        $result = $controller->calBMR(1, null, 1, 1);
        $this->assertEquals($result, "Height is missing");

        $result = $controller->calBMR(1, 1, null, 1);
        $this->assertEquals($result, "Age is missing");

        $result = $controller->calBMR(1, 1, 1, null);
        $this->assertEquals($result, "Gender is missing");

        $result = $controller->calBMR(80, 180, 20, '1');
        $this->assertEquals(round($result), 1954);
    }
    public function testCalFood()
    {
        $controller = new UserController();
        $result     = $controller->calFood(null, 1);
        $this->assertEquals($result, "Id is missing");

        $result = $controller->calFood(1, null);
        $this->assertEquals($result, "Amount is missing");

        $result = $controller->calFood(1, 1);
        $this->assertEquals($result, 300);
    }
    public function testCalExercise()
    {
        $controller = new UserController();
        $result     = $controller->calExercise(null, 1, 1);
        $this->assertEquals($result, "Id is missing");

        $result = $controller->calExercise(1, null, 1);
        $this->assertEquals($result, "Weight is missing");

        $result = $controller->calExercise(1, 1, null);
        $this->assertEquals($result, "Time is missing");

        $result = $controller->calExercise(1, 80, 60);
        $this->assertEquals(round($result), 146);
    }
}
