<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TiposangreStoreRequest;
use App\Http\Resources\TiposangreResource;
use App\Models\tiposangre;
use Illuminate\Http\Request;

class PieReporteController extends Controller
{
    public function index()
    {
        return view('web.piereporte');
    }
}