<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Portion;
use App\Models\land;
use App\Models\User;
use Carbon\Carbon;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class PDFController extends Controller
{
    public function generatePDF($id)
    {

        $portion = Portion::find($id);
        $date = Carbon::parse($portion->updatedAt);
        $formatted_date = $date->format('M d Y');


        if (Auth::user()->id !== $portion->user_id  ) {
            return redirect()->back()->with('error', 'Unauthorized Page');
        }

        $data = [
            'user' => User::where('id', $portion->user_id)->first(),
            'portion' => $portion,
            'land' => Land::where('name', $portion->land_id)->first(),
            'date' => $formatted_date
        ];

        $pdf = PDF::loadView('pdf.template', $data);

        $pdf->getDomPDF()->setBasePath(public_path('./'));

        return $pdf->stream('hati.pdf');
    }
}
