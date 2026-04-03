<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        Order::factory(10)
            ->has(OrderDetail::factory(), 'details')
            ->create()
            ->each(function ($order) use ($products) {

                $selectedProducts = $products->random(rand(2, 4));
                $total = 0;

                foreach ($selectedProducts as $product) {
                    $qty = rand(1, 2);
                    $price = $product->price;
                    $total += ($price * $qty);

                    $order->products()->attach($product->id, [
                        'quantity' => $qty,
                        'price' => $price
                    ]);
                }

                $order->update(['total_price' => $total]);
            });
    }

}
