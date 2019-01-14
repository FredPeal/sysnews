<?php 

namespace App\Controllers;
use App\Models\User;
class UserController 
{
    public function index()
    {
        $user = new User;
        echo json_encode($user->selectAll());
    }

    public function show()
    {
        $user = new User;
        echo json_encode($user->find($_GET["id"]));
    }

    public function store()
    {
        $user = new User;
        $pass = password_hash($_POST["pass"],PASSWORD_DEFAULT);
        $result = $user->create(["name"=>$_POST["name"], "password"=>$pass, "email"=>$_POST["email"]]);

        var_dump($result);
    }

    public function update()
    {
        $user = new User;
        $user->update(["name"=>$_POST["name"], "email"=>$_POST["email"]], $_POST["id"]);
    }

    public function del()
    {
        $user = new User;
        $user->delete($_POST["id"]);
    }
}