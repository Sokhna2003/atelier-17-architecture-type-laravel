<?php
$message = $message ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>À propos — Bibliothèque</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen">
    <header class="bg-indigo-700 text-white">
        <div class="max-w-4xl mx-auto px-6 py-10">
            <h1 class="text-3xl font-bold">À propos</h1>
            <a href="<?= $base ?>" class="inline-block mt-4 bg-white/10 px-3 py-1.5 rounded-lg hover:bg-white/20 text-sm">← Retour à l'accueil</a>
        </div>
    </header>
    <main class="max-w-4xl mx-auto px-6 py-10">
        <div class="bg-white rounded-2xl shadow p-8">
            <p class="text-slate-600"><?= htmlspecialchars($message) ?></p>
        </div>
    </main>
</body>
</html>