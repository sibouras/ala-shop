<!-- Sidebar -->
<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
  <div class="position-sticky">
    <div class="list-group list-group-flush mx-3 mt-4">
      <a href="dashboard.php" class="list-group-item list-group-item-action py-2 ripple <?php active('dashboard.php') ?>" aria-current="true">
        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span><?= lang('dashboard'); ?></span>
      </a>
      <a href="categories.php" class="list-group-item list-group-item-action py-2 ripple <?php active('categories.php'); ?> "><i class="fas fa-list-alt fa-fw me-3"></i><span><?= lang('categories') ?></span></a>
      <a href="items.php" class="list-group-item list-group-item-action py-2 ripple <?php active('items.php'); ?> "><i class="fas fa-shopping-cart fa-fw me-3"></i><span><?= lang('items') ?></span></a>
      <a href="users.php" class="list-group-item list-group-item-action py-2 ripple <?php active('users.php') ?>"><i class="fas fa-users fa-fw me-3"></i><span><?= lang(('users')) ?></span></a>
      <a href="#" class="list-group-item list-group-item-action py-2 ripple">
        <i class="fas fa-chart-pie fa-fw me-3"></i><span><?= lang('statistics') ?></span>
      </a>
      <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-history fa-fw me-3"></i><span><?= lang('logs') ?></span></a>
      <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a>
    </div>
  </div>
</nav>
<!-- Sidebar -->