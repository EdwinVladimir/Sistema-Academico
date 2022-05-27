<?php

namespace App\Http\Controllers\Api;
use App\Http\Requests\PermissionStoreRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return PermissionResource::collection(permission::all());
    }
    
}
