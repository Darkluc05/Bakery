<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f21cc9e720.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <script src="./js/main.js" defer></script>
    <title></title>
</head>

<body>
    <header class="header">
        <h1 class="header__title">
            Bakkerij van Luc
        </h1>
    </header>
    <main>

        <?php
        @include_once('./system/database.php');

        $query = "
        SELECT products.title, products.description, products.image_url, 
        GROUP_CONCAT(ingredients.ingredient_name) AS `ingredients`
        FROM `products`
        LEFT JOIN `ingredient_product` ON `ingredient_product`.`product_id` = `products`.`id`
        LEFT JOIN `ingredients` ON `ingredients`.`id` = `ingredient_product`.`ingredient_id` 
        GROUP BY products.id;";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<a class='recipe__link' href='products/product.php?slug=".$row["title"]."'>";
                echo "<article class='article'>";
                echo "<h3 class='article__title'>";
                echo $row["title"];
                echo "</h3>";
                $img = $row["image_url"];
                echo "<img class='article__image' src='$img'/>";
                echo "</article>";
                echo "</a>";

            }
        } else {
            echo "0 results";
        }

        $conn->close();

        ?>

    </main>
</body>

</html>