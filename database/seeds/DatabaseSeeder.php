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
            
            // Admin
            DB::table('users')->insert([
                'email' => 'admin@chocolife.me',
                'name' => 'life',
                'password' => Hash::make('secret'),
                'role' => 0,
            ]);

            // SZP Admin
            DB::table('users')->insert([
                'email' => 'szp@chocolife.me',
                'name' => 'life',
                'password' => Hash::make('secret'),
                'role' => 1,
            ]);
        }
        
        
    }
}
