<?php

use Illuminate\Database\Seeder;
use App\Product;
use Illuminate\Support\Str;
class ProductTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = Product::create([
            'name' => 'Macbook Pro 13 2017',
            'category_id' => 1,
            'descryption' => 'Seri komputer jinjing Macintosh yang diproduksi oleh Apple',
            'price' => 18500000,
            'stock' => 5
        ]);

        Product::create([
            'name' => 'Asus Rog Slim',
            'category_id' => 1,
            'descryption' => 'Sebuah brand perangkat keras notebook khusus gaming dari ASUS',
            'price' => 10500000,
            'stock' => 15
        ]);
    }
}
