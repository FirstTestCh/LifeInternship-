<?php

use Illuminate\Database\Seeder;
use App\Models\TicketStatus;
use App\Models\TicketCategory;


class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = TicketStatus::all();
        $categories = TicketCategory::all();

        factory(App\Models\Ticket::class, 20)->make()->each(function ($ticket)
        use($statuses, $categories) {
           $ticket->ticket_category = $categories->random()->id;
           $ticket->ticket_status = $statuses->random()->id;
           $ticket->save();
        });
        
    }
}
