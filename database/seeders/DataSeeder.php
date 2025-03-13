<?php

namespace Database\Seeders;

use App\Models\Data; 
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['カテゴリ1', 'カテゴリ2', 'カテゴリ3'];
    
        
        for ($i = 1; $i <= 100; $i++) {
            Data::create([
                'title' => "タイトルtest {$i}",
                'category' => $categories[array_rand($categories)],
                'content' => "テスト本文{$i}",
            ]);
        }
    }
}
