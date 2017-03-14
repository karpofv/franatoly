<?php
    error_reporting(E_ALL);
    ini_set('display_errors', false);
    ini_set('display_startup_errors', false);
    /* cerrar session */
    if ($_GET[out] == '1') {
        session_cache_limiter('nocache,private');
        session_start();
        $sid = session_id();
        session_destroy();
        header("Location: ../index.php?salir=1");
    }
    include_once('../includes/conexion.php');
    include_once('../includes/addons.php');
    include_once('clases/menu/class.menu.php');
    //////////////////////////////
    /////////////////////////////////////////Cargar Class
    $idMenut = $_POST[dmn];
    if ($idMenut == '') {
        $idMenut = $_GET[dmn];
        if ($idMenut == '') {
            $idMenut = $_SESSION[dmn];
        } else {
            $_SESSION[dmn] = $_GET[dmn];
        }
    }
    //////////////////////////////////////////////////////////////////////////////////////////////////
    /*$FOTO=DatosPersonales::datosFoto($cedula, $consultasMenu, $ruta_base);*/
    $act = $_POST[act];
    if ($act == '') {
        $act = $_GET[act];
    }
    $ver = $_POST[ver];
    if ($ver == '') {
        $ver = $_GET[ver];
    }
    /*$res = $consultasMenu->arrayConsulta("S,U,D,I,P", "perfiles_det", "perfdet_perfcodigo = '$_SESSION[usuario_permisos]' AND perfdet_menucodigo = '$idMenut'");
    foreach ($res as $arr) {
        $accPermisos = array(Consultar => $arr[S], Actualizar => $arr[U], Insertar => $arr[I], Eliminar => $arr[D], Imprimir => $arr[P]);
    }*/
    $bMenu = 'menu';
    $bMenur = 'menu_url';
    $bMenuni = 'menu_includes';
    /*if ($_POST[ver] == '1' or $_GET[ver] == '1' or $_SESSION[ver] == '1') {
        $res_ = $consultasMenu->arrayConsulta("URL", "recargar", "id=$idMenut");
        foreach ($res_ as $rownivel) {
            $conexf = $rownivel["URL"];
        }
    }*/
    if($ver==''){
        if ($act == '') {
            $res_ = $consultasMenu->arrayConsulta("*", "$bMenu", "men_codigo=$idMenut");
            foreach ($res_ as $rownivel) {
                //echo "<br><br><br><br><br><br><br><br><br><br>//$idMenut//$bMenu";
                $conexf = $rownivel["menu_enlace"];
            }
        } else {
            $res_ = $consultasMenu->arrayConsulta("*", "$bMenur", "menr_menucodigo=$idMenut and menr_codigo=$act");
            foreach ($res_ as $rownivel) {
                //echo "<br><br><br><br><br><br><br><br><br><br>//$idMenut//$bMenu";
                $conexf = $rownivel["menr_url"];
            }
        }
        if ($conexf != '') {
            $res_ = $consultasMenu->arrayConsulta("*", "$bMenuni", "meni_menucodigo=$idMenut and meni_posicion=0 order by meni_orden");
            foreach ($res_ as $rownivel) {
                include_once($rownivel["meni_enlace"]);
            }
            include_once($conexf);
            $res_ = $consultasMenu->arrayConsulta("*", "$bMenuni", "meni_menucodigo=$idMenut and meni_posicion=1 order by meni_orden");
            foreach ($res_ as $rownivel) {
                include_once($rownivel["meni_enlace"]);
            }
        }
    }
    if($ver==1){
        $res_ = Addons::arrayConsulta("*", "recargar", "rec_codigo=$idMenut");
        foreach ($res_ as $rownivel) {
            //echo "<br><br><br><br><br><br><br><br><br><br>//$idMenut//$bMenu";
            $conexf = $rownivel["rec_url"];
        }
        if ($conexf!='') {
            include_once($conexf);
        }
    }
    @mysql_close();
?>
