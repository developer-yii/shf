<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\ProductCode;
use App\Imports\ProductCodeImport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExcelImportCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        ini_set('max_execution_time', 180);
        $userid = Auth::user()->id;
        $import = new ProductCodeImport();
        $rows = Excel::toArray($import, $this->filePath);
        $successfulRows = 0;
        $duplicateRows = 0;
        
        $insertArray = [];
        $index = 0;
        $date = date('Y-m-d H:i:s');

        $allProductCode = ProductCode::select('code')->pluck('code')->toArray();        
        $chunkImportedCodes = [];
        foreach ($rows[0] as $row) {
            if(isset($row[0]) && !empty($row[0]) && $row[0]){
                $productCode = $row[0];
                if (in_array($productCode, $allProductCode) || in_array($productCode, $chunkImportedCodes)) {
                    $duplicateRows++;
                } else {
                    $insertArray[$index][] = ['code' => $productCode, 'added_by' => $userid, 'created_at' => $date, 'updated_at' => $date];
                    $chunkImportedCodes[] = $productCode;
                    $successfulRows++;
                    if (count($insertArray[$index]) == 1000) {                        
                        $index++;
                    }
                }
            }
        }
        foreach ($insertArray as $list)
        {            
            ProductCode::insert($list);            
        }
        dd([$successfulRows,$duplicateRows]);
        // Delete the temporary file
        Storage::delete($this->filePath);
    }
}
