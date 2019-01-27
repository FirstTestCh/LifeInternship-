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
        DB::table('ticket_category')->insert([
            ['name' => 'Вопрос'],
            ['name' => 'Проблема'],
            ['name' => 'Предложение'],
            ['name' => 'Проблема с оплатой купона'],
            ['name' => 'Проблема с участием в акции'],
            ['name' => 'Вопрос по рассылке'],
            ['name' => 'Запрос на возврат'],
            ['name' => 'Другое'],
        ]);
    }
}
