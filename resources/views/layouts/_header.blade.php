<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="/dashboard" class="logo">
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Navbar Right Menu -->
        <ul class="nav nav-pills pull-left">
            <li class="btn-group active">
                <a href="/monitor/summary" class=""><span class="glyphicon glyphicon-dashboard"></span> 监测分析</a>
                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only"> </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/monitor/ammeter">电能监测</a></li>
                    <li><a href="/monitor/watermeter">水量监测</a></li>
                    <li><a href="#">天然气监测</a></li>
                    <li><a href="#">蒸汽量监测</a></li>
                    <li><a href="#">室内环境监测</a></li>
                </ul>
            </li>

            <li class="btn-group">
                <a href="/monitor/summary" class=""><span class="glyphicon glyphicon-calendar"></span> 数据统计</a>
                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only"> </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">能耗统计</a></li>
                    <li><a href="#">费用分析</a></li>
                    <li><a href="#">评价能耗</a></li>
                </ul>
            </li>

            <li class="btn-group active">
                <a href="#" class=""><span class="glyphicon glyphicon-leaf"></span> 节能管理</a>
                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only"> </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/monitor/ammeter">电能监测</a></li>
                    <li><a href="/monitor/watermeter">水量监测</a></li>
                </ul>
            </li>

            <li class="btn-group active">
                <a href="#" class=""><span class="glyphicon glyphicon-envelope"></span> 报警处理</a>
                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only"> </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/monitor/ammeter">电能监测</a></li>
                    <li><a href="/monitor/watermeter">水量监测</a></li>
                </ul>
            </li>

            <li class="btn-group active">
                <a href="#" class=""><span class="glyphicon glyphicon-off"></span> 系统配置</a>
                <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only"> </span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/monitor/ammeter">建筑管理</a></li>
                    <li><a href="/monitor/watermeter">设备管理</a></li>
                    <li><a href="/monitor/watermeter">基本配置</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="/monitor/watermeter">账号管理</a></li>
                    <li><a href="/monitor/watermeter">权限和角色</a></li>
                </ul>
            </li>
        </ul>

        <ul class="nav navbar-nav pull-right">
            <li class="dropdown btn-group user user-menu">
                <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/admin-lte/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> 旺财
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/monitor/ammeter">个人设置</a></li>
                    <li><a href="/monitor/watermeter">退出登录</a></li>
                </ul>
            </li>
        </ul>

    </nav>

</header>