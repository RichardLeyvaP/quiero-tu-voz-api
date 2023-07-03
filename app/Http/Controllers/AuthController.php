<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Response;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Support\Facades\Log;
use Knuckles\Scribe\Attributes\Group;
use Illuminate\Support\Str;

#[Group('Authentication', 'Endpoints relacionados con la autenticación')]
class AuthController extends Controller
{
    #[Endpoint('Login', 'Permite acceder al sistema y obtener el token de autenticación', false)]
    #[Response(['access_token' => '{TOKEN}', 'token_type' => 'Bearer'])]
    public function login(LoginRequest $request)
    {
        try {

            if (!Auth::attempt($request->only(['email', 'password']), $request->input('remember'))) {
                return response()->json(['message' => __('Credenciales no válidas')], 401);
            }

            $platform = 'Device: ' . Browser::deviceFamily() . ', OS: ' . Browser::platformName() . (Browser::browserName() ? ', Browser: ' . Browser::browserName() : ', App');

            $tokenResult = Auth::user()->createToken($request->user()->name . ': ' . $platform)->plainTextToken;

            return response()->json([
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
            return response()->json(['message' => __('http-statuses.422')], 422);
        }
    }

    #[Endpoint('Logout', 'Cierra la sección actual')]
    #[Response(['data' => ['message' => 'Ha cerrado su sesión']])]
    public function logout()
    {
        $tokenId = Str::before(request()->bearerToken(), '|');
        Auth::user()->tokens()->where('id', $tokenId)->delete();

        return response()->json([
            'data' => [
                'message' => 'Ha cerrado su sesión'
            ]
        ]);
    }
}
