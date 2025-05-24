<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- ✅ Good: Specifies action, method and enctype -->
    <form action="{{ $action ?? '#' }}" 
        method="{{ $method ?? 'POST' }}" 
        enctype={{ $enctype ?? 'application/x-www-form-urlencoded' }}>
        ...
    </form>

    <!-- ❌ Bad: Missing action -->
    <form method="{{ $method ?? 'POST' }}" 
        enctype="{{ $enctype ?? 'application/x-www-form-urlencoded' }}">
        ...
    </form>

    <!-- ⚠️ Bad: Missing method -->
    <form action="{{ $action ?? '#' }}" 
        enctype="{{ $enctype ?? 'application/x-www-form-urlencoded' }}">
        ...
    </form>

    <!-- ⚠️ Bad: Missing enctype -->
    <form action="{{ $action ?? '#' }}" 
        method="{{ $method ?? 'POST' }}">
        ...
    </form>

    <!-- ❌ Bad: No attributes -->
    <form></form>
</body>
</html>