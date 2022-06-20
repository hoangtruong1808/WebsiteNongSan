<?php

namespace App\Exports;

use App\PhieuNhapHangModel;
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
use DB;

class PhieuNhapHangExport implements FromView, ShouldAutoSize, WithEvents, WithColumnWidths
{
    private $count_product;
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view() : View
    {
        $RowID = DB::table('import_goods')
            ->orderBy('id','DESC')
            ->first();
        $ID = $RowID->id;

        $phieunhaphang = DB::table('import_goods')
            ->join('supplier', 'supplier.id', '=', 'import_goods.supplier_id')
            ->join('staff', 'staff.id', '=', 'import_goods.staff_id')
            ->select('import_goods.*', 'supplier.name as supplier_name', 'supplier.phone as supplier_phone','staff.name as staff_name')
            ->where('import_goods.id', $ID)
            ->first();
        $chitietphieunhaphang = DB::table('import_goods_detail')
            ->join('product', 'product.id', '=', 'import_goods_detail.product_id')
            ->where('import_goods_detail.import_goods_id', $ID)
            ->get();
        $this->count_product = DB::table('import_goods_detail')
                    ->where('import_goods_detail.import_goods_id', $ID)
                    ->count();

        return view('admin.warehouse.goods_excel')
            ->with([
                'phieunhaphang'=>$phieunhaphang,
                'chitietphieunhaphang'=>$chitietphieunhaphang,
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
                $event->sheet->getStyle('A2:F2')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 17,
                        'name' => 'Cambria',
                    ],
                    'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
                ]);
                $event->sheet->getStyle('A3:F3')->applyFromArray([
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
                        'color' => ['argb' => "A9D0F5"]
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
                $current_row = 12;
                for($i = 1; $i <= $this->count_product; $i++) {
                    $current_row++;
                    $event->sheet->getStyle("A$current_row:F$current_row")->applyFromArray([
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
                $current_row++;
                $event->sheet->getStyle("A$current_row:F$current_row")->applyFromArray([
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
                $current_row++;
                $current_row++;
                $event->sheet->getStyle("A$current_row:F$current_row")->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                ]);
                $current_row++;
                $event->sheet->getStyle("A$current_row:F$current_row")->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                ]);
                $current_row++;
                $event->sheet->getDelegate()->getRowDimension("$current_row")->setRowHeight(50);
                $current_row++;
                $event->sheet->getStyle("A$current_row:F$current_row")->applyFromArray([
                    'font' => [
                        'size' => 12,
                        'name' => 'Cambria',
                    ],
                ]);
                $event->sheet->getDelegate()->getRowDimension('1')->setRowHeight(30);
                $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('8')->setRowHeight(21);
                $event->sheet->getDelegate()->getRowDimension('9')->setRowHeight(1);
                $event->sheet->getDelegate()->getRowDimension('10')->setRowHeight(21);
                $event->sheet->getDelegate()->getRowDimension('12')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('13')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('14')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('15')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('17')->setRowHeight(23);
                $event->sheet->getDelegate()->getRowDimension('18')->setRowHeight(23);
            },

        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
            'C' => 14,
            'D' => 20,
            'E' => 1,
            'F' => 20,
        ];
    }
}
