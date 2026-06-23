<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public $categories = [
        'Setup e Postazioni Gaming',
        'Hardware e Componenti',
        'Console e Videogiochi',
        'Smart Home e Cyber Gadgets',
        'Cosplay e Accessori',
        'Collezionabili',
        'Gaming Room Decor',
        'Servizi Digitali e Creator',
        'Eventi e Community',
        'Libri, Manga, Musica e Media',
    ];

    public function run(): void
    {
        foreach ($this->categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
