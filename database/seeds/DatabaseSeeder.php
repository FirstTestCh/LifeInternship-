<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        
        $this->call(TicketStatusSeeder::class);
        
        if (App::environment() === 'local') //development
        {
            $this->call(TicketCategorySeeder::class);
            $this->call(TicketSeeder::class);
            
            // one user for testing
            DB::table('users')->insert([
                'email' => 'life@chocolife.me',
                'name' => 'life',
                'password' => Hash::make('secret'),
            ]);
        }
        
        
    }
}
