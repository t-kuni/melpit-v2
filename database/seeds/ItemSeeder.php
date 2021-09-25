<?php

use App\Models\Item;
use App\Models\ItemCondition;
use App\Models\SecondaryCategory;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');

        $categories = SecondaryCategory::all();
        $conditions = ItemCondition::all();
        $users = User::all();

        $records = [];
        for ($i = 0; $i < 100; $i++) {
            $state = $faker->randomElement([Item::STATE_BOUGHT, Item::STATE_SELLING]);
            $buyerId = $state === Item::STATE_BOUGHT ? $faker->randomElement($users)->id : null;

            $records[] = [
                'seller_id'             => $faker->randomElement($users)->id,
                'buyer_id'              => $buyerId,
                'secondary_category_id' => $faker->randomElement($categories)->id,
                'item_condition_id'     => $faker->randomElement($conditions)->id,
                'name'                  => '商品' . $i,
                'image_file_name'       => '',
                'description'           => $faker->realText,
                'price'                 => $faker->numberBetween(100, 9999),
                'state'                 => $state,
                'bought_at'             => $faker->dateTimeBetween('-3 days', '-1 days'),
                'created_at'            => Carbon::now(),
            ];
        }

        Schema::disableForeignKeyConstraints();

        DB::transaction(function () use ($records) {
            DB::table('items')->delete();
            DB::table('items')->insert($records);
        });

        Schema::enableForeignKeyConstraints();
    }
}
