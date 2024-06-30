<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\SectionStudent;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class StudentsImport implements ToModel, WithChunkReading, ShouldQueue, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public $section_id;
    public function __construct($section_id)
    {
        $this->section_id = $section_id;
    }
    public function excelSerialToDate($serial)
    {
        return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($serial));
    }

    public function model(array $row)
    {
       
        $from = $row["from"];
        $to = $row["to"];
        $fromDate = $this->excelSerialToDate($from);
        $toDate = $this->excelSerialToDate($to);
        
        // Fetch student ID based on email
        if(isset($row["email"])){
            $email = $row["email"];
            $student = Student::where('email', $email)->first();
        }elseif(isset($row['university_id'])){
            $university_id = $row["university_id"];
            $student = Student::where('university_id', $university_id)->first();  
        }


        

        if ($student) {
            return new SectionStudent([
                'university_id' => $row["university_id"] ?? $student->university_id,
                'from' => $fromDate,
                'to' => $toDate,
                'section_id' => $this->section_id,
                'student_id' => $student->id,
            ]);
        }

    }
    public function chunkSize(): int
    {
        return 1000;
    }
}
