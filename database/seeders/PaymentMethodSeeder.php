<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Cash',
                'code' => 'cash',
                'is_active' => true
            ],
            [
                'name' => 'Credit Card',
                'code' => 'credit_card',
                'is_active' => true
            ],
            [
                'name' => 'Bank Transfer',
                'code' => 'bank_transfer',
                'is_active' => true
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::create($method);
        }
    }
}
