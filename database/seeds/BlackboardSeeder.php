<?php

use Illuminate\Database\Seeder;

class BlackboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Adding base roles

        DB::table('user_roles')->insert([
            'id' => 1,
            'name' => 'Administrator',
            'can_edit_project' => true,
            'can_create_ticket' => true,
            'can_delete_ticket' => true,
            'can_update_ticket' => true
        ]);

        DB::table('user_roles')->insert([
            'name' => 'Developper',
            'can_edit_project' => false,
            'can_create_ticket' => true,
            'can_delete_ticket' => false,
            'can_update_ticket' => true
        ]);

        DB::table('user_roles')->insert([
            'name' => 'Boss',
            'can_edit_project' => true,
            'can_create_ticket' => true,
            'can_delete_ticket' => false,
            'can_update_ticket' => true
        ]);


        DB::table('ticket_statuses')->insert([
            'id' => 0,
            'name' => 'Closed',
            'class' => 'muted'
        ]);

        DB::table('ticket_statuses')->insert([
            'id' => 1,
            'name' => 'Open',
            'class' => 'success'
        ]);

        DB::table('ticket_priorities')->insert([
            'name' => 'Normal',
            'class' => 'success'
        ]);

        DB::table('ticket_priorities')->insert([
            'name' => 'Urgent',
            'class' => 'error'
        ]);

        DB::table('user_invitations')->insert([
            'token' => 'welcome'
        ]);

    }
}
