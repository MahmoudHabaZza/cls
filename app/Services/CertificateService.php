<?php

namespace App\Services;

use App\Models\Course;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CertificateService {
    public function __construct(public CertificateRepositoryInterface $repository) { // model binding => service container
    }
    public function generateCertificate(int $courseId)
    {
        $user = Auth::user();
        $course = Course::findOrFail($courseId);

        $enrollment = $user->courses()->where('course_id', $courseId)->first();
        if (!$enrollment || $enrollment->pivot->progress < 100) {
            return ['error' => 'Course not completed.', 'status' => 403];

        }

        $existing = $this->repository->getByUserAndCourse($user->id, $courseId);
        if ($existing) {
            return $existing;
        }

        $pdf = Pdf::loadView('pdf-templates.certificate', [
            'user' => $user,
            'course' => $course,
            'date' => now()->format('F j, Y')
        ]);

        $path = "certificates/{$user->id}_{$courseId}_certificate.pdf";
        Storage::disk('public')->put($path, $pdf->output());
        

        $certificate = $this->repository->create([
            'user_id' => $user->id,
            'course_id' => $courseId,
            'certificated_at' => now(),
            'certificate_file_path' => $path
        ]);

        return $certificate;

        
    }
}