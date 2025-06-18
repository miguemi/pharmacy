<!DOCTYPE html>
<html lang="en" translate="no">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="true" name="HandheldFriendly" />
    <title>Finanssoreal S.A</title>
    {{-- pwa start --}}
    <link href="/favicon.ico" rel="icon" sizes="64x64">
    <link href="/favicon.svg" rel="icon" sizes="any" type="image/svg+xml">
    <link href="/apple-touch-icon-180x180.png" rel="apple-touch-icon" sizes="180x180">
    <link href="/build/manifest.webmanifest" rel="manifest">
    <script src="/build/registerSW.js"></script>
    {{-- pwa end  --}}
    @routes
    @viteReactRefresh
    @vite(['resources/js/app.jsx', 'resources/css/app.css'])
    @inertiaHead
</head>
<body>
    <noscript>
        <strong>
            We're sorry but this application doesn't work properly without JavaScript enabled. Please enable it to
            continue.
        </strong>
    </noscript>
    @inertia
</body>
</html>
