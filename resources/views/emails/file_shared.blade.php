<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File shared</title>
</head>
<body>
    <h1>New file is shared with you</h1>
    <p>Hello {{$user->name}},</p>
    <p>A new file is shared with you: {{ $file->name }}</p>
    <p>You can download it from the following link:</p>
    <p>
        {{-- <a href="{{ $file->token }}">Download the file</a> --}}
        <a href="{{ url('/download/' . $file->token) }}">Download the file</a>

    </p>

    <p>The download link automatically expires after {{ $file->expires_at->format('F j, Y g:i A') }}
</p>
    
    <p>Thank you!</p>
    <p>{{ config('app.name') }} </p>
</body>
</html>