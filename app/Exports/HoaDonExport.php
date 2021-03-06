<?php

namespace App\Exports;

use App\Models\HoaDonModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Session;
use DB;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class HoaDonExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public $order_id;
    public function view() : View
    {
        $this->order_id = Session::get('order_id');
        $order = DB::table('order')
                ->join('customer', 'order.customer_id', '=', 'customer.id')
                ->select('order.*', 'customer.name')
                ->where('order.id', $this->order_id)
                ->first();
        $use_voucher = DB::table('use_voucher')
                ->join('voucher', 'use_voucher.voucher_id', '=', 'voucher.ID')
                ->where('use_voucher.order_id', $this->order_id)
                ->first();
        if ($use_voucher){
            $order->voucher_value = $use_voucher->value;
        }
        else {
            $order->voucher_value = 0;
        }
        $order_detail = DB::table('order_detail')
                ->where('order_id', $this->order_id)
                ->get();
        $shipping = DB::table('order')
                ->join('shipping', 'order.shipping_id', '=', 'shipping.id')
                ->join('payment', 'order.payment_id', '=', 'payment.id')
                ->select('order.*', 'shipping.*', 'payment.method')
                ->where('order.id', $this->order_id)
                ->first();
        Session::put('order_id', NULL);
        return view('admin/order/excel')
                ->with  ([
                        'order'=>$order,
                        'order_detail'=>$order_detail,
                        'shipping'=>$shipping,
                        ]);
    }

    public function registerEvents(): array
    {
        // 'fill' => [
        //     'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        //     'color' => ['argb' => "#16365C"]
        // ]
        return [
            // Handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getStyle('B2:F2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 17,
                        'name' => 'Cambria',
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);
                $event->sheet->getStyle('B3:F3')->applyFromArray([
                    'font' => [
                        'size' => 13,
                        'name' => 'Cambria',
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);
                $event->sheet->getStyle('A5:F5')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 15,
                        'name' => 'Cambria',
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);
                $event->sheet->getStyle('A6:F6')->applyFromArray([
                    'font' => [
                        'size' => 10,
                        'name' => 'Cambria',
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT],
                ]);
                $event->sheet->getStyle('A8:F8')->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                ]);
                $event->sheet->getStyle('A9:F9')->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                ]);
                $event->sheet->getStyle('A10:F10')->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                ]);
                $event->sheet->getStyle('A12:F12')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['argb' => "99F0B5"]
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
                $event->sheet->getStyle('A12:F12')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
                $product_count = DB::table('order_detail')
                    ->where('order_id', '=', $this->order_id)
                    ->count();
                for($i=13; $i<$product_count+13; $i++)
                {
                    $event->sheet->getStyle('A'.$i.':F'.$i)->applyFromArray([
                        'font' => [
                            'size' => 12,
                            'name' => 'Cambria',
                        ],
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => '000000'],
                            ],
                        ],
                    ]);
                }
                $hangtieptheo = $product_count+13;
                $event->sheet->getStyle('A'.$hangtieptheo.':F'.$hangtieptheo)->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
                $hangtieptheo +=1;
                $event->sheet->getStyle('A'.$hangtieptheo.':F'.$hangtieptheo)->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);

                $hangtieptheo +=1;
                $event->sheet->getStyle('A'.$hangtieptheo.':F'.$hangtieptheo)->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
                ]);
                $hangtieptheo +=2;
                $event->sheet->getStyle('A'.$hangtieptheo.':F'.$hangtieptheo)->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                ]);

                $hangtieptheo +=1;
                $event->sheet->getStyle('A'.$hangtieptheo.':F'.$hangtieptheo)->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                ]);

                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(30);
                $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('8')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('9')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('10')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('12')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('13')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('14')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('15')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('16')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('17')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('18')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('19')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('20')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('21')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('22')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('23')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('24')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('25')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('26')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('27')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('28')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('29')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('30')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('31')->setRowHeight(23);


                $this->setImage2Excel($event);
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 17,
            'B' => 34,
            'C' => 14,
            'D' => 1,
            'E' => 20,
            'F' => 20,
        ];
    }

    private function setImage2Excel($event){
        $drawing = new Drawing();
        $drawing->setName('Logo');
        $drawing->setDescription('Logo');
        $drawing->setCoordinates('A2');
        $drawing->setPath(public_path().'\logo.png');
        $drawing->setWidth('100');
        $drawing->setHeight('100');
        $drawing->setWorksheet($event->sheet->getDelegate());
    }
}
