<?php

namespace App\Http\Controllers;

use App\Http\Requests\autenticacion\cambiarPasswordRequest;
use App\Http\Requests\autenticacion\enviarEmailRecuperacionRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Mail\estandarMail;
use App\Models\User;
use App\Services\SuspencionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use Throwable;

class UserController extends Controller
{
    

    

    public function update(Request $request, User $user)
    {

        if($request->filled('password')){
            $request['password'] = Hash::make($request->password);
            $request = $request->all();
        }else{
            $request = $request->except(['password']);
        }

        $user->update($request);
        $user->estado;
        $user->tipoUsuario;
        $user->estatus;

        return response()->json(['mensaje' => 'Modificación exitosa', 'user' => $user],200);
    }
}
