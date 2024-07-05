<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentsEmailImport implements ToModel,WithChunkReading, ShouldQueue, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Student([
            "email"=> $row["email"],
            "name"=> $row["name"],
            "password"=> Hash::make($row["password"]),
            "university_id"=> $row["university_id"],
            "phone"=> $row["phone"],
        ]);
    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
