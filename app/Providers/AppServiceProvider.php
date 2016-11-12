<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->addUsersEmailUniquenessRule();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function addUsersEmailUniquenessRule(){
        Validator::extend(
            'unique_email_for_edit',
            function ($attribute, $value, $parameters, $validator)
            {
                $data = $validator->getData();
                $users = User::getByEmail($value)->get();
                $userCount = count($users);
                if ($userCount === 0){
                    $result = true;
                } elseif ($userCount === 1 && isset($data['id']) && $users->first()->id == $data['id']) {
                    $result = true;
                } else {
                    $result = false;
                }
                return $result;
            }
        );
    }
}
