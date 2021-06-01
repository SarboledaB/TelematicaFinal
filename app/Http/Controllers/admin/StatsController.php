<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use Illuminate\Support\Facades\Mail;
use App\Mail\Statistics;

class StatsController extends Controller
{
    public function sendStats()
    {
        $commune = [
            'comuna 1',
            'comuna 2',
            'comuna 3',
            'comuna 4',
            'comuna 5',
            'comuna 6',
            'comuna 7',
            'comuna 8',
            'comuna 9',
            'comuna 10'
        ];
        $resp = [
            'comuna 1' => null,
            'comuna 2' => null,
            'comuna 3' => null,
            'comuna 4' => null,
            'comuna 5' => null,
            'comuna 6' => null,
            'comuna 7' => null,
            'comuna 8' => null,
            'comuna 9' => null,
            'comuna 10' => null,
        ];
        $resp  = (object) $resp;
        $career = [
            'Medicina',
            'Ingenieria',
            'Derecho',
            'Licenciatura'
        ];
        $dataStats = [];
        foreach ($commune as $key => $value) {
            $acum = [
                'Medicina' => 0,
                'Ingenieria' => 0,
                'Derecho' => 0,
                'Licenciatura' => 0
            ];
            $acum = (object) $acum;
            foreach ($career as $key => $val) {
                $count = Survey::where([
                    ['commune', $value],
                    ['career', $val]
                ])->count();
                $acum->$val = $count;
            }
            /* array_push($dataStats, $acum); */
            $resp->$value = $acum;
        }
        Mail::to('sarboledabotero@gmail.com')->send(new Statistics($resp));
        return back()->with('success', 'Se han enviado las Estadisticas al administrador!');
        /* return response()->json($resp, 200); */
    }
}
