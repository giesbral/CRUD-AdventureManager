<?php
    $page_title = "Items";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <caption>Items</caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!($stmt = $mysqli->prepare("SELECT i.`name`, i.`value`, c.`name` FROM `item` as i
                                                                INNER JOIN `country` as c
                                                                ON i.`country_id` = c.`id`
                                                                ORDER BY i.`name` ASC;")))
                            {
                                echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
                            }

                            if(!$stmt->execute())
                            {
                                echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }

                            if(!$stmt->bind_result($name, $value, $country))
                            {
                                echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }
                            
                            while($stmt->fetch())
                            {
                                echo "<tr>\n<td>\n" . $name . "\n</td>\n<td class=\"td-num\">\n" . $value . "\n</td>\n<td>\n" . $country . "\n</td>\n</tr>";
                            }
                            $stmt->close();
                        ?>
                    </tbody>    
                </table>
            </div>

            <div>
                <form method="post" action="AddItem.php">
                    <fieldset>
                        <legend>Add/Update Item</legend>
                        <div class="form-text">
                            <div>
                                <label for="name">Name</label>
                                <input type="text" name="name"/>
                            </div>
                            <div>
                                <label for="value">Value</label>
                                <input type="text" name="value"/>
                            </div>
                        </div>
                        <div class="form-select">
                            <label for="country">Country</label>
                            <select name="country">
                                <?php
                                    if(!($stmt = $mysqli->prepare("SELECT id, name FROM country")))
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
                            <label for="uitem">Item to Update</label>
                            <select name="uitem">
                                <option disabled selected value></option>
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
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="create" value="Create Item"/>
                            <input class="input-secondary" type="submit" name="update" value="Update Item"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="ItemsByCountry.php">
                    <fieldset>
                        <legend>Filter Items by Origin</legend>
                        <div class="form-select">
                            <label for="country">Country</label>
                            <select name="country">
                                <?php
                                    if(!($stmt = $mysqli->prepare("SELECT id, name FROM country")))
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

                <form method="post" action="DeleteItem.php">
                    <fieldset>
                        <legend>Delete Item</legend>
                        <div class="form-select">
                            <label for="item">Item to Delete</label>
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
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="Filter" value="Delete Item"/>
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