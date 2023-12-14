
<?php
session_start();
include 'connection.php';
include 'header.php';
?>

<div class="card-container">
    <?php
    $sql = "SELECT pro_id, pro_name, pro_price, pro_img FROM products WHERE   pro_id=3 or pro_id=9 or pro_id=13 or pro_id=17 or pro_id=18";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
           
            echo '<div class="card searchcard">
                    <form method="post" action="">
                        <input type="hidden" name="p_id" value="' . $row["pro_id"] . '" />                       
                        <a href="product.php?' . $row["pro_id"] . '">
                            <img src="' . $row["pro_img"] . '" alt="Denim Jeans">
                            <h3>' . $row["pro_name"] . '</h3>
                            <p class="price">' . $row["pro_price"] . ' MAD</p>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-sta checkedr"></span>
                            <span class="fa fa-star checked"></span>
                        </a>
                        
                    </form>
                  </div>';
        }
    }
    ?>
</div>

<style>
    .card-container {
        display: flex;
        flex-wrap: nowrap; /* Permet de ne pas passer à la ligne en fonction de la largeur */
        overflow: auto; /* Ajout d'une barre de défilement horizontale si nécessaire */
    }

    .card {
        margin-right: 10px; /* Marge entre chaque carte */
    }
</style>

<?php
include 'footer.php';
?>
