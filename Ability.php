<?php
    $page_title = "Abilities";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <caption>Abilities</caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Patron</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!($stmt = $mysqli->prepare("SELECT a.`name`, a.`description`, d.`name` FROM `ability` as a
                                                                INNER JOIN `deity` as d
                                                                ON a.`deity_id` = d.`id`
                                                                ORDER BY a.`name` ASC;")))
                            {
                                echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
                            }

                            if(!$stmt->execute())
                            {
                                echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }

                            if(!$stmt->bind_result($name, $description, $deity))
                            {
                                echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }
                            
                            while($stmt->fetch())
                            {
                                echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $description . "\n</td>\n<td>\n" . $deity . "\n</td>\n</tr>";
                            }
                            $stmt->close();
                        ?>
                    </tbody>    
                </table>
            </div>

            <div>
                <form method="post" action="AddAbility.php">
                    <fieldset>
                        <legend>Add/Update Ability</legend>
                        <div class="form-text">
                            <div>
                                <label for="name">Name</label>
                                <input type="text" name="name"/>
                            </div>
                            <div>
                                <label for="description">Description</label>
                                <input type="text" name="description"/>
                            </div>
                        </div>
                        <div class="form-select">
                            <label for="deity">Deity</label>
                            <select name="deity">
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT d.`id`, d.`name` FROM `deity` as d")))
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
                            <label for="uability">Ability to Update</label>
                            <select name="uability">
                                <option disabled selected value></option>
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT a.`id`, a.`name` FROM `ability` as a")))
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
                            <input class="input-primary" type="submit" name="create" value="Create Ability"/>
                            <input class="input-secondary" type="submit" name="update" value="Update Ability"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="ApplyAbility.php">
                    <fieldset>
                        <legend>Give a Character an Abiilty</legend>
                        <div class="form-select">
                            <label for="character">Character</label>
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
                            <label for="ability">Ability</label>
                            <select name="ability">
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT a.`id`, a.`name` FROM `ability` as a")))
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
                            <input class="input-primary" type="submit" name="create" value="Apply Ability"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="AllAbilitiesAllCharacters.php">
                    <fieldset>
                        <legend>All Abilities for All Characters</legend>                  
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="filter" value="Apply Filter"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="AbilitiesByCharacter.php">
                    <fieldset>
                        <legend>Filter Abilities by Character</legend>
                        <div class="form-select">
                            <label for="character">Character</label>
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

                <form method="post" action="AbilitiesByPatron.php">
                    <fieldset>
                        <legend>Filter Abilities by their Patron</legend>
                        <div class="form-select">
                            <label for="deity">Deity</label>
                            <select name="deity">
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT d.`id`, d.`name` FROM `deity` as d")))
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

                <form method="post" action="DeleteAbility.php"> <!--CHANGE-->
                    <fieldset>
                        <legend>Delete Ability</legend>
                        <div class="form-select">
                            <label for="ability">Ability to Delete</label>
                            <select name="ability">
                                <?php                                   
                                    if(!($stmt = $mysqli->prepare("SELECT a.`id`, a.`name` FROM `ability` as a")))
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
                            <input class="input-primary" type="submit" name="Filter" value="Delete Ability"/>
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