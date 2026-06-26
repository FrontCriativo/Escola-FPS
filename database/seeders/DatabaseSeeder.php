<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'is_admin' => true,
            ],
        );

        $books = [
            ['title' => 'Di?rio de um Banana', 'author' => 'Jeff Kinney', 'category' => 'Literatura', 'image' => '/src/img/diarioDeUmBanana.jpg', 'color' => '#a8c7a0', 'available' => true, 'description' => 'As aventuras e confusoes de Greg Heffley narradas em seu diario.', 'year' => 2007, 'pages' => 224],
            ['title' => 'O Pequeno Pr?ncipe', 'author' => 'Antoine de Saint-Exup?ry', 'category' => 'Literatura', 'image' => '/src/img/oPequenoPrincipe.jpg', 'color' => '#a0b8d8', 'available' => true, 'description' => 'Uma historia atemporal sobre amizade, amor e o que realmente importa na vida.', 'year' => 1943, 'pages' => 96],
            ['title' => 'A Origem das Esp?cies', 'author' => 'Charles Darwin', 'category' => 'Ciencias', 'image' => '/src/img/aOrigemDasEspecies.jpg', 'color' => '#d8c4a0', 'available' => false, 'description' => 'A obra que apresentou a teoria da evolucao por selecao natural.', 'year' => 1859, 'pages' => 502],
            ['title' => 'A Rep?blica', 'author' => 'Plat?o', 'category' => 'Filosofia', 'image' => '/src/img/aRepublica.png', 'color' => '#c4a0a0', 'available' => true, 'description' => 'Dialogo filosofico sobre justica, politica, educacao e sociedade.', 'year' => -380, 'pages' => 416],
            ['title' => 'A Revolu??o dos Bichos', 'author' => 'George Orwell', 'category' => 'Ficcao', 'image' => '/src/img/aRevolucaoDosBichos.jpg', 'color' => '#d4c4a0', 'available' => true, 'description' => 'Uma fabula politica sobre animais que se rebelam contra seus donos.', 'year' => 1945, 'pages' => 152],
            ['title' => 'Dom Quixote', 'author' => 'Miguel de Cervantes', 'category' => 'Literatura', 'image' => '/src/img/domQuixote.jpg', 'color' => '#c4b8d8', 'available' => false, 'description' => 'As aventuras de um fidalgo que decide viver como cavaleiro andante.', 'year' => 1605, 'pages' => 863],
            ['title' => 'Romeu e Julieta', 'author' => 'William Shakespeare', 'category' => 'Teatro', 'image' => '/src/img/RomeuAndJulieta.jpg', 'color' => '#a0c4d4', 'available' => true, 'description' => 'A celebre tragedia de dois jovens apaixonados de familias rivais.', 'year' => 1597, 'pages' => 160],
            ['title' => 'Vidas Secas', 'author' => 'Graciliano Ramos', 'category' => 'Literatura', 'image' => '/src/img/vidasSecas.jpg', 'color' => '#d8a0b8', 'available' => true, 'description' => 'Uma familia de retirantes enfrenta a seca, a pobreza e a opressao.', 'year' => 1938, 'pages' => 176],
        ];

        foreach ($books as $item) {
            $category = Category::query()->updateOrCreate(
                ['slug' => Str::slug($item['category'])],
                [
                    'name' => $item['category'],
                    'color' => $item['color'],
                    'description' => null,
                ],
            );

            Book::query()->updateOrCreate(
                ['title' => $item['title'], 'author' => $item['author']],
                [
                    'category_id' => $category->id,
                    'publication_year' => $item['year'],
                    'pages' => $item['pages'],
                    'description' => $item['description'],
                    'cover_path' => $item['image'],
                    'accent_color' => $item['color'],
                    'status' => 'available',
                    'copies_total' => 1,
                    'copies_available' => $item['available'] ? 1 : 0,
                    'is_featured' => true,
                ],
            );
        }
    }
}
