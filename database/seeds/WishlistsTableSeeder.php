<?php

use Illuminate\Database\Seeder;

class WishlistsTableSeeder extends Seeder
{
    private $productsIds = [];

    private function loadProducts(): void
    {
        $this->productsIds = \App\Models\Product::query()->select(['id'])->pluck('id')->toArray();
    }

    private function getRandomProducts(): array
    {
        $productsList = [];
        $randomKeyCount = random_int(2, 10);
        $randomKeys = array_rand($this->productsIds, $randomKeyCount);
        foreach ($randomKeys as $randomKey) {
            $productsList[] = $this->productsIds[$randomKey];
        }

        return $productsList;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->loadProducts();
        factory(App\Models\Wishlist::class, 5)->create()->each(function (\App\Models\Wishlist $wishlist) {
            $wishlist->products()->syncWithoutDetaching(
                $this->getRandomProducts()
            );
        });
    }
}
