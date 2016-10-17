<?php
use App\Http\Controllers\AdminController;
use App\User;

// use Session;

class AdminControllerTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testDisplayUserList()
    {
        $controller     = new AdminController();
        $user           = new User();
        $user->id       = '99997';
        $user->name     = 'Secamt001';
        $user->surname  = 'Secamt001';
        $user->nickname = 'Secamt001';
        $user->email    = 'a@c.com';
        $user->save();

        // $case   = $user;
        $result = $controller->displayUserList();
        $this->assertContains('99997', $result);

        $user->delete();

    }
    public function testDeleteUser()
    {
        $controller     = new AdminController();
        $user           = new User();
        $user->id       = '99996';
        $user->name     = 'Secamt001';
        $user->surname  = 'Secamt001';
        $user->nickname = 'Secamt001';
        $user->email    = 'a@d.com';
        $user->save();

        // $case   = $user;
        $result = $controller->deleteUser(99996);
        $this->assertTrue($result);

        $result = $controller->deleteUser(0);
        $this->assertFalse($result);

        $user->delete();

    }
    public function testSearchUser()
    {
        $controller     = new AdminController();
        $user           = new User();
        $user->id       = '99995';
        $user->name     = 'Secamt001';
        $user->surname  = 'Secamt001';
        $user->nickname = 'Secamt001';
        $user->email    = 'a@e.com';
        $user->save();

        // $case   = $user;
        $result = $controller->searchUser('Secamt001', 'Secamt001');
        $this->assertContains('Secamt001',$result);

        $result = $controller->searchUser('Secamt001', '');
        $this->assertContains('Secamt001',$result);

        $result = $controller->searchUser('', 'Secamt001');
        $this->assertContains('Secamt001',$result);

        $result = $controller->searchUser('1234', '');
        $this->assertContains('No User',$result);

        $result = $controller->searchUser('', '');
        $this->assertContains('No User',$result);

        $user->delete();

    }
}
