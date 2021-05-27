<?php

namespace App\Util;

use App\Interfaces\DownloadFile;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class DownloadExcelFile implements DownloadFile
{
    public function download($name)
    {
        return Order::all()->where('user_id', '=', Auth::id())->downloadExcel(
            $name,
            $writerType = null,
            $headings = true
        );
    }
}
