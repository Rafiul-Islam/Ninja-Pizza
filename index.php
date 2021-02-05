<?php
include ('config/db_connect.php');
$sql_query = 'SELECT id, title, ingredients FROM  pizzas ORDER BY created_at';
$result = mysqli_query($conn, $sql_query);
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);
mysqli_close($conn);
//print_r($pizzas)
?>

<!doctype html>
<html lang="en">
<?php include 'header.php' ?>
<main class="grey lighten-4">
    <div class="container">
        <h4 class="center grey-text">Pizzas!</h4>
        <h6 class="center grey-text">
            <?php echo count($pizzas). " pizza available here";?>
        </h6>
        <div class="container">
            <div class="row">
                <?php foreach ($pizzas as $pizza) : ?>
                    <div class="col s6 md3" style="margin-top: 30px">
                        <div class="card z-depth-0">
                            <div class="card-content center">
                                <img class="pizza-img" src="img/pizza.svg">
                                <h5 class="grey-text"><?php echo htmlspecialchars($pizza['title']); ?></h5>
                                <h6 class="grey-text">
                                    <ul class="collection">
                                        <li class="collection-header"><h6>Ingredients</h6></li>
                                        <?php
                                        $ingredients = explode(",", $pizza['ingredients']);
                                        foreach ($ingredients as $ingredient) : ?>
                                            <li class="collection-item left-align"><?php echo htmlspecialchars($ingredient) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </h6>
                            </div>
                            <div class="card-action right-align">
                                <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">More Info</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</main>
<?php include 'footer.php' ?>
</html>