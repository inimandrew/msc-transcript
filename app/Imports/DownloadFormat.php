<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class DownloadFormat implements FromCollection,ShouldAutoSize
{
    /**
    * @param Collection $collection
    */
    public function collection()
    {
             return new Collection([
            ['Candidate Full-name','Status','Qualification','University','Year of Graduation','Class of Degree',
            'Degree in View',"Referee Report Received",'Transcript Received (GPA)','Concept Note','Written Score','Oral Score',
            'Departmental Graduate Committee Recommendation','Faculty Graduate Committee Recommendation','Graduate School Recommendation']
        ]);
    }
}
