<?php
$fichier = '../tp 2/fichier.json';

// Lire le fichier JSON s'il existe et n'est pas vide
if (file_exists($fichier) && filesize($fichier) > 0) {
    $tabPersonnes = json_decode(file_get_contents($fichier), true);
} else {
    $tabPersonnes = [];
}

// Vérifier si le formulaire est soumis
if (isset($_POST['enreg'])) {
  $prenom = $_POST['prenom'] ?? '';
  $nom    = $_POST['nom'] ?? '';
  $adr    = $_POST['adr'] ?? '';
  $tel    = $_POST['tel'] ?? '';

if ($prenom && $nom && $adr && $tel) {
  // Ajouter la nouvelle personne
  $tabPersonnes[] = [
      'prenom' => $prenom,
      'nom'    => $nom,
      'adr'    => $adr,
      'tel'    => $tel
  ];

  // Sauvegarder dans le JSON
  file_put_contents($fichier, json_encode($tabPersonnes, JSON_PRETTY_PRINT));
}
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TP2 Form & Table</title>
    <link rel="stylesheet" href="../bootstrap.css">
    <style>
        #container {
            background-color: yellow;
        }

        .card-body input {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
  <h1 class="text-center text-primary">TP Form & Table</h1>
  <div class="container" id="container">
  <div class="row">
    <div class="col-md-4">
    <div class="card">
        <form method="post" style="background-color: green;">
    <div class="card-header">Ajout Personne</div>
    <div class="card-body">
        <label for="prenom">Prénom</label>
        <input class="form-control" type="text" name="prenom" id="prenom" required>

        <label for="nom">Nom</label>
        <input class="form-control" type="text" name="nom" id="nom" required>

        <label for="adr">Adresse</label>
        <input class="form-control" type="text" name="adr" id="adr" required>

        <label for="tel">Téléphone</label>
        <input class="form-control" type="text" name="tel" id="tel" required>

        <div class="mt-2">
            <button class="btn btn-primary" name="enreg">Enregistrer</button>
        </div>
            </div>
        </form>
    </div>
</div>
<div class="col-md-8">
 <div class="card" style="background-color: green;">
    <div class="card-header">Liste des personnes</div>
    <div class="card-body">
        <table class="table table-bordered">
    <tr>
      <th>#</th>
      <th>Prénom</th>
      <th>Nom</th>
      <th>Adresse</th>
      <th>Téléphone</th>
      </tr>
          <?php foreach ($tabPersonnes as $index => $personne) : ?>
          <tr>
              <td><?= $index + 1 ?></td>
              <td><?= htmlspecialchars($personne['prenom']) ?></td>
              <td><?= htmlspecialchars($personne['nom']) ?></td>
              <td><?= htmlspecialchars($personne['adr']) ?></td>
              <td><?= htmlspecialchars($personne['tel']) ?></td>
          </tr>
          <?php endforeach; ?>
            </table>
        </div>
    </div>
      </div>

  </div>
    </div>
</body>

</html>
