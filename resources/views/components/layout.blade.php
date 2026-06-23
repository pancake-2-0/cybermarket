<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cyber Market</title>
    <link rel="icon" href="./media/logo1.png">
    @env('testing')
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endenv
</head>


<body>


    <x-navbar />

    <x-header />

    <div class="min-vh-100">
        {{ $slot }}
    </div>


    <x-footer />


</body>

</html>
