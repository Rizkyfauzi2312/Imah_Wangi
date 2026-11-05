<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Illuminate\Support\Collection;

class SalesReportExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, WithTitle, WithEvents, ShouldAutoSize
{
    protected $data;
    protected $rowCount;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->rowCount = $data['transactions']->count();
    }

    public function collection()
    {
        return $this->data['transactions']->map(function ($transaction) {
            return [
                $transaction->order_number,
                $transaction->customer_name,
                $transaction->customer_email ?? '-',
                $transaction->customer_phone ?? '-',
                $transaction->created_at->format('d/m/Y H:i'),
                ucfirst($transaction->status),
                $transaction->total_amount,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Order Number',
            'Customer Name',
            'Email',
            'Phone',
            'Date',
            'Status',
            'Amount (Rp)',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18,
            'B' => 25,
            'C' => 28,
            'D' => 18,
            'E' => 18,
            'F' => 12,
            'G' => 18,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header style - Luxury Gold on Dark Background
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'D4AF37'], // Gold color
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '1A1A2E'], // Dark navy
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'D4AF37'],
                ],
            ],
        ];

        return [
            1 => $headerStyle,
        ];
    }

    public function title(): string
    {
        return 'Sales Report';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastRow = $this->rowCount + 1;
                $summaryRow = $lastRow + 1;

                // Title section (rows above header)
                $sheet->insertNewRowBefore(1, 4);
                
                // Merge and style title
                $sheet->mergeCells('A1:G1');
                $sheet->setCellValue('A1', 'Imah Wangi');
                $sheet->getStyle('A1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 20,
                        'color' => ['rgb' => '1A1A2E'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Subtitle
                $sheet->mergeCells('A2:G2');
                $sheet->setCellValue('A2', 'Luxury Custom Perfumes');
                $sheet->getStyle('A2')->applyFromArray([
                    'font' => [
                        'italic' => true,
                        'size' => 11,
                        'color' => ['rgb' => '666666'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Report info
                $sheet->mergeCells('A3:G3');
                $sheet->setCellValue('A3', $this->data['periodDescription']);
                $sheet->getStyle('A3')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => ['rgb' => 'D4AF37'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Generated date
                $sheet->mergeCells('A4:G4');
                $sheet->setCellValue('A4', 'Generated: ' . $this->data['generatedAt']);
                $sheet->getStyle('A4')->applyFromArray([
                    'font' => [
                        'size' => 10,
                        'color' => ['rgb' => '999999'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Adjust row heights
                $sheet->getRowDimension(1)->setRowHeight(30);
                $sheet->getRowDimension(5)->setRowHeight(25);

                // Data rows styling
                $dataLastRow = $this->rowCount + 5;
                
                // Zebra striping for data rows
                for ($i = 6; $i <= $dataLastRow; $i++) {
                    if ($i % 2 === 0) {
                        $sheet->getStyle("A{$i}:G{$i}")->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F8F9FA'],
                            ],
                        ]);
                    }
                    
                    // Border for all data cells
                    $sheet->getStyle("A{$i}:G{$i}")->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => 'E0E0E0'],
                            ],
                        ],
                    ]);
                }

                // Format amount column as currency
                $sheet->getStyle("G6:G{$dataLastRow}")->getNumberFormat()
                    ->setFormatCode('#,##0');
                
                // Right align amount column
                $sheet->getStyle("G6:G{$dataLastRow}")->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);

                // Summary section
                $summaryStartRow = $dataLastRow + 2;
                
                // Summary title
                $sheet->mergeCells("A{$summaryStartRow}:G{$summaryStartRow}");
                $sheet->setCellValue("A{$summaryStartRow}", 'REPORT SUMMARY');
                $sheet->getStyle("A{$summaryStartRow}")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'color' => ['rgb' => '1A1A2E'],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D4AF37'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                    ],
                ]);

                // Summary data
                $sheet->setCellValue("A" . ($summaryStartRow + 1), 'Total Transactions:');
                $sheet->setCellValue("B" . ($summaryStartRow + 1), $this->data['totalTransactions']);
                
                $sheet->setCellValue("A" . ($summaryStartRow + 2), 'Total Revenue:');
                $sheet->setCellValue("B" . ($summaryStartRow + 2), 'Rp ' . number_format($this->data['totalRevenue'], 0, ',', '.'));
                
                $sheet->setCellValue("A" . ($summaryStartRow + 3), 'Products Sold:');
                $sheet->setCellValue("B" . ($summaryStartRow + 3), $this->data['totalProducts']);
                
                $sheet->setCellValue("A" . ($summaryStartRow + 4), 'Custom / Ready Stock:');
                $sheet->setCellValue("B" . ($summaryStartRow + 4), $this->data['customCount'] . ' / ' . $this->data['readyStockCount']);

                // Style summary labels
                $summaryEndRow = $summaryStartRow + 4;
                $sheet->getStyle("A" . ($summaryStartRow + 1) . ":A{$summaryEndRow}")->applyFromArray([
                    'font' => ['bold' => true],
                ]);

                // Add border to summary section
                $sheet->getStyle("A{$summaryStartRow}:G{$summaryEndRow}")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_MEDIUM,
                            'color' => ['rgb' => 'D4AF37'],
                        ],
                    ],
                ]);
            },
        ];
    }
}
