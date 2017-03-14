<?php
    $nivel="1";
?>
<div id="sidebar-menu">
    <ul>
        <?php
            $menu = new Menu();
            $menu->menuprinc($nivel);
        ?>
    </ul>
</div>
