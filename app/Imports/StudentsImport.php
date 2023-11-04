<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{


    public function model(array $row)
    {
        return new Student([
            'image' => $row['image'],
            'name' => $row['name'],
            'date_of_birth' => $row['date_of_birth'],
            'address' => $row['address'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'classes_id' => $row['classes_id'],
        ]);
    }
}
