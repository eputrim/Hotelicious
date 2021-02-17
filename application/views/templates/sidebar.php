 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <div class="sidebar-brand d-flex align-items-center justify-content-center">
         <div class="sidebar-brand-icon ">
             <i class="fas fa-hotel"></i>
         </div>
         <div class="sidebar-brand-text mx-3">Hotelicious</div>
     </div>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Query Menu -->
     <?php
        $role_id = $this->session->userdata('role_id');
        $queryMenu = "SELECT `id`, `role` FROM `role` WHERE `role`.`id` = $role_id";
        $menu = $this->db->query($queryMenu)->result_array();

        ?>

     <!-- Looping Menu -->
     <?php foreach ($menu as $m) : ?>
         <div class="sidebar-heading">
             <?= $m['role']; ?>
         </div>

         <!-- Submenu -->
         <?php
            $menuId = $m['id'];
            $querySubMenu = "SELECT * FROM `user_menu` WHERE `user_menu`.`role_id` = $menuId";
            $subMenu = $this->db->query($querySubMenu)->result_array();
            ?>

         <?php foreach ($subMenu as $sm) : ?>
             <?php if ($title == $sm['title']) : ?>
                 <li class="nav-item active">
                 <?php else : ?>
                 <li class="nav-item">
                 <?php endif; ?>
                 <a class="nav-link pb-0" href="<?= base_url($sm['url']); ?>">
                     <i class="<?= $sm['icon']; ?>"></i>
                     <span class="col-sm-8"><?= $sm['title']; ?></span></a>
                 </li>
             <?php endforeach ?>

             <!-- Divider -->
             <hr class="sidebar-divider mt-3">

         <?php endforeach ?>

         <li class="nav-item">
             <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                 <i class=" fas fa-fw fa-sign-out-alt"></i>
                 <span>Logout</span></a>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider">

         <!-- Sidebar Toggler (Sidebar) -->
         <div class="text-center d-none d-md-inline">
             <button class="rounded-circle border-0" id="sidebarToggle"></button>
         </div>

 </ul>
 <!-- End of Sidebar -->