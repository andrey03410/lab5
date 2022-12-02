<?php
if (!file_exists('./data')) {
    mkdir('./data');
}
?>
<h1>Добавить название категории</h1>
<form action="index.php" method="post">
    <input type="text" name="category" placeholder="Название категории">
    <input type="submit" value="Добавить">
</form>
<?php
if (!empty($_POST['category'])) {
    $category = $_POST['category'];
    $path = "./data/" . $category;
    if (!file_exists($path)) {
        mkdir($path);
    }
}

?>
<h1>Добавить объявление</h1>
<form action="index.php" method="post">
    <input type="text" name="title" placeholder="Заголовок объявления">
    <textarea name="text" cols="30" rows="10" placeholder="Текст объявления"></textarea>
    <input type="text" name="email" placeholder="Email">
    <select name="category">
        <?php
        $dir = "./data/";
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                echo "<option value='$file'>$file</option>";
            }
        }
        ?>
    </select>
    <input type="submit" value="Добавить">
</form>
<?php

if (!empty($_POST['category']) && !empty($_POST['title']) && !empty($_POST['text']) && !empty($_POST['email'])) {
    $category = $_POST['category'];
    $title = $_POST['title'];
    $text = $_POST['text'];
    $email = $_POST['email'];
    $path = "./data/" . $category . "/" . $title . ".txt";
    if (!file_exists($path)) {
        $file = fopen($path, "w");
        fwrite($file, $text . "\n" . $email);
        fclose($file);
    }
}
?>
<h1>Список объявлений</h1>

<table>
    <tr>
        <th>title</th>
        <th>description</th>
        <th>category</th>
    </tr>
    <?php
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            $path = "./data/" . $file;
            $files2 = scandir($path);
            foreach ($files2 as $file2) {
                if ($file2 != "." && $file2 != "..") {
                    $path2 = "./data/" . $file . "/" . $file2;
                    $file3 = fopen($path2, "r");
                    $text = fgets($file3);
                    $email = fgets($file3);
                    fclose($file3);
                    echo "<tr>";
                    echo "<td>" . substr($file2, 0, -4) . "</td>";
                    echo "<td>" . $text . "</td>";
                    echo "<td>" . $file . "</td>";
                    echo "</tr>";
                }
            }
        }
    }
    ?>
</table>