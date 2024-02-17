<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomizedPangkatTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pangkat')->delete();
        
        \DB::table('pangkat')->insert(array (
            0 => 
            array (
                'name' => 'Juru Muda',
                'kode' => 'I/a',
                'id' => '11',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            1 => 
            array (
                'name' => 'Juru Muda Tk. I',
                'kode' => 'I/b',
                'id' => '12',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            2 => 
            array (
                'name' => 'Juru',
                'kode' => 'I/c',
                'id' => '13',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            3 => 
            array (
                'name' => 'Juru Tk. I',
                'kode' => 'I/d',
                'id' => '14',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            4 => 
            array (
                'name' => 'Pengatur Muda',
                'kode' => 'II/a',
                'id' => '21',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            5 => 
            array (
                'name' => 'Pengatur Muda Tk. I',
                'kode' => 'II/b',
                'id' => '22',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            6 => 
            array (
                'name' => 'Pengatur',
                'kode' => 'II/c',
                'id' => '23',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            7 => 
            array (
                'name' => 'Pengatur Tk. I',
                'kode' => 'II/d',
                'id' => '24',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            8 => 
            array (
                'name' => 'Penata Muda',
                'kode' => 'III/a',
                'id' => '31',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            9 => 
            array (
                'name' => 'Penata Muda Tk. I',
                'kode' => 'III/b',
                'id' => '32',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            10 => 
            array (
                'name' => 'Penata',
                'kode' => 'III/c',
                'id' => '33',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            11 => 
            array (
                'name' => 'Penata Tk. I',
                'kode' => 'III/d',
                'id' => '34',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            12 => 
            array (
                'name' => 'Pembina',
                'kode' => 'IV/a',
                'id' => '41',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            13 => 
            array (
                'name' => 'Pembina Tk. I',
                'kode' => 'IV/b',
                'id' => '42',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            14 => 
            array (
                'name' => 'Pembina Utama Muda',
                'kode' => 'IV/c',
                'id' => '43',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            15 => 
            array (
                'name' => 'Pembina Utama Madya',
                'kode' => 'IV/d',
                'id' => '44',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
            16 => 
            array (
                'name' => 'Pembina Utama ',
                'kode' => 'IV/e ',
                'id' => '45',
                'created_at' => '2023-06-27 03:22:57',
                'updated_at' => '2023-06-27 03:22:57',
            ),
        ));
        
        
    }
}