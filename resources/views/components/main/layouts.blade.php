<!DOCTYPE html>
<html lang="en">
<head>
    <x-head :title="$title ?? null" />
</head>
<body>
    {{ $slot }}
    @livewireScripts
</body>

</html>
