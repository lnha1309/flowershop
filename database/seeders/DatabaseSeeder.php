<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            ThemesSeeder::class,
            RecipientsSeeder::class,
            StylesSeeder::class,
            FlowerTypesSeeder::class,
            OccasionsSeeder::class,

            UsersSeeder::class,
            ProductsSeeder::class,

            ProductFlowerTypesSeeder::class,
            ProductThemesSeeder::class,
            ProductRecipientsSeeder::class,
            ProductStylesSeeder::class,
            ProductOccasionsSeeder::class,

            InventorySeeder::class,
            PromotionsSeeder::class,
            PaymentMethodsSeeder::class,
            ShippingAddressSeeder::class,
            OrdersSeeder::class,
            OrderItemsSeeder::class,
            CartItemsSeeder::class,
            ProductReviewsSeeder::class,
            OrderTrackingSeeder::class,
            WishlistSeeder::class,
        ]);
    }
}
