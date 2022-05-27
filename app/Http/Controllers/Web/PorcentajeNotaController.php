<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\TiposangreStoreRequest;
use App\Http\Resources\TiposangreResource;
use App\Models\Tiposangre;
use Illuminate\Http\Request;

class PorcentajeNotaController extends Controller
{
    public function index()
    {
        return view('web.porcentajenota');
    }
}