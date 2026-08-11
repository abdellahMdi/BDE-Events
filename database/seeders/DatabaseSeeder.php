<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Roles first (users depend on role_id)
        DB::table('roles')->insert([
            ['id' => 1, 'label' => 'admin', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'label' => 'student', 'created_at' => now(), 'updated_at' => now()]
        ]);

        // 2. Seed Users (pass : qwerty123)
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'John',
                'lastName' => 'Doe',
                'email' => 'organizer@example.com',
                'password' => Hash::make('qwerty123'),
                'role_id' => 2, // Organizer role
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Jane',
                'lastName' => 'Smith',
                'email' => 'attendee@example.com',
                'password' => Hash::make('qwerty123'),
                'role_id' => 1, // Participant role
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 3. Seed Events (created_by references users.id)
        DB::table('events')->insert([
            [
                'id' => 1,
                'title' => 'Tech Conference 2026',
                'description' => 'A grand event about modern tech.',
                'place' => 'Convention Center, Room A',
                'date' => '2026-09-15',
                'houre' => '10:00 AM', // Matches 'houre' in events table
                'price' => 49.99,
                'places_limite' => 100,
                'created_by' => 1, // Created by User ID 1
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 4. Seed Reservations (user_id and event_id)
        DB::table('reservations')->insert([
            [
                'id' => 1,
                'user_id' => 2, // User ID 2
                'event_id' => 1, // Event ID 1
                'reserved_at' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        // 5. Seed Tickets (reservation_id)
        DB::table('tickets')->insert([
            [
                'id' => 1,
                'reservation_id' => 1, // Reservation ID 1
                'ticket_code' => 'BDE-2026-' . strtoupper(Str::random(8)),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}