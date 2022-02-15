<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>

    <li class="{{ request()->is('purchasing/listpruchase*') ? 'active' : '' }}">
        <a href="{{ route('purchasing.listpurchase.index') }}"><i class="fa fa-calculator"></i> <span>List Purchase</span></a>
    </li>

    <li class="{{ request()->is('purchasing/inputtukarfaktur*') ? 'active' : '' }}">
        <a href="{{ route('purchasing.tukarfaktur.index') }}"><i class="fa fa-calculator"></i> <span>List Faktur</span></a>
    </li>
    <li class="{{ request()->is('purchasing/reinburst*') ? 'active' : '' }}">
        <a href="{{ route('purchasing.reinburst.index') }}"><i class="fa fa-calculator"></i> <span>Reinburst</span></a>
    </li>

</ul>