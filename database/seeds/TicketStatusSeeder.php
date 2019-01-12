<?php

use Illuminate\Database\Seeder;
use App\Models\TicketStatus;

class TicketStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ["name" => "Новый"],
            ["name" => "Принят"],
            ["name" => "В обработке"],
            ["name" => "Отвечен"],
            ["name" => "Закрыт"],
        ];

        $res = TicketStatus::insert($data);

    }
}
