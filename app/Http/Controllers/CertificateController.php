<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Services\CertificateService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
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
        $certificate = $this->service->generateCertificate($courseId);
        if (is_array($certificate) && isset($certificate['error'])) {
            return Response::errorResponse($certificate['error'], $certificate['status']);
        }
        return Response::createdResponse('CertificateResource',$certificate);
    }
}
