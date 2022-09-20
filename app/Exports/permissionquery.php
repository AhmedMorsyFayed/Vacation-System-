<?php


namespace App\Exports;
use App\Permissions;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize; //Report about excel sheet about vacations and permissions
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;


class permissionquery implements FromQuery,WithHeadings,ShouldAutoSize , WithEvents
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

    public function query() // sql getting the information about employee
    {
        return Permissions::query()->select('id',
            'Name',
            'Department','day',
            'Start','End','idpermision','permisionshours','manger','status'
            ,'creation','AprovaleDate','HRname','HR','AprovaleHRDate',	'UpdateHRDate'
        )->where('name', $this->name)
            ->whereYear('day', '=', $this->year);


    }

    /**
     * @return Builder
     */
    public function headings(): array
    {
        return [
            'id',
            'Name',
            'Department','Day',
            'Start','End','IdPermission','Hours','Manger','Status'
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
