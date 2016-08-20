<?php session_start(); ?>

<?php if(!isset($_SESSION['userid'])): ?>
<form method="post">
    <input name="username"/>   
    <input name="password"/>
    <input type="submit"/>
</form>
<?php endif; ?>

<?php
//ini_set('display_errors', 1);

$link = mysqli_connect("localhost", "root", "", "uniwars");
mysqli_select_db($link, "uniwars");

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT id FROM players WHERE username = '$username' AND password = '$password'";

    // echo $query;

    $result = mysqli_query($link, $query);
    // var_dump($result);
    $user = mysqli_fetch_assoc($result);

    // var_dump($user);

    if (empty($user)) {
        echo 'Invalid dtails.';
    } else {
        $_SESSION['userid'] = $user['id'];
    }
}

if (isset($_SESSION['userid'])) {
    $id = $_SESSION['userid'];
    $query = "SELECT id, username, password FROM players WHERE id = $id";
    $result = mysqli_query($link, $query);
    $user = mysqli_fetch_assoc($result);
    echo "<h1> Welcome " . $user['username'] . "</h1>";
    echo "<a href='?logout=true'>logout</a>";
}

if ($_GET['logout']) {
    session_destroy();
    header("Location: /UniWars/");
    exit;
}