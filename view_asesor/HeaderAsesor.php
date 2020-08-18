<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>Ad</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>CRM-</b>APP</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!-- <li class="dropdown messages-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                         <i class="fa fa-bell-o"></i>
                         <span class="label label-success">4</span>
                     </a>
                     <ul class="dropdown-menu">
                         <li class="header">You have 4 messages</li>
                         <li>
 
                             <ul class="menu">
                                 <li> start message 
                                     <a href="#">
                                         <div class="pull-left">
                                             <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                                         </div>
                                         <h4>
                                             Support Team
                                             <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                         </h4>
                                         <p>Why not buy a new awesome theme?</p>
                                     </a>
                                 </li>
                                 end message 
                             </ul>
                         </li>
                         <li class="footer"><a href="#">See All Messages</a></li>
                     </ul>
                 </li>->
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <?php
                    $con = new BD();
                    $SQL_SELECT = "SELECT * FROM recordatorios"
                            . " where _to = " . $_SESSION['obj_user'][0]['id'] . ""
                            . " and estado in ('Pendiente') limit 10";
                    if (strpos($_SERVER["REQUEST_URI"], "Profile") !== false) {
                        $SQL_SELECT = "SELECT * FROM recordatorios"
                                . " where ( _to = " . $_SESSION['obj_user'][0]['id'] . " or _to = 0)"
                                . " and (estado in ('Pendiente') or pending_to like '%".$_SESSION['obj_user'][0]['id']."%' )"
                                . " and ss_persona = '" . base64_decode($_GET['token']) . "' limit 10";
                    }
                    
//                    echo $SQL_SELECT;die;
                    
                    
                    $list = $con->query($SQL_SELECT);
//                    echo "<pre>";
//                    print_r($list);die;                    
                    $con->desconectar();
                    ?>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-clock-o"></i>
                        <?php if (count($list) > 0) { ?>
                            <span class="label label-warning"><?php echo count($list); ?></span>
                        <?php } ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes <?php echo count($list); ?>  recordatorios nuevos</li>
                        <li>
                            <ul class="menu">
                                <?php foreach ($list as $value) { ?>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-flag text-aqua"></i> <?php echo $value['descripcion']; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php
                        if (strpos($_SERVER["REQUEST_URI"], "Profile") !== false) {
                            ?>
                            <li class = "footer"><a id = "seeNotify" href = "javascript:void(0)">Ver Todos</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <!--
                 <li class="dropdown tasks-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                         <i class="fa fa-flag-o"></i>
                         <span class="label label-danger">9</span>
                     </a>
                     <ul class="dropdown-menu">
                         <li class="header">You have 9 tasks</li>
                         <li>
                              inner menu: contains the actual data 
                             <ul class="menu">
                                 <li> Task item 
                                     <a href="#">
                                         <h3>
                                             Design some buttons
                                             <small class="pull-right">20%</small>
                                         </h3>
                                         <div class="progress xs">
                                             <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
                                                  aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                 <span class="sr-only">20% Complete</span>
                                             </div>
                                         </div>
                                     </a>
                                 </li>
                                  end task item 
                             </ul>
                         </li>
                         <li class="footer">
                             <a href="#">View all tasks</a>
                         </li>
                     </ul>
                 </li>-->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../Model/Usuarios/imageProfile.php" class="user-image" alt="User Image">
                        <span class="hidden-xs">
                            <?php echo $_SESSION['obj_user'][0]['nombre_completo'] ?>
                        </span>
                    </a>
                    <ul class="dropdown-menu">                             
                        <li class="user-footer">                                        
                            <div class="pull-right">
                                <a href="../Model/Logout.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </li>                            
            </ul>
        </div>
    </nav>
</header>
