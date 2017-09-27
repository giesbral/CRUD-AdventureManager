<?php
    $page_title = "Characters";
    include 'header.php';
?>
        <div class="outer">
            <div>
                <table>
                    <caption>Characters</caption>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Age</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(!($stmt = $mysqli->prepare("SELECT ch.`name`, ch.`title`, ch.`age`, c.`name` FROM `character` as ch INNER JOIN `country` as c ON ch.`country_id` = c.`id` ORDER BY ch.`name` ASC")))
                            {
                                echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
                            }

                            if(!$stmt->execute())
                            {
                                echo "Execute failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }

                            if(!$stmt->bind_result($name, $title, $age, $country))
                            {
                                echo "Bind failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
                            }
                            
                            while($stmt->fetch())
                            {
                                echo "<tr>\n<td>\n" . $name . "\n</td>\n<td>\n" . $title . "\n</td>\n<td class=\"td-num\">\n" . $age . "\n</td>\n<td>\n" . $country . "\n</td>\n</tr>";
                            }
                            $stmt->close();
                        ?>
                    </tbody>    
                </table>
            </div>

            <div>
                <form method="post" action="AddCharacter.php">
                    <fieldset>
                        <legend>Add/Update Character</legend>
                        <div class="form-text">
                            <div>
                                <label for="name">Name</label>
                                <input type="text" name="name"/>
                            </div>
                            <div>
                                <label for="title">Title</label>
                                <input type="text" name="title"/>
                            </div>
                            <div>
                                <label for="age">Age</label>
                                <input type="text" name="age"/>
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
                            <label for="ucharacter">Character to Update</label>
                            <select name="ucharacter">
                                <option disabled selected value></option>
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
                        </div>                   
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="create" value="Create Character"/>
                            <input class="input-secondary" type="submit" name="update" value="Update Character"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="ApplyCreator.php">
                    <fieldset>
                        <legend>Give a Character a Creator</legend>
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
                        </div>                   
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="create" value="Add Creator"/>
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

                <form method="post" action="CharactersByCountry.php">
                    <fieldset>
                        <legend>Filter Characters by Country</legend>
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

                <form method="post" action="CharactersByDeity.php">
                    <fieldset>
                        <legend>Filter Characters by their Creator</legend>
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

                <form method="post" action="AllCharactersAllDeities.php">
                    <fieldset>
                        <legend>All Characters and their Creator(s)</legend>                  
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="filter" value="Apply Filter"/>
                        </div>
                    </fieldset>
                </form>

                <form method="post" action="DeleteCharacter.php">
                    <fieldset>
                        <legend>Delete Character</legend>
                        <div class="form-select">
                            <label for="character">Character to Delete</label>
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
                        </div>                   
                        <div class="form-buttons">
                            <input class="input-primary" type="submit" name="Filter" value="Delete Character"/>
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