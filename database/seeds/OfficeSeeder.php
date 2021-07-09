<?php

use App\Brand;
use App\Category;
use App\Collection;
use App\Color;
use App\Office;
use App\Product;
use App\Size;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Office::create([
            'name' => "Oficina principal",
        ]);
        Office::create([
            'name' => "Oficina de abajo",
        ]);

        Category::create([
            'name' => 'Pantalones',
        ]);
        Category::create([
            'name' => 'Zapatos',
        ]);

        Collection::create([
            'name' => 'Coleccion verano',
        ]);
        Collection::create([
            'name' => 'Coleccion invierno',
        ]);

        Brand::create([
            'name' => 'Marca solar'
        ]);
        Brand::create([
            'name' => 'Marca Lunar'
        ]);

        Color::create([
            'name' => 'Rojo',
            'hex' => '#ff0000',
        ]);
        Color::create([
            'name' => 'Azul',
            'hex' => '#ff0000',
        ]);


        Size::create([
            'number' => 12,
            'name' => '12 XL',
        ]);
        Size::create([
            'number' => 14,
            'name' => '14 XL',
        ]);

    }
}
