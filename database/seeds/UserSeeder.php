<?php

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [];

        for ($i = 1; $i <= 50; $i++) {
            $records[] = [
                'id' => $i,
                'name' => "user${i}",
                'email' => "user${i}@test.test",
                'email_verified_at' => now(),
                'password' => Hash::make('testtest'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        Schema::disableForeignKeyConstraints();

        DB::transaction(function () use ($records) {
            User::query()->delete();
            DB::table('users')->insert($records);
        });

        Schema::enableForeignKeyConstraints();
    }
}
