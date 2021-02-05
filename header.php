<?php
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    <script>
        $(document).ready(function () {
            $(".button-collapse").sideNav();
        });
    </script>
    <title>Ninja Pizza</title>
    <style>
        .brand-logo {
            margin-left: 10px;
        }

        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        .side-nav li {
            text-align: center;
        }

        .pizza-img {
            margin-top: -30px;
            position: relative;
            top: -30px
        }
    </style>
</head>
<body>
<div class="navbar-fixed">
    <nav>
        <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">
                <i class="material-icons">dashboard</i>
                Ninja Pizza
            </a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down" style="margin-right: 10px;">
                <li>
                    <a href="add_a_pizza.php">
                        <button class="btn waves-effect red" type="submit" name="add">
                            Add Pizza
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div>
<ul class="side-nav" id="mobile-demo" style="padding: 10px">
    <li class="left">
        <a href="add_a_pizza.php">
            <button class="btn waves-effect red" type="submit" name="add">
                Add Pizza
            </button>
        </a>
    </li>
</ul>
