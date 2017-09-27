<?php
    $page_title = "Equipment";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <caption>Equipment</caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Durability</th>
                            <th>Owner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!($stmt = $mysqli->prepare("SELECT  i.`name`, ci.`durability`, ch.`name` FROM `character_item` as ci
                                                                    INNER JOIN `character` as ch
                                                                    ON ci.`character_id` = ch.`id`
                                                                    INNER JOIN `item` as i
                                                                    ON ci.`item_id` = i.`id`
                                                                    ORDER BY i.`name` ASC;")))
                            {
                                echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
                            }

                            if(!$stmt->execute())
                            {
                                echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }

                            if(!$stmt->bind_result($name, $durability, $owner))
                            {
                                echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }
                            
                            while($stmt->fetch())
                            {
                                echo "<tr>\n<td>\n" . $name . "\n</td>\n<td class=\"td-num\">\n" . $durability . "\n</td>\n<td>\n" . $owner . "\n</td>\n</tr>";
                            }
                            $stmt->close();
                        ?>
                    </tbody>    
                </table>
            </div>

            <div>
                <form method="post" action="AddEquipment.php">
                    <fieldset>
                        <legend>Add/Update Equipment</legend>
                        <div class="form-select">
                            <label for="item">Item</label>
                            <select name="item">
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT i.`id`, i.`name` FROM `item` as i")))
                                    {
                                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $name)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                                    }
                                    $stmt->close();
                                ?>
                            </select>
                        </div>
                        <div class="form-text">
                            <div>
                                <label for="durability">Durability</label>
                                <input type="text" name="durability"/>
                            </div>
                        </div>
                        <div class="form-select">
                            <label for="character">Owner</label>
                            <select name="character">
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT ch.`id`, ch.`name` FROM `character` as ch")))
                                    {
	                                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $name)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                                    }
                                    $stmt->close();
                                ?>
                            </select> 
                            <label for="uequipment">Equipment to Update</label>
                            <select name="uequipment">
                                <option disabled selected value></option>
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT  ci.id, CONCAT(ch.`name`,'\'s ', i.`name`) as equipment FROM `character_item` as ci
                                                                    INNER JOIN `character` as ch
                                                                    ON ci.`character_id` = ch.`id`
                                                                    INNER JOIN `item` as i
                                                                    ON ci.`item_id` = i.`id`;")))
                                    {
	                                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $equipment)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo '<option value=" '. $id . ' "> ' . $equipment . '</option>\n';
                                    }
                                    $stmt->close();
                                ?>
                            </select>
                        </div>                   
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="create" value="Create Equipment"/>
                            <input class="input-secondary" type="submit" name="update" value="Update Equipment"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="EquipmentByCharacter.php">
                    <fieldset>
                        <legend>Filter Equipment by Owner</legend>
                        <div class="form-select">
                            <label for="character">Character</label>
                            <select name="character">
                                <?php
                                    if(!($stmt = $mysqli->prepare("SELECT c.`id`, c.`name` FROM `character` as c;")))
                                    {
	                                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $name)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo "<option value='{\"id\":\"" . $id . "\",\"name\":\"" . $name . "\"}'>" . $name . "</option>\n";
                                    }
                                    $stmt->close();
                                ?>
                            </select>
                        </div>                   
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="filter" value="Apply Filter"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="EquipmentByItem.php">
                    <fieldset>
                        <legend>Filter Equipment by Item Name</legend>
                        <div class="form-select">
                            <label for="item">Item</label>
                            <select name="item">
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT i.`id`, i.`name` FROM `item` as i")))
                                    {
	                                    echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $name)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo "<option value='{\"id\":\"" . $id . "\",\"name\":\"" . $name . "\"}'>" . $name . "</option>\n";
                                    }
                                    $stmt->close();
                                ?>
                            </select>
                        </div>                    
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="filter" value="Apply Filter"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="DeleteEquipment.php">
                    <fieldset>
                        <legend>Delete Equipment</legend>
                        <div class="form-select">
                            <label for="equipment">Equipment to Delete</label>
                            <select name="equipment">
                                <?php
                                    if(!($stmt = $mysqli->prepare("SELECT  ci.id, CONCAT(ch.`name`,'\'s ', i.`name`) as equipment FROM `character_item` as ci
                                                                    INNER JOIN `character` as ch
                                                                    ON ci.`character_id` = ch.`id`
                                                                    INNER JOIN `item` as i
                                                                    ON ci.`item_id` = i.`id`;")))
                                    {
	                                        echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
                                    }
                                    if(!$stmt->execute()){
                                        echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    if(!$stmt->bind_result($id, $name)){
                                        echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
                                    }
                                    while($stmt->fetch()){
                                        echo '<option value=" '. $id . ' "> ' . $name . '</option>\n';
                                    }
                                    $stmt->close();
                                ?>
                            </select>
                        </div>                   
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="Filter" value="Delete Equipment"/>
                        </div>
                    </fieldset>
                </form>
            </div>
            <div class="foot">
                <form action="Home.php">
                    <input class="input-secondary" type="submit" value="Home" />
                </form>
            </div>
        </div>  
    </body>
</html>