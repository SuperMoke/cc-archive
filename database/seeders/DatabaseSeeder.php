<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Stage;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "fullname" => "John Doe",
            "email" => "admin.developer@gmail.com",
            "password" => bcrypt("123"),
            "is_admin" => true
        ]);

        User::create([
            "fullname" => "Juan Dela Cruz",
            "email" => "dummy@gmail.com",
            "password" => bcrypt("123"),
            "is_teacher" => true
        ]);

        User::create([
            "fullname" => "John Carlo",
            "email" => "dummy2@gmail.com",
            "password" => bcrypt("123"),
            "is_student" => true
        ]);

        Stage::create([
            "j_kanban_id" => "_open",
            "class" => "kanban-light",
            "name" => "Not Yet Started"]);
        Stage::create([
            "j_kanban_id" => "_in_progress",
            "class" => "kanban-primary",
            "name" => "Ongoing"]);
        Stage::create([
            "j_kanban_id" => "_completed",
            "class" => "kanban-success",
            "name" => "Done",
            "is_done" => true]);
    }
}
