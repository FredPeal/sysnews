<?php 

namespace App\Controllers;
use App\Models\User;
use App\Core\Response;

class UserController 
{
    public function index()
    {
        $user = new User;
        $usuarios = $user->selectAll();
        echo Response::json($usuarios);
    }

    public function show()
    {
        $user = new User;
        $usuarios = $user->find($_GET["id"]);
        echo Response::json($usuarios);
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