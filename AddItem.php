        <?php
            $page_title = "Adventure! - Add/Update Item";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(isset($_POST['create']))
                {
                    if(!($stmt = $mysqli->prepare("INSERT INTO `item`(`name`, `value`, `country_id`) 
														VALUES (?, ?, ?);"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("sii",$_POST['name'],$_POST['value'],$_POST['country']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Added " . $stmt->affected_rows . " rows to Item.";
                    }
                    $stmt->close();
                }      
                else
                {
                    if(!($stmt = $mysqli->prepare("UPDATE `item`
														SET `item`.`name` = ?,
															`item`.`value` = ?,
															`item`.`country_id` = ?
														WHERE `item`.`id` = ?;
														"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("siii",$_POST['name'],$_POST['value'],$_POST['country'],$_POST['uitem']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Updated " . $stmt->affected_rows . " rows in Item.";
                    }
                    $stmt->close();
                }
            ?>
            <div class="foot">
                <form action="Item.php">
                    <input class="input-secondary" type="submit" value="Back to Items" />
                </form>
            </div>
        </div>
    </body>
</html>