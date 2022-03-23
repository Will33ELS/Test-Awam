<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title>AWAM - Test technique</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
<main>
    <div class="row">
        <form class="col-12 col-lg-6 m-5" method="POST" action="{{ route("home") }}">
            @csrf
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="amount1" placeholder="Montant" required>
                <select name="devise1" class="form-select" id="devise1" required>
                    <option selected disabled>Devise</option>
                    <option value="euro">Euro</option>
                    <option value="dollars">Dollars</option>
                </select>
                <span class="mx-3">+</span>
                <input type="number" class="form-control" name="amount2" placeholder="Montant" required>
                <select name="devise2" class="form-select" id="devise2" required>
                    <option selected disabled>Devise</option>
                    <option value="euro">Euro</option>
                    <option value="dollars">Dollars</option>
                </select>
                <button type="submit" class="btn btn-success mx-3">Calculer</button>
            </div>
        </form>
    </div>
    @if(isset($outcome))
        <div class="row">
            <h1>Résultat de votre calcul</h1>
            <p>{{ $statement }} = {{ $outcome }}</p>
        </div>
    @endif
</main>
</body>
</html>
