<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Group('Profile', 'Endpoints de Perfil de Usuario')]
class ProfileController extends Controller
{
    #[Endpoint('Show', 'Devuelve la información del usuario actual')]
    #[ResponseFromApiResource(UserResource::class, User::class)]
    public function show()
    {
        return new UserResource(Auth::user());
    }
}
