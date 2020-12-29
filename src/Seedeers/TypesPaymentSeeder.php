<?php

namespace Mongi\Mongicommerce\Seedeers;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypesPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Stripe',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Bonifico',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'In Negozio',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],

        ];
        DB::table('payment_type')->insert($data);
    }
}
