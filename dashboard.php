<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$ime = $_SESSION['ime'];
$prezime = $_SESSION['prezime'];
$username = $_SESSION['username'];

$teams = [
    ['GNK Dinamo Zagreb', 82, 'dinamo.png'],
    ['HNK Rijeka', 74, 'rijeka.png'],
    ['HNK Hajduk Split', 68, 'hajduk.png'],
    ['NK Osijek', 57, 'osijek.png'],
    ['NK Lokomotiva', 51, 'lokomotiva.png'],
    ['NK Varaždin', 42, 'varazdin.png'],
    ['HNK Gorica', 41, 'gorica.png'],
    ['NK Istra', 41, 'istra.png'],
    ['NK Slaven Belupo', 33, 'slavenbelupo.png'],
    ['NK Rudeš', 9, 'rudes.png']
];

function getGreetingMessage($ime, $prezime) {
    return "Pozdrav $ime $prezime";
}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .bold-dinamo {
            font-weight: bold;
        }
        .bold-rijeka {
            font-weight: bold;
        }
    </style>
</head>
<body class="container mt-5">
    <h2><?php echo getGreetingMessage($ime, $prezime); ?></h2>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Grb</th>
                <th>Klub</th>
                <th>Points</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teams as $index => $team): ?>
                <tr class="<?php echo ($username == 'sjakirovic' && $team[0] == 'GNK Dinamo Zagreb') ? 'bold-dinamo' : ''; ?>
                           <?php echo ($username == 'zsopic' && $team[0] == 'HNK Rijeka') ? 'bold-rijeka' : ''; ?>">
                    <td><?php echo $index + 1; ?></td>
                    <td><img src="images/<?php echo $team[2]; ?>" alt="<?php echo $team[0]; ?>" width="30"></td>
                    <td><?php echo $team[0]; ?></td>
                    <td><?php echo $team[1]; ?> pts</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="logout.php" class="btn btn-danger mt-3">Odjava</a>
</body>
</html>

