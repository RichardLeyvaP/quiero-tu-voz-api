<?php

use Illuminate\Support\Facades\Route;
/*
Aqui van las rutas una vez registrado y logueado el usuario
solo buena practica de programacion
--Crear proyectos
--Contratar servicios
--Actualizar perfil de trabajo
--etc..solo por citar algunos

*/

Route::get('/registered', function () {
    return "Cargando aqui una vez q ya esta logueado";
});