<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function auth_session(){

        return $this->hasOne(AuthSession::class);
    }

    public function store($data){

        $data['password'] = bcrypt($data['password']);
        $this->create($data);
    }

    public function login($data){

        $user = $this->where('email',$data['email'])->first();

        if(!$user){

          response()->json('email is invalid.',401,['Access-Control-Allow-Origin' => config('constants.allowedOrigin')])->send();
          exit;
        } 
        
        if(!Hash::check($data['password'],$user->password)){

            response()->json('password is invalid.',401,['Access-Control-Allow-Origin' => config('constants.allowedOrigin')])->send();
            exit;
        }
        $user->authenticate();

        return $user;
    }

    public function authenticate(){

        $this->auth_session()->create([
            'user_id' => $this->id,
            'token' => str_random(32),
            'created_at' => now(),
            'expires_at' => now()->addMinutes(10),
        ]);
    } 
}
