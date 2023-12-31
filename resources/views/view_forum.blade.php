<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Forum</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @livewireStyles
</head>

<body class="antialiased">
    <a href="{{ url('posted_forums') }}">Go back</a>
    @livewire('view-forum', ['forum_selected' => $forum_selected]) <!-- Include the Livewire component -->
    @livewireScripts
</body>

</html>
