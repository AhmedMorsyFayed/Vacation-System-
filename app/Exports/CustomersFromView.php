<?php

namespace App\Exports;


use App\User; //Report about excel sheet about vacations and permissions

use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CustomersFromView implements FromQuery,WithHeadings,ShouldAutoSize , WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */


    /**
     * @return View
     */
    use Exportable;

    /**
     * @var string
     */
    private $Department;
    private $level;


    public function __construct(string $Department,string $level)
    {

        $this->Department = $Department; //employee department
        $this->level = $level;  // employee level

    }

        public function query()
    {
        return User::query()->select( // sql getting the information about employee
            'name','vacationsbalance'

        )->where('Department', $this->Department)
            ->where('Manager', $this->level);


    }



    public function headings(): array
    {
        return [

            'Name','Vacations Balance'



        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A0:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

            },
        ];
    }

    /**
     * @return Builder
     */

}
