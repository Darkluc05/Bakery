<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f21cc9e720.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <script src="./js/main.js" defer></script>
    <title></title>
</head>

<body>
    <header class="header">
        <h1 class="header__title">
            Bakkerij van Luc
        </h1>
    </header>
    <main class="recipe">
    <?php
        @include_once('../system/database.php');
        
        $slug = mysqli_real_escape_string($conn, isset($_GET['slug']) ? $_GET['slug'] : '');

        $query = "
        SELECT products.title, products.description, products.image_url, 
        GROUP_CONCAT(ingredients.ingredient_name) AS `ingredients`
        FROM `products`
        LEFT JOIN `ingredient_product` ON `ingredient_product`.`product_id` = `products`.`id`
        LEFT JOIN `ingredients` ON `ingredients`.`id` = `ingredient_product`.`ingredient_id` 
        WHERE products.title = '".$slug."'
        GROUP BY products.id;";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $title = $row["title"];
                $img = $row["image_url"];
                $ingredients = $row["ingredients"];
                $desc = $row["description"];
                echo "<section class='recipe__left'>";
                echo "<h1 class='recipe__title'>".$title."</h1>";
                echo "<img class='recipe__image' src='.$img'/>";
                echo "</section>";
                echo "<section>";
                echo "<h2 class='recipe__header'>"."Recipe"."</h2>";
                echo "<p>".$desc."</p>";
                echo "<p>". $ingredients ."</p>";
                echo "</section>";
            }
        } else {
            echo "0 results";
        }

        ?>

    </main>
</body>

</html>