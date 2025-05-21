<!DOCTYPE html>
<html>
<head>
    <title>Course Completion Certificate</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            text-align: center;
            padding: 50px;
            border: 10px solid #333;
        }
        h1 {
            font-size: 40px;
            margin-bottom: 0;
        }
        p {
            font-size: 18px;
        }
        .highlight {
            font-size: 24px;
            font-weight: bold;
        }
        .footer {
            margin-top: 50px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <h1>Certificate of Completion</h1>
    <p>This is to certify that</p>
    <p class="highlight">{{ $user->name }}</p>
    <p>has successfully completed the course</p>
    <p class="highlight">"{{ $course->name }}"</p>
    <p>on {{ $date }}</p>

    <div class="footer">
        <p>Course Learning System</p>
    </div>
</body>
</html>
