<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

// use File;

// use Response;

// use DB;

class DownloadController extends Controller
{
    public function downloadfile()
    {
        return Response::download(public_path("imagen/20230122190333.jpeg"));
    }
}
