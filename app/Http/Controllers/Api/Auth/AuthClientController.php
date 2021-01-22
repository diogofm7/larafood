<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $client = Client::whereEmail($request->email)->first();
        if (!$client || !Hash::check($request->password, $client->password))
            return response()->json(['message' => 'Credenciais Inválidas'], 404);

        $token = $client->createToken($request->device_name)->plainTextToken;

        return response()->json(['token' => $token]);

    }

    public function me(Request $request)
    {
        $client = $request->user();

        return new ClienteResource($client);
    }

    public function logout(Request $request)
    {
        $client = $request->user();

        //Revoke all tokens Client...
        $client->tokens()->delete();

        //Revoke Current Token
        //$client->currentAccessToken()->delete();

        return response()->json([], 204);
    }

}
