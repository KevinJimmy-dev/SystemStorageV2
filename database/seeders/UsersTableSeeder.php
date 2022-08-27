<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Coordinator;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        $user = User::create([
            'name' => 'Kevin Jimmy',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'cpf' => '11223344556',
            'phone' => '123456789',
        ]);

        $admin = Admin::create([
            'user_id' => $user->id
        ]);

        $user->update([
            'admin_id' => $admin->id
        ]);

        // Coordinator
        $user1 = User::create([
            'name' => 'Paulo Henrique',
            'email' => 'coordinator@coordinator.com',
            'password' => Hash::make('password'),
            'cpf' => '33445566778',
            'phone' => '234567890',
        ]);

        $coordinator = Coordinator::create([
            'user_id' => $user1->id
        ]);

        $user1->update([
            'coordinator_id' => $coordinator->id
        ]);

        // Employee
        $user2 = User::create([
            'name' => 'Gabriel Pedrão',
            'email' => 'employee@employee.com',
            'password' => Hash::make('password'),
            'cpf' => '22334455667',
            'phone' => '345678901',
        ]);

        $employee = Employee::create([
            'user_id' => $user2->id
        ]);

        $user2->update([
            'employee_id' => $employee->id
        ]);

        // Employee 1
        $user3 = User::create([
            'name' => 'Felipe Garcia',
            'email' => 'employee1@employee.com',
            'password' => Hash::make('password'),
            'cpf' => '44556677889',
            'phone' => '456789012',
        ]);

        $employee1 = Employee::create([
            'user_id' => $user3->id
        ]);

        $user3->update([
            'employee_id' => $employee1->id
        ]);
    }
}
