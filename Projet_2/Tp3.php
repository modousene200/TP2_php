<?php
$file = 'taches.json';

/* Lire les tâches */
$taches = json_decode(file_get_contents($file), true);
if (!$taches) {
    $taches = [];
}

/* ID de la tâche à modifier */
$tache_edit = null;
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    foreach ($taches as $t) {
        if ($t['id'] == $edit_id) {
            $tache_edit = $t;
            break;
        }
    }
}

/* Ajouter une tâche */
if (isset($_POST['add'])) {
    $taches[] = [
        'id' => time(),
        'titre' => $_POST['titre'],
        'description' => $_POST['description'],
        'statut' => $_POST['statut']
    ];
    file_put_contents($file, json_encode($taches, JSON_PRETTY_PRINT));
    header("Location: Tp3.php");
}

/* Modifier une tâche */
if (isset($_POST['update'])) {
    foreach ($taches as &$t) {
        if ($t['id'] == $_POST['id']) {
            $t['titre'] = $_POST['titre'];
            $t['description'] = $_POST['description'];
            $t['statut'] = $_POST['statut'];
            break;
        }
    }
    file_put_contents($file, json_encode($taches, JSON_PRETTY_PRINT));
    header("Location: Tp3.php");
}

/* Supprimer une tâche */
if (isset($_POST['delete'])) {
    $taches = array_filter($taches, fn($t) => $t['id'] != $_POST['id']);
    file_put_contents($file, json_encode(array_values($taches), JSON_PRETTY_PRINT));
    header("Location: Tp3.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Tâches</title>
    <link rel="stylesheet" href="../style css/bootstrap.css"></head>
<
<body class="container py-4">

<h2 class="text-center mb-4">Gestion des Tâches</h2>

<!-- ===== FORMULAIRE AJOUTER/MODIFIER ===== -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <?php if ($tache_edit): ?>
            Modifier la tâche
        <?php else: ?>
            Ajouter une tâche
        <?php endif; ?>
    </div>

    <div class="card-body">
        <form method="<?php echo $tache_edit ? 'POST' : 'POST'; ?>">
            <?php if ($tache_edit): ?>
                <input type="hidden" name="id" value="<?= $tache_edit['id'] ?>">
            <?php endif; ?>

            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="titre" class="form-control" value="<?= htmlspecialchars($tache_edit['titre'] ?? '') ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($tache_edit['description'] ?? '') ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Statut</label>
                <select name="statut" class="form-control">
                    <option value="En cours" <?php echo ($tache_edit && $tache_edit['statut'] == 'En cours') ? 'selected' : ''; ?>>En cours</option>
                    <option value="Terminée" <?php echo ($tache_edit && $tache_edit['statut'] == 'Terminée') ? 'selected' : ''; ?>>Terminée</option>
                </select>
            </div>

            <div>
                <?php if ($tache_edit): ?>
                    <button name="update" class="btn btn-warning btn-sm px-3">Enregistrer</button>
                    <a href="Tp3.php" class="btn btn-secondary btn-sm px-3">Annuler</a>
                <?php else: ?>
                    <button name="add" class="btn btn-success btn-sm px-3">Ajouter la tâche</button>
                <?php endif; ?>
            </div>

        </form>
    </div>
</div>

<!-- ===== LISTE DES TÂCHES ===== -->
<h4 class="mb-3">Liste des tâches</h4>

<div class="row">
<?php foreach ($taches as $tache): ?>
    <div class="col-md-4">
        <div class="card p-3 mb-3">

            <h5><?= htmlspecialchars($tache['titre']) ?></h5>
            <p><?= htmlspecialchars($tache['description']) ?></p>

            <div class="text-start mb-2">
                <?php if ($tache['statut'] == 'Terminée'): ?>
                    <span class="badge bg-success" style="font-size:0.75rem;padding:0.25rem 0.5rem;">Terminée</span>
                <?php else: ?>
                    <span class="badge bg-warning text-dark" style="font-size:0.75rem;padding:0.25rem 0.5rem;">En cours</span>
                <?php endif; ?>
            </div>

            <hr>

            <div class="d-inline-flex" role="group" style="gap:0.5rem;">
                <a href="Tp3.php?edit=<?= $tache['id'] ?>" class="btn btn-primary btn-sm">Modifier</a>

                <form method="POST" class="m-0">
                    <input type="hidden" name="id" value="<?= $tache['id'] ?>">
                    <button name="delete" class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </div>

        </div>
    </div>
<?php endforeach; ?>
</div>

</body>
</html>
