<?php

namespace App\Repositories;

use App\Models\Enrollment;
use App\Models\User;
use App\Repositories\Interfaces\EnrollmentRepositoryInterface;
use Illuminate\Http\Request;

class EnrollmentRepository implements EnrollmentRepositoryInterface
{
    public function enrollInCourse(User $user, $courseId)
    {
        $user->courses()->syncWithoutDetaching([
            $courseId => [
                'enrolled_at' => now(),
                'progress' => 0
            ]
        ]);
    }

    public function isUserEnrolledInCourse($userId, $courseId): bool
    {
        return Enrollment::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->exists();
    }

    public function getEnrollment($userId, $courseId)
    {
        return Enrollment::where('user_id', $userId)
            ->where('course_id', $courseId)
            ->first();
    }


    public function filterEnrollments(Request $request)
    {
        $query = Enrollment::with(['user', 'course'])
            ->when(
                $request->filled('enrolled_from'),
                fn($q) =>
                $q->where('enrolled_at', '>=', $request->enrolled_from)
            )
            ->when(
                $request->filled('enrolled_to'),
                fn($q) =>
                $q->where('enrolled_at', '<=', $request->enrolled_to)
            )
            ->when(
                $request->filled('progress_min'),
                fn($q) =>
                $q->where('progress', '>=', (float) $request->progress_min)
            )
            ->when(
                $request->filled('progress_max'),
                fn($q) =>
                $q->where('progress', '<=', (float) $request->progress_max)
            )
            ->when(
                $request->filled('user_id'),
                fn($q) =>
                $q->whereHas('user', fn($user) => $user->where('id', $request->user_id))
            )
            ->when(
                $request->filled('user_name'),
                fn($q) =>
                $q->whereHas('user', fn($user) => $user->where('name', 'like', '%' . $request->user_name . '%'))
            )
            ->when(
                $request->filled('user_email'),
                fn($q) =>
                $q->whereHas('user', fn($user) => $user->where('email', 'like', '%' . $request->user_email . '%'))
            )
            ->when(
                $request->filled('course_name'),
                fn($q) =>
                $q->whereHas(
                    'course',
                    fn($course) =>
                    $course->where('name', 'like', '%' . $request->course_name . '%')
                )
            )
            ->when(
                $request->filled('description'),
                fn($q) =>
                $q->whereHas(
                    'course',
                    fn($course) =>
                    $course->where('description', 'like', '%' . $request->description . '%')
                )
            )
            ->when(
                $request->filled('level'),
                fn($q) =>
                $q->whereHas(
                    'course',
                    fn($course) =>
                    $course->where('level', $request->level)
                )
            )
            ->when(
                $request->filled(['min_price', 'max_price']),
                fn($q) =>
                $q->whereHas(
                    'course',
                    fn($course) =>
                    $course->whereBetween('price', [(float) $request->min_price, (float) $request->max_price])
                )
            )
            ->when(!$request->filled(['min_price', 'max_price']) && $request->filled('price'), function ($q) use ($request) {
                $price = (float) $request->price;
                $q->whereHas(
                    'course',
                    fn($course) =>
                    $course->whereBetween('price', [$price, $price + 0.99])
                );
            })
            ->when(
                $request->filled('sessions_count'),
                fn($q) =>
                $q->whereHas(
                    'course',
                    fn($course) =>
                    $course->where('sessions_count', $request->sessions_count)
                )
            )
            ->when(
                $request->filled('thumbnail'),
                fn($q) =>
                $q->whereHas(
                    'course',
                    fn($course) =>
                    $course->where('thumbnail', 'like', '%' . $request->thumbnail . '%')
                )
            );

        $perPage = $request->get('per_page', 15);
        return $query->paginate($perPage);
    }
}
