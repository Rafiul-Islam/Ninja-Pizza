<?php
include('config/db_connect.php');

$errors = array('email' => '', 'title' => '', 'ingredients' => '');
$email = $title = $ingredients = '';

if (isset($_POST['submit'])) {
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
        $sql_query = "INSERT INTO pizzas(email,title, ingredients) VALUES('$email', '$title', '$ingredients')";
        if (!mysqli_query($conn, $sql_query)){
            echo "Error".mysqli_error($conn);
        }
        else{
//            $email = $title = $ingredients = '';
            header("Location: index.php");
        }
    }
}
?>
<!doctype html>
<html lang="en">
<?php include 'header.php' ?>
<main class="container">
    <form class="center" action="add_a_pizza.php" method="POST">
        <h4 class="grey-text">Add a pizza</h4>
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
            <input type="text" id="ingredients-input" name="ingredients" value="<?php echo $ingredients ?>">
            <label for="ingredients-input">Ingredients</label>
            <span class="red-text">
                <?php echo $errors['ingredients'] ?>
            </span>
        </div>
        <br>
        <button class="btn red" type="submit" name="submit">Submit
            <i class="material-icons right">send</i>
        </button>
    </form>
</main>
<?php include 'footer.php' ?>
</html>