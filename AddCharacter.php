        <?php
            $page_title = "Adventure! - Add/Update Character";
            include 'header.php';
        ?>
        <div class="outer">
            <?php
                if(isset($_POST['create']))
                {
                    if(!($stmt = $mysqli->prepare("INSERT INTO `character`(`name`, `title`, `age`, `country_id`) VALUES (?,?,?,?)"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("ssii",$_POST['name'],$_POST['title'],$_POST['age'],$_POST['country']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Added " . $stmt->affected_rows . " rows to Characters.";
                    }
                    $stmt->close();
                }      
                else
                {
                    if(!($stmt = $mysqli->prepare("UPDATE `character` SET `character`.`name` = ?, `character`.`title` = ?, `character`.`age` = ?, `character`.`country_id` = ? WHERE `character`.`id` = ?"))){
                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!($stmt->bind_param("ssiii",$_POST['name'],$_POST['title'],$_POST['age'],$_POST['country'],$_POST['ucharacter']))){
                        echo "Bind failed: "  . $stmt->errno . " " . $stmt->error;
                    }
                    if(!$stmt->execute()){
                        echo "Execute failed: "  . $stmt->errno . " " . $stmt->error;
                    } else {
                        echo "</br>Updated " . $stmt->affected_rows . " rows in Characters.";
                    }
                    $stmt->close();
                }
            ?>
            <div class="foot">
                <form action="Character.php">
                    <input class="input-secondary" type="submit" value="Back to Characters" />
                </form>
            </div>
        </div>
    </body>
</html>