<?php
include('config/db_connect.php');
$errors = array('email' => '', 'title' => '', 'ingredients' => '');
$email = $title = $ingredients = '';
$id_to_update = 0;
if (isset($_GET['id'])) {
    $sql_query = "SELECT * FROM pizzas WHERE ID={$_GET['id']}";
    $result = mysqli_query($conn, $sql_query);
    $pizza = mysqli_fetch_assoc($result);
    $email = $pizza['email'];
    $title = $pizza['title'];
    $ingredients = $pizza['ingredients'];
    mysqli_free_result($result);
    mysqli_close($conn);
}
if (isset($_POST['update'])) {
    $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
    if (empty(htmlspecialchars($_POST['email']))) {
        $errors['email'] = 'You must have to enter an email';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid Email';
        } else {
            //$errors['email'] = 'Valid Email';
        }
    }
    if (empty(htmlspecialchars($_POST['title']))) {
        $errors['title'] = '<br>You must have to enter an title';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = '<br>Invalid Title';
        } else {
            //$errors['title'] =  '<br>Valid Title';
        }
    }
    if (htmlspecialchars(empty($_POST['ingredients']))) {
        $errors['ingredients'] = '<br>You must have to enter an ingredient';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = '<br>Invalid Ingredients';
        } else {
            //$errors['ingredients'] =   '<br>Valid Ingredients';
        }
    }
    if (!array_filter($errors)) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);
        $sql_query = "UPDATE pizzas SET email='$email',title='$title', ingredients='$ingredients' WHERE id=$id_to_update";
        if (!mysqli_query($conn, $sql_query)) {
            echo "Error" . mysqli_error($conn);
        } else {
            header("Location: details.php?id=$id_to_update");
            echo $id_to_update . $email . $title . $ingredients;
        }
    }
}
?>
<!doctype html>
<html lang="en">
<?php include 'header.php' ?>
<main>
    <div class="container">
        <main class="container">
            <form class="center" action="edit_pizza_info.php" method="POST">
                <h4 class="grey-text">Edit Pizza Info</h4>
                <div class="input-field">
                    <i class="material-icons prefix">mail</i>
                    <input type="text" id="email-input" name="email" value="<?php echo $email ?>">
                    <label for="email-input">Email</label><br>
                    <span class="red-text">
                <?php echo $errors['email'] ?>
            </span>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">pie_chart</i>
                    <input type="text" id="title-input" name="title" value="<?php echo $title ?>">
                    <label for="title-input">Pizza Title</label>
                    <span class="red-text">
                <?php echo $errors['title'] ?>
            </span>
                </div>
                <div class="input-field">
                    <i class="material-icons prefix">menu</i>
                    <input type="text" id="ingredients-input" name="ingredients"
                           value="<?php echo $ingredients ?>">
                    <label for="ingredients-input">Ingredients</label>
                    <span class="red-text">
                <?php echo $errors['ingredients'] ?>
            </span>
                </div>
                <br>
                <input type="hidden" name="id_to_update" value="<?php echo $pizza['id'] ?>">
                <button class="btn red" type="submit" name="update">Update
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </main>
    </div>
</main>
<?php include 'footer.php' ?>
</html>