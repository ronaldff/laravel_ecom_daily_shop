<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use TCPDFX;

class AdminTcpdfController extends Controller
{
    public function tcpdf()
    {
        TCPDFX::SetTitle('Hello World');
        TCPDFX::AddPage();
        TCPDFX::Write(0, 'Hello World');
        TCPDFX::Output('hello_world.pdf');
    }
}
