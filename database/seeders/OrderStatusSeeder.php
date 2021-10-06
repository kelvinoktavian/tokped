<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order_statuses = OrderStatus::all();

        if ($order_statuses->count() == 0) {
            $order_status = [
                [
                    'slug' => 'pending',
                    'status' => 'Pending',
                ],
                [
                    'slug' => 'payment-confirmed',
                    'status' => 'Payment Confirmed',
                ],
                [
                    'slug' => 'order-is-being-prepared',
                    'status' => 'Order is being prepared',
                ],
                [
                    'slug' => 'order-sent',
                    'status' => 'Order Sent',
                ],
                [
                    'slug' => 'order-arrived',
                    'status' => 'Order Arrived',
                ],
                [
                    'slug' => 'canceled',
                    'status' => 'Canceled',
                ],
            ];

            foreach ($order_status as $key => $value) {
                OrderStatus::create($value);
            }
        }
    }
}
