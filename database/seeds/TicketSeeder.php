<?php

use Illuminate\Database\Seeder;
use App\Models\TicketStatus;
use App\Models\TicketCategory;
use App\User;


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
        $users = User::all();

        factory(App\Models\Ticket::class, 20)->make()->each(function ($ticket)
        use($statuses, $categories, $users) {
           $ticket->ticket_category = $categories->random()->id;
           $ticket->ticket_status = $statuses->random()->id;
           if ($ticket->status->id >= 3) {
             $ticket->admin_id = $users->random()->id;
           }
           $ticket->save();
        });
        
    }
}
