<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pyramakerz</title>
    @include("layouts.header")
    @yield("page_css")
</head>
<body>
    @yield("content")
    @include("layouts.footer")
    @include("layouts.scripts")
    @yield("page_js")

</body>
</html>
