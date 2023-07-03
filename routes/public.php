<?php

use Illuminate\Support\Facades\Route;

/*
Aqui van las rutas sin haberse logueado en el sistema
solo buena practica de programacion

--puede hacer busquedas
--puede ver ejemplos posteados en youtube
--por citar algunos ejemplos


*/

Route::get('/public', function () {
    return "Aqui va todas las rutas que sean publicas,que no esten logueados en el sistema";
});