<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;


class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::all();
    }

    public function headings(): array
    {
        return ['ID', 'Nama', 'Email', 'Jabatan', 'Status'];
    }

public function exportExcel()
{
    return Excel::download(new UsersExport, 'users.xlsx');
}


}

