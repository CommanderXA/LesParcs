<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">

      <li <?=($_SERVER['PHP_SELF']=='/index.php')?'class="active"': '';?>>
        <a href="index.php"><i class="fa fa-calendar"></i><span>Main</span></a>
      </li>

      <li class="header">Users</li>

      <li <?=($_SERVER['PHP_SELF']=='/list-attendant.php')?'class="active"':'';?>>
        <a href="list-attendant.php"><i class="fa fa-users"></i><span>Attendants</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-decorator.php')?'class="active"':'';?>>
        <a href="list-decorator.php"><i class="fa fa-users"></i><span>Decorators</span></a>
      </li>
      
    </ul>
  </section>
</aside>