<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">

      <li <?=($_SERVER['PHP_SELF']=='/index.php')?'class="active"': '';?>>
        <a href="index.php"><i class="fa fa-calendar"></i><span>Main</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/index.php')?'class="active"': '';?>>
        <a href="list-day-workers.php"><i class="fa fa-calendar"></i><span>Workers Timetable</span></a>
      </li>

      <li class="header">Users</li>

      <li <?=($_SERVER['PHP_SELF']=='/list-attendant.php')?'class="active"':'';?>>
        <a href="list-attendant.php"><i class="fa fa-users"></i><span>Attendants</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-decorator.php')?'class="active"':'';?>>
        <a href="list-decorator.php"><i class="fa fa-users"></i><span>Decorators</span></a>
      </li>

      <li class="header">References</li>

      <li <?=($_SERVER['PHP_SELF']=='/list-time.php')?'class="active"':'';?>>
        <a href="list-time.php"><i class="fa fa-users"></i><span>Watering times</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-park.php')?'class="active"':'';?>>
        <a href="list-park.php"><i class="fa fa-users"></i><span>Parks</span></a>
      </li>
      
      <li <?=($_SERVER['PHP_SELF']=='/list-zone.php')?'class="active"':'';?>>
        <a href="list-zone.php"><i class="fa fa-users"></i><span>Zones</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-species.php')?'class="active"':'';?>>
        <a href="list-species.php"><i class="fa fa-users"></i><span>Species</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-plant.php')?'class="active"':'';?>>
        <a href="list-plant.php"><i class="fa fa-users"></i><span>Plants</span></a>
      </li>

      <li <?=($_SERVER['PHP_SELF']=='/list-plant.php')?'class="active"':'';?>>
        <a href="list-attendant-schedule.php"><i class="fa fa-users"></i><span>Schedules Managament</span></a>
      </li>
      
    </ul>
  </section>
</aside>