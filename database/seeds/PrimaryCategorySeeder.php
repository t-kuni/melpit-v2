<?php

use Illuminate\Database\Seeder;
use App\Models\PrimaryCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PrimaryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records = [
            [
                'id'      => 1,
                'name'    => 'レディース',
                'sort_no' => 1,
            ],
            [
                'id'      => 2,
                'name'    => 'メンズ',
                'sort_no' => 2,
            ],
            [
                'id'      => 3,
                'name'    => 'ベビー・キッズ',
                'sort_no' => 3,
            ],
            [
                'id'      => 4,
                'name'    => 'その他',
                'sort_no' => 4,
            ],
        ];

        Schema::disableForeignKeyConstraints();

        DB::transaction(function () use ($records) {
            PrimaryCategory::query()->delete();
            foreach ($records as $record) {
                PrimaryCategory::factory()->create($record);
            }
        });

        Schema::enableForeignKeyConstraints();
    }
}
