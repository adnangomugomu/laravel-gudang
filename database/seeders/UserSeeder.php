<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Nonstandard\Uuid;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()
            ->has(Produk::factory()->count(10), 'produk')
            ->count(20)
            ->create();

        DB::table('users')->insert([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'adnan irfan rosyidi',
            'username' => 'adnan',
            'email' => 'adnan@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now()->addHour(),
            'updated_at' => Carbon::now()->addHour(),
        ]);
    }
}
