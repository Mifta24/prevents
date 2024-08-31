<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = Role::create(['name' => 'admin']);
        $organizer = Role::create(['name' => 'organizer']);
        $participant = Role::create(['name' => 'participant']);

        $user=User::factory()->create([
            'name' => 'Miftah',
            'email' => 'miftafree3@gmail.com',
            'password' => bcrypt(12345678),
            'username' => 'Mifta Aldi',
            'occupation' => 'Boss',
            'gender' => 'man',
            'profile_img' => 'images/miftah.img',
        ]);

        $user->assignRole($admin);
    }
}
