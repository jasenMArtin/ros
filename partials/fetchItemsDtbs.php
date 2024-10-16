<?php
    $sql = "SELECT * FROM tbl_items WHERE item_active = 1"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="<?php echo $row['item_image']; ?>" alt="<?php echo $row['item_title']; ?>" class="img-responsive img-curve">
                </div>
                <div class="food-menu-desc">
                    <h6><?php echo $row['item_title']; ?></h6>
                    <p class="food-price">$<?php echo $row['price']; ?></p>
                    <p class="food-detail"><?php echo $row['description']; ?></p>
                    <a href="#" class="btn btn-primary add-to-cart-btn" 
                        data-title="<?php echo $row['item_title']; ?>" 
                        data-price="<?php echo $row['price']; ?>" 
                        data-description="<?php echo $row['description']; ?>" 
                        data-image="<?php echo $row['item_image']; ?>" 
                        data-id="<?php echo $row['item_id']; ?>">Add to Cart</a>

                </div>
            </div>
            <?php
        }
    } else {
        echo "<div class='error'>Food not found.</div>";
    }

    $conn->close();
?>