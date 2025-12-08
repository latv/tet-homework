<?php
namespace App\Imports;

use App\Models\Product; // Adjust namespace if your Product model is in a package
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Contracts\Queue\ShouldQueue; // <--- The most important part for you

class ProductsImport implements ToModel, WithHeadingRow, WithChunkReading, ShouldQueue
{
    public function model(array $row)
    {

        return new Product([
            'name'        => $row['name'],
            'description' => $row['description'] ?? null,
            'price'       => $row['price'],
            'stock'       => $row['stock'] ?? 0,
            'is_active'   => true,
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}