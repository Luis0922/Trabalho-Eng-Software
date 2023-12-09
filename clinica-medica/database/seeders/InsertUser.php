<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsertUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(['name' => 'Admin', 'email' => 'admin@cefet.com.br', 'password' => bcrypt('1234'),
                                    'logradouro' => 'av amazonas', 'cep' => '12345678', 'bairro' => 'gamaleira',
                                    'cidade' => 'BH', 'estado' => 'MG']);
    }
}
