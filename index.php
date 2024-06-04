<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

$username = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ans = $_POST;

    if (empty($ans["username"])) {
        echo "Korisnički račun nije unesen.";
    } else if (empty($ans["password"])) {
        echo "Lozinka nije unesena.";
    } else {
        $username = $ans["username"];
        $password = $ans["password"];
        provjera($username, $password);
    }
}

function provjera($username, $password) {
    $xml = simplexml_load_file("users.xml");

    foreach ($xml->user as $usr) {
        $usrn = (string) $usr->username;
        $usrp = (string) $usr->password;
        $usrime = (string) $usr->ime;
        $usrprezime = (string) $usr->prezime;
        if ($usrn == $username) {
            if ($usrp == $password) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['ime'] = $usrime;
                $_SESSION['prezime'] = $usrprezime;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Netočna lozinka";
                return;
            }
        }
    }

    echo "Korisnik ne postoji.";
    return;
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <h2>Prijava</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Korisnički račun:</label>
            <input id="username" name="username" type="text" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Lozinka:</label>
            <input id="password" name="password" type="password" class="form-control" placeholder="**********">
        </div>
        <button type="submit" class="btn btn-primary">Prijava</button>
    </form>
    <div class="mt-3">
        <h5>Mogući korisnici i lozinke:</h5>
        <p>sjakirovic / dinamo</p>
        <p>zsopic / rijeka</p>
    </div>
</body>
</html>

