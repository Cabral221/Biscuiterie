<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Biscuiterie</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito';
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="wrapper">
        {{-- <header class="page-header">
            <!-- content here -->
        </header> --}}
        <main class="page-main">
            <div>
                <h1>Bienvenue à l'Ecole Biscuiterie A</h1>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim quia officiis repellat aperiam nobis quis reprehenderit aliquid nemo, autem id suscipit vel quos. Illum accusantium asperiores unde. Harum, ex minus!</p>
                <p class="call-to-action">
                    <a href="{{ route('admin.index') }}" class="btn btn-primary">Espace Administration</a>
                    <a href="{{ route('enseignant.index') }}" class="btn btn-secondary">Espace Enseignant</a>
                </p>
            </div>
        </main>
        <footer class="page-footer">
            &copy; Copyright <span>Ecole Biscuiterie</span> {{ Carbon\Carbon::now()->year }} - Tous droits réservés - Made By <span>EMPRO</span>
        </footer>
    </div>
</body>
</html>
