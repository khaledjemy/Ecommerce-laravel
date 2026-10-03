<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DemoCatalogSeeder extends Seeder
{
    public function run(): void
    {
        $catalog = [
            'men' => [
                'image' => 'assets/images/men-01.jpg',
                'products' => [
                    ['Classic jacket', 89, 'assets/images/men-01.jpg'],
                    ['Everyday shirt', 49, 'assets/images/men-02.jpg'],
                    ['Weekend outfit', 75, 'assets/images/men-03.jpg'],
                ],
            ],
            'women' => [
                'image' => 'assets/images/women-01.jpg',
                'products' => [
                    ['Modern outfit', 99, 'assets/images/women-01.jpg'],
                    ['Casual collection', 65, 'assets/images/women-02.jpg'],
                    ['Evening style', 120, 'assets/images/women-03.jpg'],
                ],
            ],
            'kids' => [
                'image' => 'assets/images/kid-01.jpg',
                'products' => [
                    ['Kids everyday', 35, 'assets/images/kid-01.jpg'],
                    ['Kids weekend', 42, 'assets/images/kid-02.jpg'],
                    ['Kids collection', 55, 'assets/images/kid-03.jpg'],
                ],
            ],
        ];

        foreach ($catalog as $name => $details) {
            $category = Category::firstOrCreate(['category_name' => $name], [
                'description' => ucfirst($name).' sample collection for demonstration only.',
                'image' => $details['image'],
                'published' => true,
            ]);

            foreach ($details['products'] as [$productName, $price, $image]) {
                Product::firstOrCreate([
                    'name' => $productName,
                    'category_id' => $category->id,
                ], [
                    'price' => $price,
                    'rate' => 5,
                    'image' => $image,
                    'published' => true,
                    'stock' => 10,
                ]);
            }
        }
    }
}
