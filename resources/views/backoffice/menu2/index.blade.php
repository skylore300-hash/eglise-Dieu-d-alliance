<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="src/css/output.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="min-h-screen bg-gradient-to-l from-gray-200 to-indigo-100 text-[#0033A0] flex">
    <div class="w-full">
        <aside class="bg-[#0033A0] w-full h-16 flex items-center justify-between px-4 rounded-b-[20px]">
            <div class="w-16 h-10 rounded-md bg-gray-100 text-[#0033A0] flex items-center justify-center font-bold text-lg">
                <img src="src/images/logo.png" alt="" class="max-w-full max-h-full object-contain">
            </div>
            <nav class="flex items-center gap-3"></nav>
        </aside>

        <main class="flex-1 p-9">
            <header class="text-center mb-8">
                <h1 class="text-2xl md:text-3xl font-semibold">Bienvenue au panel administratif</h1>
            </header>

            <section class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
                <a class="block bg-white rounded-lg min-h-[120px] overflow-hidden transition transform hover:-translate-y-1.5 hover:shadow-lg p-6 text-inherit no-underline" href="#">
                    <div class="flex justify-center">
                        <img src="src/images/membre2.png" alt="" class="max-w-[45%] object-contain">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium">Membres</h3>
                    </div>
                </a>

                <a class="block bg-white rounded-lg min-h-[120px] overflow-hidden transition transform hover:-translate-y-1.5 hover:shadow-lg p-6 text-inherit no-underline" href="#">
                    <div class="flex justify-center">
                        <img src="src/images/finances.png" alt="" class="max-w-[45%] object-contain">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium">Finances</h3>
                    </div>
                </a>

                <a class="block bg-white rounded-lg min-h-[120px] overflow-hidden transition transform hover:-translate-y-1.5 hover:shadow-lg p-6 text-inherit no-underline" href="#">
                    <div class="flex justify-center">
                        <img src="src/images/eglise2.png" alt="" class="max-w-[45%] object-contain">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium">Cultes et activités / Enseignement</h3>
                    </div>
                </a>

                <a class="block bg-white rounded-lg min-h-[120px] overflow-hidden transition transform hover:-translate-y-1.5 hover:shadow-lg p-6 text-inherit no-underline" href="#">
                    <div class="flex justify-center">
                        <img src="src/images/culte.png" alt="" class="max-w-[45%] object-contain">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium">Rendez-vous de prière</h3>
                    </div>
                </a>

                <a class="block bg-white rounded-lg min-h-[120px] overflow-hidden transition transform hover:-translate-y-1.5 hover:shadow-lg p-6 text-inherit no-underline" href="#">
                    <div class="flex justify-center">
                        <img src="src/images/media.png" alt="" class="max-w-[45%] object-contain">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium">Média</h3>
                    </div>
                </a>

                <a class="block bg-white rounded-lg min-h-[120px] overflow-hidden transition transform hover:-translate-y-1.5 hover:shadow-lg p-6 text-inherit no-underline" href="#">
                    <div class="flex justify-center">
                        <img src="src/images/parametre.png" alt="" class="max-w-[45%] object-contain">
                    </div>
                    <div class="mt-4 text-center">
                        <h3 class="text-lg font-medium">Paramètres</h3>
                    </div>
                </a>
            </section>
        </main>
    </div>
</body>

</html>