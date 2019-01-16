<?php

use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(App\Models\TicketCategory::class, 5)->create();
        $names = [
            'Запрос',
            'Проблема',
            'Вопрос'
        ];
        foreach ($names as $name) {
            DB::table('ticket_category')->insert([
                'name' => $name
            ]);
        }
    }
}
