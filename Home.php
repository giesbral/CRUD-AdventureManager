<?php
    $page_title = "Adventure! - Home";
    include 'header.php';
?>
        <div class="outer">
            <h3 style="margin-left:8px;margin-bottom:2px;">Adventure! - Entities</h3>
            <div class="linklist">
                <form action="Character.php">
                    <input class="input-secondary" type="submit" value="Characters" />
                </form>
                <form action="Deity.php">
                    <input class="input-secondary" type="submit" value="Deities" />
                </form>
                <form action="Ability.php">
                    <input class="input-secondary" type="submit" value="Abilities" />
                </form>
                <form action="Country.php">
                    <input class="input-secondary" type="submit" value="Countries" />
                </form>
                <form action="Item.php">
                    <input class="input-secondary" type="submit" value="Items" />
                </form>
                <form action="Equipment.php">
                    <input class="input-secondary" type="submit" value="Equipment" />
                </form>
            </div>
        </div>
    </body>
</html>