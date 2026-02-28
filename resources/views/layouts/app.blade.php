<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLUSS-CI - Plateforme Une Seule Santé</title>
    
    {{-- Scripts & Styles --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            orange: '#F97316',
                            green: '#16A34A',
                            dark: '#1F2937',
                        }
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">
    
    <div class="max-w-[1440px] mx-auto bg-white shadow-2xl min-h-screen flex flex-col relative">

        {{-- 1. Inclusion du Header --}}
        @include('partials.header')

        {{-- 2. Contenu principal (C'est ici que s'afficheront vos pages GTT) --}}
        <main class="flex-grow">
            {{-- Important : On utilise yield ici pour être compatible avec @extends --}}
            @yield('content')
        </main>

        {{-- 3. Inclusion du Footer --}}
        @include('partials.footer')

    </div>

</body>
</html>