<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                User::COL_ID => 1000,
                User::COL_NAME => 'User',
                User::COL_SURNAME => 'Userovski',
                User::COL_EMAIL => 'user@email.com',
                User::COL_PASSWORD => bcrypt('password'),
                User::COL_REMEMBER_TOKEN => Str::random(60),
            ]
        ];

        DB::beginTransaction();

        try {
            User::insert($users);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            abort(500, $e->getMessage());
        }
    }
}
