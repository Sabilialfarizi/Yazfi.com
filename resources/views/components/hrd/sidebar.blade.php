<ul>
    <li class="menu-title">Main</li>
    <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
        <a href="/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
    </li>

    <li class="submenu">
        <a href="#"><i class="fa fa-users"></i> <span> Master</span> <span class="menu-arrow"></span></a>
        <ul style="display: none;">
            <li class="{{ request()->is('hrd/users*') ? 'active' : '' }}">
                <a href="{{ route('hrd.users.index') }}"><span>User</span></a>
            </li>
            <li class="{{ request()->is('hrd/permission*') ? 'active' : '' }}">
                <a href="{{ route('hrd.permission.index') }}">
                    <span>Roles</span></a></li>
            <li class="{{ request()->is('hrd/jabatan*') ? 'active' : '' }}">
                <a href="{{ route('hrd.jabatan.index') }}"><span>Jabatan</span></a>
            </li>
            <li class="{{ request()->is('hrd/roles*') ? 'active' : '' }}"> <a href="{{ route('hrd.roles.index') }}">
                    <span>Divisi</span></a></li>
            {{-- <li><a href="{{ route('admin.report.barang')  }}"> Laporan Barang</a>
    </li> --}}
</ul>
</li>
<li class="submenu">
    <a href="#"><i class="fa-solid fa-hand-holding-dollar"></i> <span>Reinburst</span> <span
            class="menu-arrow"></span></a>
    <ul style="display: none;">
        <li class="{{ request()->is('hrd/reinburst*') ? 'active' : '' }}">
            <a href="{{ route('hrd.reinburst.index') }}"> <span>Rekap Reinburst</span></a>
        </li>
        <li class="{{ request()->is('hrd/penerimaan*') ? 'active' : '' }}">
            <a href="{{ route('hrd.penerimaan.index') }}"><span>Acc Reinburst</span></a>
        </li>
    </ul>
</li>

<li class="{{ request()->is('hrd/sales*') ? 'active' : '' }}">
    <a href="{{ route('hrd.sales.index') }}"><i class="fa fa-user-plus" aria-hidden="true"></i> <span>Team
            Sales</span></a>
</li>

<li class="{{ request()->is('hrd/pengajuan*') ? 'active' : '' }}">
    <a href="{{ route('hrd.pengajuan.index') }}"><i class="fa-solid fa-file-invoice"></i><span>Pengajuan dana</span></a>
</li>
<li class="submenu">
    <a href="#"><i class="fa-solid fa-calendar-check"></i> <span>Attandance</span><span class="menu-arrow"></span></a>
    <ul style="display: none;">
        <li class="{{ request()->is('hrd/attendance*') ? 'active' : '' }}">
            <a href="{{ route('hrd.attendance.index') }}"><span>Absen</span></a>
        </li>
        <li class="{{ request()->is('hrd/MstLokasi*') ? 'active' : '' }}">
            <a href="{{ route('hrd.MstLokasi.index') }}">
                <span>Lokasi</span></a></li>
        <li class="{{ request()->is('hrd/holidays*') ? 'active' : '' }}">
            <a href="{{ route('hrd.holidays.index') }}">
                <span>Holidays Date</span></a></li>
        <li class="{{ request()->is('hrd/jam*') ? 'active' : '' }}">
            <a href="{{ route('hrd.jam.index') }}">
                <span>Jam Shift</span></a></li>
    </ul>
</li>
{{-- <li class="{{ request()->is('admin/purchase*') ? 'active' : '' }}">
<a href="{{ route('admin.purchase.index') }}"><i class="fa fa-money" aria-hidden="true"></i> <span>Payroll</span></a>
</li> --}}
<li class="submenu">
    <a href="#"><i class="fa fa-money" aria-hidden="true"></i> <span>Payroll</span><span class="menu-arrow"></span></a>
    <ul style="display: none;">
        <li class="{{ request()->is('hrd/penerimaangaji*') ? 'active' : '' }}">
            <a href="{{ route('hrd.penerimaangaji.index') }}"><span>Penerimaan</span></a>
        </li>
        <li class="{{ request()->is('hrd/potongan*') ? 'active' : '' }}">
            <a href="{{ route('hrd.potongan.index') }}">
                <span>Potongan</span></a></li>
        <li class="{{ request()->is('hrd/rincianpenggajian*') ? 'active' : '' }}">
            <a href="{{ route('hrd.rincianpenggajian.index') }}">
                <span>Rincian Gaji</span></a></li>
        <li class="{{ request()->is('hrd/gaji*') ? 'active' : '' }}">
            <a href="{{ route('hrd.gaji.index') }}"><span>Pengajian</span></a>
        </li>
</li>
</ul>
