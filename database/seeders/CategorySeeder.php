<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Технологии и IT",
            "Путешествия и приключения",
            "Здоровье и благополучие",
            "Кулинария и рецепты",
            "Мода и стиль",
            "Искусство и культура",
            "Литература и писательство",
            "Фотография и видеосъемка",
            "Дом и семья",
            "Бизнес и предпринимательство",
            "Наука и исследования",
            "Спорт и фитнес",
            "Музыка и развлечения"
        ];

        foreach($categories as $category) {
            Category::create([
                'name' => $category
            ]);
        }
    }
}
