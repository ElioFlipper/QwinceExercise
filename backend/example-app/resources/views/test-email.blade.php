<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Email</title>
</head>
<body>
    <h1>Utente registrato con successo!</h1>
    <h2>Ecco il riepilogo dei tuoi dati:</h2>
    <h3>Username:</h3><p>{{request('username')}}</p>
    <h3>Name:</h3><p>{{request('name')}}</p>
    <h3>Surname:</h3><p>{{request('surname')}}</p>
    <h3>Email:</h3><p>{{request('email')}}</p>
    <h3>City:</h3><p>{{request('city')}}</p>
    <h3>Activation Status:</h3><p>{{request('activationStatus')}}</p>
</body>
</html> -->


<!DOCTYPE html>
<html>
<head>
    <title>Benvenuto!</title>
</head>
<body>
<h1>Ciao, {{ $name }}!</h1>
<p>Ti diamo il benvenuto sul nostro sito!</p>
<p>Dettagli dell'account:</p>
<ul>
    <li>Username: {{ $username }}</li>
    <li>Nome: {{ $name }}</li>
    <li>Email: {{ $email }}</li>
    <li>Città: {{ $city }}</li>
    <li>Stato attivazione: 
        @if ($activationStatus === 1)
            Attivo
        @else
            Disattivo
        @endif
    </li>
</ul>
<p>Grazie per esserti registrato!</p>

</body>
</html>
