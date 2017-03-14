<?php
Class Menu {
    function submenu($codigo, $nivel, $subc){
        $nivel = $nivel+1;
?>
        <ul>
<?php
        if($nivel==1){
            $consulsubmenu = Addons::arrayConsulta("*","menu_submenu sm, perfiles_det pd","sm.subm_codigo=pd.perdet_submcodigo and subm_menucodigo=$codigo and subm_status=1 and subm_nivel=1");
        } else {
            $consulsubmenu = Addons::arrayConsulta("*","menu_submenu sm, perfiles_det pd","sm.subm_codigo=pd.perdet_submcodigo and subm_conexion=$subc and subm_status=1 and subm_nivel=$nivel");
        }
        foreach($consulsubmenu as $submenu){
            if (strlen($submenu['subm_descripcion']) > 14) {
                $submenuli = substr($submenu['subm_descripcion'],0,14).'... ';
            } else {
                $submenuli = $submenu['subm_descripcion'];
            }
?>
            <li>
                <a href="#" title="<?php echo $submenuli; ?>">
                    <i class="<?php echo $submenu[subm_icono]?>"></i>
                    <span><?php echo $submenuli; ?></span>
                </a>
<?php
                Menu::submenu($codigo, $nivel, $submenu['subm_codigo']);
?>
            </li>
<?php
        }
?>
        </ul>
<?php
    }
    function menuprinc($nivel) {
        /*Se consulta menu principal*/
        $consulmenu = Addons::arrayConsulta("distinct m.*","menu m, perfiles_det pd","m.menu_codigo=pd.perfdet_menucodigo and m.menu_status=1");
        foreach($consulmenu as $menu){
            if (strlen($menu['menu_descripcion']) > 14) {
              $menuli = substr($menu['menu_descripcion'],0,14).'... ';
            } else {
              $menuli = $menu['menu_descripcion'];
            }
            ?>
            <li>
                <a href="#" title="<?php echo $menuli; ?>">
                    <i class="<?php echo $menu[menu_icono]?>"></i>
                    <span><?php echo $menuli; ?></span>
                </a>
            </li>

            <?php
            Menu::submenu($menu['menu_codigo'], 0, 0);
        }
        ////////////////////////////////////////////////////////////////////
    }
}
?>
