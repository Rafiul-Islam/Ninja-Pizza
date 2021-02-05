<?php
include('config/db_connect.php');
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql_query = "DELETE FROM pizzas WHERE ID=$id_to_delete";

    if (mysqli_query($conn, $sql_query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . mysqli_error();
    }
}

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql_query = "SELECT * FROM pizzas WHERE ID=$id";
    $result = mysqli_query($conn, $sql_query);
    $pizza = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
}
?>

<!doctype html>
<html lang="en">
<?php include 'header.php' ?>
<main class="grey lighten-4" style="display: flex; justify-content: center; align-items: center">
    <div>
        <?php if ($pizza): ?>
            <div style="height: 400px; width: 300px;">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="grey-text"><?php echo htmlspecialchars($pizza['title']); ?></h5>
                        <h6 class="grey-text" style="display: flex; align-items: center; margin-top: 20px;">
                            <i class="material-icons">mail</i>&nbsp;
                            <?php echo htmlspecialchars($pizza['email']); ?>
                        </h6>
                        <h6 class="grey-text" style="display: flex; align-items: center">
                            <i class="material-icons">list</i>&nbsp;
                            <?php echo htmlspecialchars($pizza['ingredients']); ?>
                        </h6>
                        <h6 class="grey-text" style="display: flex; align-items: center">
                            <i class="material-icons">access_time</i>&nbsp;
                            <?php echo htmlspecialchars($pizza['created_at']); ?>
                        </h6>
                    </div>
                    <div class="card-action" style="display: flex; align-items: center">
                        <a href="index.php" class="brand-text">back to home</a>
                        <form action="details.php" method="POST" style="margin-left: auto">
                            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                            <a href="edit_pizza_info.php?id=<?php echo $pizza['id'] ?>">
                                <i class="material-icons blue-text" style="cursor: pointer;">edit</i>
                            </a>
                            <button type="submit" name="delete" style="border: none; background: white">
                                <i class="material-icons red-text"
                                   style="cursor: pointer;">delete</i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <h5 class="grey-text">No Such Pizza Exists!</h5>
        <?php endif; ?>
    </div>
</main>
<?php include 'footer.php' ?>
</html>
