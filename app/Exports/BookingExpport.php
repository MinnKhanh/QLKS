<?php

namespace App\Exports;

use App\Enums\StatusBookingEnum;
use App\Enums\TypeBooking;
use App\Enums\TypeTimeEnum;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class BookingExpport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithCustomStartCell
{
    private $list;
    private $index;

    public function __construct($list)
    {
        $this->list = $list;
        $this->index = 0;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        return $this->list;
    }
    public function map($data): array
    {
        $this->index++;
        // dd($data);
        return [
            $this->index,
            $data['customer']['name'],
            $data['room']['name'],
            TypeBooking::getName($data['type']),
            $data['checkin_date'],
            $data['number_of_adults'],
            $data['number_of_children'],
            TypeTimeEnum::getName($data['type_time']),
            $data['deposit'],
            $data['price_service'],
            $data['late_checkin_fee'] + $data['early_checkIn_fee'],
            $data['total_price'],
            StatusBookingEnum::getName($data['status']),
        ];
    }
    public function headings(): array
    {
        return [
            'TT',
            'NGƯỜI ĐẶT',
            'PHÒNG',
            'NGÀY VÀO',
            'NGÀY RA',
            'SỐ NGƯỜI LỚN',
            'SỐ TRẺ EM',
            'LOẠI THỜI GIAN THUÊ',
            'TIỀN TRẢ TRƯỚC',
            'TIỀN DỊCH VỤ',
            'PHỤ PHÍ',
            'TỔNG TIỀN',
            'LOẠI ĐẶT',
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
    // public function registerEvents()
    // {
    // dd($this->data->count());
    // $count = $this->order['quantity'];
    // $name = $this->order['name'];
    // $address = $this->order['address'];
    // $discount = $this->order['dicountPrice'];
    // $price = $this->order['total_price'];
    // return [AfterSheet::class => function (AfterSheet $event) use ($count, $name, $address, $price, $discount) {
    //     $default_font_style = [
    //         'font' => [
    //             'name' => 'Times New Roman', 'size' => 12, 'color' => ['argb' => '#FFFFFF'],
    //             'background' => [
    //                 'color' => '#5B9BD5'
    //             ]
    //         ]
    //     ];

    //     $active_sheet = $event->sheet->getDelegate();
    //     $active_sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);
    //     $arrayAlphabet = [
    //         'A', 'B', 'C'
    //     ];
    //     foreach ($arrayAlphabet as $alphabet) {
    //         $event->sheet->getColumnDimension($alphabet)->setAutoSize(true);
    //     };
    //     $cellRange = 'A1:E1';
    //     $active_sheet->mergeCells($cellRange);
    //     $active_sheet->getStyle($cellRange)->getFont()->setBold(true);
    //     $active_sheet->getStyle($cellRange)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    //     $active_sheet->setCellValue('A1', 'ĐỒ GIA DỤNG');
    //     $active_sheet->mergeCellsByColumnAndRow(1, 2, 5, 3)->getStyle('A2:E2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    //     $active_sheet->getStyle('A2:E2')->getFont()->setBold(true);
    //     $active_sheet->setCellValue('A2', 'HÓA ĐƠN BÁN HÀNG');
    //     $active_sheet->mergeCells('A5:C5');
    //     $active_sheet->setCellValue('A5', 'Tên Khách Hàng: ' . $name);
    //     $active_sheet->mergeCells('A6:C6');
    //     $active_sheet->setCellValue('A6', 'Địa Chỉ: ' . $address);
    //     $endRange = "A$count:E$count";
    //     $active_sheet->mergeCells($endRange);
    //     $active_sheet->setCellValue("A$count", 'Tổng Tiền: ' . (floatval($price) - floatval($discount)) . ' - ' . 'Khuyến Mại: ' . $discount);
    //     $active_sheet->getStyle($endRange)->getFont()->setBold(true);
    // },];
    //     return [];
    // }
}
