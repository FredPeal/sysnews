<?php

namespace App\Controllers;
use App\Models\Noticias;

class NoticiasController 
{
    private $paginador = 10;


    public function index()
    {
        $token = $_SERVER["HTTP_X_AUTHORIZATION"];

        try
        {
            if(Auth::Check($token))
            {
                $noticias = new Noticias;
                $cantidad_paginas = ceil($noticias->count() / $this->paginador);
                $condiciones=['1 = ?'=>1];
                $pagina = $_GET["pagina"];

                $pagina = $pagina * 10;
                $limit_anterior = $pagina - 10;
                
                foreach($_GET as $key=>$value)
                {
                    if($key != '_url' && $key != 'pagina')
                    {
                        $condiciones[$key . ' = ?'] = $value;
                    }
                }

                //var_dump($condiciones);
                echo json_encode($noticias->selectAll($condiciones, " limit {$limit_anterior} , {$pagina}"));
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
                                                "contenido"=>trim($_POST["contenido"],''),
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