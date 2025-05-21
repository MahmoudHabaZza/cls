<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CertificateService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CertificateController extends Controller
{
    public function __construct(public CertificateService $service)
    {
        
    }
    public function generate($courseId)
    {
        return $this->service->generateCertificate($courseId);
    }
}
