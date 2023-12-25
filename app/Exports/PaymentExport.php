<?php

namespace App\Exports;

use App\Enums\StatusPayment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PaymentExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithCustomStartCell
{
    private $payment;
    private $index;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($payment)
    {
        $this->payment = $payment;
        $this->index = 0;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        return $this->payment;
    }
    public function map($data): array
    {
        $this->index++;
        // dd($data);
        return [
            $this->index,
            $data['customer']['name'],
            $data['phone'],
            $data['cmtnd'],
            $data['note'],
            $data['amount'],
            StatusPayment::getName($data['satus'])
        ];
    }
    public function headings(): array
    {
        return [
            'TT',
            'NGƯỜI ĐẶT',
            'ĐIỆN THOẠI',
            'CMTND',
            'GHI CHÚ',
            'THÀNH TIỀN',
            'TRẠNG THÁI'
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
}
