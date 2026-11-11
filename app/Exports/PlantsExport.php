<?php

namespace App\Exports;

use App\Models\Plant;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlantsExport implements FromCollection, ShouldAutoSize, WithHeadings, WithMapping, WithStyles
{
    private int $rowNumber = 0;

    public function __construct(
        private Collection $plants,
        private array $filters = []
    ) {}

    public function collection(): Collection
    {
        return $this->plants;
    }

    public function headings(): array
    {
        return [
            'No.', 'Plant Name', 'Category', 'Unit Price',
            'Stock Status', 'Description', 'Added By', 'Date Added',
        ];
    }

    /**
     * @param  Plant  $plant
     */
    public function map($plant): array
    {
        $this->rowNumber++;

        return [
            $this->rowNumber,
            $plant->name,
            $plant->category_label,
            number_format((float) $plant->unit_price, 2),
            $plant->stock_label,
            $plant->description,
            $plant->user->name ?? 'N/A',
            $plant->created_at->format('Y-m-d'),
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
