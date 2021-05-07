<head>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        img {
            height: 10cm;
        }
    </style>
</head>
<body>
<h1>Historic of your modifications</h1>
@foreach($entries as $entry)
    <img src="{{ $entry->absolute_path }}" alt="An historic entry"/>
@endforeach
</body>
