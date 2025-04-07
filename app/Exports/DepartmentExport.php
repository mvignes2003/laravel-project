<?php

namespace App\Exports;

use App\Models\Department;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DepartmentExport implements FromCollection, WithHeadings
{
    /**
     * Return a collection of departments for export
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // dd(Department::all());
        return Department::all();
    }

    /**
     * Define the column headings for the export
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Description',
            'Created At',
            'Updated At',
        ];
    }
}
