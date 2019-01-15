<?php

namespace App\Controllers;
use App\Models\Noticias;

class NoticiasController 
{
    public function index()
    {
        $token = $_SERVER["HTTP_X_AUTHORIZATION"];

        try
        {
            if(Auth::Check($token))
            {
                    $noticias = new Noticias;

                    echo json_encode($noticias->selectAll(["titulo=?"=>'MCTEKK', 'created_at=?'=>date('Y/m/d')]));
            }

        }catch(\Firebase\JWT\ExpiredException $e)
        {
            echo $e->getMessage();
        }
    }

    public function show()
    {
        $noticia = new Noticias;
        echo json_encode($noticia->find($_GET["id"]));
        
    }

    public function store()
    {
        $token = $_SERVER["HTTP_X_AUTHORIZATION"];

        try
        {
            if(Auth::Check($token))
            {
                $name = Auth::GetData($token);

                $user = new \App\Models\User;
                $iduser = $user->getID($name->user);
                print $iduser;
                $noticia = new Noticias;
                $noticia->create([
                                                "iduser"=>$iduser,
                                                "titulo"=>$_POST["titulo"],
                                                "contenido"=>$_POST["contenido"],
                                                "created_at"=>date('Y/m/d'),
                                                "update_at"=>date('Y/m/d'),
                                                "soft_delete"=>1,
                                                "vista"=>0
                                            ]);

            }

        }catch(\Firebase\JWT\ExpiredException $e)
        {
            echo $e->getMessage();
        }
        
    }

    public function update()
    {
        $token = $_SERVER["HTTP_X_AUTHORIZATION"];
        
        try
        {
            if(Auth::Check($token))
            {
                $noticia = new Noticias;
                $noticia->update(["titulo"=>$_POST["titulo"],"contenido"=>$_POST["contenido"],"update_at"=>date('Y/m/d')],$_POST["id"]);
            }


        }catch(\Firebase\JWT\ExpiredException $e)
        {
            echo $e->getMessage();
        }

    }

    public function delete()
    {
        $token = $_SERVER["HTTP_X_AUTHORIZATION"];

        try
        {
            if(Auth::check($token))
            {
                $noticia = new Noticias;
                $noticia->delete($_POST["id"]);
            }

        }catch(\Firebase\JWT\ExpiredException $e)
        {
            echo $e->getMessage();
        }
    }
}