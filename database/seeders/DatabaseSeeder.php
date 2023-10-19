<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Seo;
use App\Models\Admin;
use App\Models\SiteSetting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\Admin::factory()->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(RoleSeeder::class);
        // $this->call(AdminSeeder::class);


        if (count(DB::table('admins')->get()) == '0') {
            DB::table('admins')->insert([
            'name' => "Super Admin",
            'email' => "admin@ekotamart.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'current_team_id' => "111",
            'profile_photo_path' => 'aaa.png',
            'remember_token' => Str::random(10),
            ]);
        }



        if (count(DB::table('site_settings')->get()) == '0') {
            DB::table('site_settings')->insert([
                'id' => 1,
                'logo' => 'no_image.jpg',
                'icon' => 'no_image.jpg',
                'phone_one' => "01700000000",
                'phone_two' => "01700000001",
                'email' => "ekotamart@gmail.com",
                'company_name' => "Ekota Mart",
                'company_address' => "Mukto Bangla Shopping Complex, 5th Floor, Space No:(51-52), Mirpur-1, Dhaka 1216",
                'facebook' => "https://www.facebook.com/",
                'twitter' => "https://twitter.com/",
                'linkedin' => "https://bd.linkedin.com/",
                'youtube' => "https://www.youtube.com/",
            ]);
        }



        if (count(DB::table('seos')->get()) == '0') {
            DB::table('seos')->insert([
                'meta_title' => "Ekota Mart",
                'meta_author' => "Ekota Mart",
                'meta_keyword' => "bet online shop, best product, best ecommerce site, best ecommerce product",
                'meta_description' => "meta description",
                'google_analytics' => "google analytics",
            ]);
        }

    }
}
