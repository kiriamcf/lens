<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <!-- ✅ Good: Has both href and target -->
    <a href="{{ $url ?? 'https://example.com' }}" target="{{ $target ?? '_blank' }}">
        Valid Anchor
    </a>

    <!-- ❌ Bad: Missing href -->
    <a target="{{ $target ?? '_blank' }}">
        Missing Href
    </a>

    <!-- ⚠️ Bad: Missing target -->
    <a href="{{ $url ?? 'https://example.com' }}">
        Missing Target
    </a>

    <!-- ❌ Bad: No attributes -->
    <a>No Attributes</a>
</body>
</html>