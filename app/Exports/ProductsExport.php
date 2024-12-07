<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductsExport implements FromCollection, WithHeadings, WithTitle, WithCustomStartCell, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Product::all(['id', 'name', 'category_id', 'purchase_price', 'sale_price', 'stock'])->map(function ($product, $index) {
            return [
                'no' => $index + 1,
                'name' => $product->name,
                'category' => $product->category->name, // Mengambil nama kategori melalui relasi
                'purchase_price' => $product->purchase_price,
                'sale_price' => $product->sale_price,
                'stock' => $product->stock,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama Produk',
            'Kategori Produk',
            'Harga Barang',
            'Harga Jual',
            'Stok',
        ];
    }

    public function title(): string
    {
        return 'Data Produk';
    }

    public function startCell(): string
    {
        return 'A3'; // Data dimulai dari baris ke-3
    }

    public function styles(Worksheet $sheet)
    {
        // Judul di baris pertama
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'DATA PRODUK');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 16,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Header tabel di baris ke-3
        $sheet->getStyle('A3:F3')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E26B0A'], // untuk ubah bg
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Border seluruh tabel
        $sheet->getStyle('A3:F' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        return $sheet;
    }
}
