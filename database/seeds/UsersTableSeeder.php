<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name' => 'admin',
                'position' => 'admin',
                'username' => 'adminpegawai',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('qwerty'),
            ],
        );
        DB::table('users')->insert(
            [
                'name' => 'produksi',
                'position' => 'produksi',
                'username' => 'produksi',
                'email' => 'produksi@gmail.com',
                'password' => Hash::make('qwerty'),
            ],
        );
        DB::table('users')->insert(
            [
                'name' => 'warehouse',
                'position' => 'warehouse',
                'username' => 'warehouse',
                'email' => 'warehouse@gmail.com',
                'password' => Hash::make('qwerty'),
            ],
        );
        DB::table('users')->insert(
            [
                'name' => 'purchasing',
                'position' => 'purchasing',
                'username' => 'purchasing',
                'email' => 'purchasing@gmail.com',
                'password' => Hash::make('qwerty'),
            ],
        );

        DB::table('users')->insert(
            [
                'name' => 'mpic/ppic',
                'position' => 'mpic/ppic',
                'username' => 'mpic/ppic',
                'email' => 'mpic/ppic@gmail.com',
                'password' => Hash::make('qwerty'),
            ],
        );

        DB::table('users')->insert(
            [
                'name' => 'manager',
                'position' => 'manager',
                'username' => 'manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('qwerty'),
            ]
        );

        DB::table('customers')->insert(
            [
                'nama_customer' => 'PT MAJU MUNDUR',
                'kode_customer' => 'PMM',
            ],
        );
        DB::table('customers')->insert(
            [
                'nama_customer' => 'PT SELALU JAYA',
                'kode_customer' => 'PSJ',
            ],
        );
        DB::table('customers')->insert(
            [
                'nama_customer' => 'PT KANGKUNG MUNDUR',
                'kode_customer' => 'PKM',
            ],
        );

        DB::table('barangs')->insert(
            [
                'nama_barang' => 'BATU BARU',
                'kode_barang' => 'BBR',
            ],
        );
        DB::table('barangs')->insert(
            [
                'nama_barang' => 'TINAH PANAS',
                'kode_barang' => 'TNP',
            ],
        );
        DB::table('barangs')->insert(
            [
                'nama_barang' => 'SEMEN TIGA RODA',
                'kode_barang' => 'STR',
            ],
        );
        DB::table('barangs')->insert(
            [
                'nama_barang' => 'BATU KALI BARU',
                'kode_barang' => 'BLB',
            ],
        );
    }
}
