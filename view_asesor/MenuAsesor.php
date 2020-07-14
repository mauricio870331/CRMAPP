<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="../Model/Usuarios/imageProfile.php" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p style="font-size: 13px;"> <?php echo $_SESSION['obj_user'][0]['nombre_completo'] ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>      
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">Navegación Principal</li>

            <li class="treeview" id="Inicio" data-view="asesor">
                <a href="javascript:void(0);" >
                    <i class="fa fa-home"></i> <span>Inicio</span>                     
                </a>                
            </li>

            <li class="treeview">
                <a href="javascript:void(0);">
                    <i class="fa fa-users"></i> <span>Menú</span>                    
                </a>
                <ul class="treeview-menu">
                    <li><a href="ListarLeads.php"><i class="fa fa-circle-o"></i> Listar Leads</a></li>
                    <li><a href="ListarLeads.php"><i class="fa fa-circle-o"></i> Listar Clientes</a></li>
                    <li><a href="CrearLeads.php"><i class="fa fa-circle-o"></i> Crear Lead</a></li>                     
                </ul>
            </li>

           

<!--            <li class="treeview">
                <a href="javascript:void(0);">
                    <i class="fa fa-money"></i> <span>Pagos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="ListadoDePagos.php"><i class="fa fa-circle-o"></i> Historial de Pagos</a></li>                    
                </ul>
            </li>  -->

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
