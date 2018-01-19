<?php

use App\Shop\Employees\Employee;
use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Employee::class)->create();
    }
}