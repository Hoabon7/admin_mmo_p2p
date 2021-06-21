<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>{{ $nameTitle }}</h3>
    <h4>{{ $nameHeader }}</h4>

    <div class="content">
        @if (gettype($content) == 'array' || gettype($content) == 'object')
            @foreach ($content as $item)
                <h4>{{ $item }}</h4>
            @endforeach
        @else
            <h4>{{ $content }}</h4>
        @endif
    </div>
    
    <h4>{{ $extraContent }}</h4>
    <h4>{{ $nameFooter }}</h4>


</body>

</html>
