<?php

namespace Database\Factories;

use App\Models\Seo;
use App\Models\Admin;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return [
        //     'name' => 'Admin',
        //     'email' => 'adminss@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'), // password
        //     'remember_token' => Str::random(10),
        // ];


    }
}
