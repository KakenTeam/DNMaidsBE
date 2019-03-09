<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src={{asset("js/app.js")}}></script>
</head>

<body>
<div id="app">
    <passport-clients></passport-clients>
</div>

</body>
