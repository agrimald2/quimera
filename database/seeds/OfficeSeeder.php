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
            'name' => "Oficina central",
        ]);
        Office::create([
            'name' => "Oficina de abajo",
        ]);

        Category::create([
            'name' => 'Categoria maestra',
        ]);

        Collection::create([
            'name' => 'Coleccion maestra',
        ]);

        Brand::create([
            'name' => 'MARCA 1'
        ]);

        Color::create([
            'name' => 'Rojo',
            'hex' => '#ff0000',
        ]);


        Size::create([
            'number' => 12,
            'name' => 'talla',
        ]);

    }
}
