<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\Login;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Memodifikasi auth provider untuk menggunakan Login model
        Auth::provider('eloquent', function ($app, array $config) {
            return new class($app['hash'], Login::class) extends EloquentUserProvider {
                public function retrieveById($identifier)
                {
                    return Login::find($identifier);
                }
                
                public function retrieveByCredentials(array $credentials)
                {
                    if (empty($credentials) || 
                        (count($credentials) === 1 && 
                         array_key_exists('password', $credentials))) {
                        return null;
                    }

                    // Ambil user berdasarkan username atau email
                    if (isset($credentials['username'])) {
                        $user = Login::where('username', $credentials['username'])
                                     ->orWhere('email', $credentials['username'])
                                     ->first();
                        return $user;
                    }
                    
                    // Default query
                    $query = Login::query();
                    
                    foreach ($credentials as $key => $value) {
                        if ($key !== 'password') {
                            $query->where($key, $value);
                        }
                    }
                    
                    return $query->first();
                }
                
                public function validateCredentials(Authenticatable $user, array $credentials)
                {
                    $plain = $credentials['password'];
                    
                    return $this->hasher->check($plain, $user->getAuthPassword());
                }
            };
        });
    }
}