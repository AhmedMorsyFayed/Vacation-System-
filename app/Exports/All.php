<?php


namespace App\Exports;


use App\Holiday;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class All implements FromQuery,WithHeadings,ShouldAutoSize , WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;

    /**
     * @var string
     */
    private $name;
    private $year;


    public function __construct(string $name,int $year)
    {

        $this->name = $name;
        $this->year = $year;

    }

    public function query() // sql getting the information about employee for HR
    {
        return Holiday::query()->select('id',
            'Name',
            'Department',
            'Start','End','VAcationsType','idHoliday','HloiDays','manger','status'
            ,'creation','AprovaleDate','HRname','HR','AprovaleHRDate',	'UpdateHRDate'
        )->where('name', $this->name)
            ->whereYear('start', '=', $this->year)
            ->whereYear('end', '=', $this->year);

    }

    /**
     * @return Builder
     */
    public function headings(): array
    {
        return [
            'id',
            'Name',
            'Department',
            'Start','End','Vacations Type','IdHoliday','Days','Manger','Status'
            ,'Creation','Approve Date','HR name','HR','Approve HRDate',	'Update HRDate'

        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);

            },
        ];
    }
}
