<?php 

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ProductCodeImport implements ToCollection
{
    protected $data = [];

    public function collection(Collection $rows)
    {
        $this->data = $rows->pluck(0)->toArray(); // Retrieve data from the first column
    }

    public function getData()
    {
        return $this->data;
    }
}
