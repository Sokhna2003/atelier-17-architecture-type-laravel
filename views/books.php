<?php
$livres = $livres ?? [];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Les livres — Bibliothèque</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800 min-h-screen">
    <header class="bg-indigo-700 text-white">
        <div class="max-w-4xl mx-auto px-6 py-10">
            <h1 class="text-3xl font-bold">Les livres</h1>
            <p class="mt-2 text-indigo-100">Données fournies par le BookRepository (PDO).</p>
            <a href="<?= $base ?>" class="inline-block mt-4 bg-white/10 px-3 py-1.5 rounded-lg hover:bg-white/20 text-sm">← Retour à l'accueil</a>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-10">
        <?php if (empty($livres)): ?>
            <div class="bg-amber-50 border border-amber-200 text-amber-700 rounded-xl p-4">
                Aucun livre — importez le schéma de l'atelier 13 puis lancez <code>seed.php</code>.
            </div>
        <?php else: ?>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($livres as $livre): ?>
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                        <h2 class="font-semibold text-lg text-slate-800"><?= htmlspecialchars($livre['titre']) ?></h2>
                        <p class="text-sm text-slate-500"><?= htmlspecialchars($livre['auteur']) ?></p>
                        <div class="mt-3 text-sm text-slate-600 space-y-1">
                            <p>ISBN : <?= htmlspecialchars($livre['isbn'] ?? '—') ?></p>
                            <p>Catégorie : <span class="bg-slate-100 px-2 py-0.5 rounded"><?= htmlspecialchars($livre['categorie'] ?? '—') ?></span></p>
                        </div>
                        <span class="inline-block mt-3 px-2.5 py-1 rounded-full text-xs font-semibold <?= $livre['quantite'] > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                            <?= $livre['quantite'] > 0 ? $livre['quantite'] . ' en stock' : 'Rupture' ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
