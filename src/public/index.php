<?php
include_once 'dbController.php';
$database = new dbController();
$database->connect();
$database->createTable();
?>

<form action="index.php" method="post">
    <label for="titles">Titles</label>
    <input type="text" name="titles" id="titles">
    <label for="name">Name</label>
    <input type="text" name="name" id="name">
    <label for="description">Description</label>
    <input type="text" name="description" id="description">
    <label for="email">Email</label>
    <input type="text" name="email" id="email">
    <input type="submit" name="submit" value="Submit">
</form>

<?php
if (isset($_POST['submit'])) {
    $database->addAdvert($_POST['titles'], $_POST['name'], $_POST['description'], $_POST['email']);
}
?>

<table>
    <tr>
        <th>Titles</th>
        <th>Name</th>
        <th>Description</th>
        <th>Email</th>
    </tr>
    <?php
    $result = $database->getAdverts();
    while ($row = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['titles']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['email']; ?></td>
        </tr>
        <?php
    }
    ?>
</table>