<ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="active treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Master</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{route('user.index')}}"><i class="fa fa-user"></i>User</a></li>
            <li><a href="{{route('supplier.index')}}"><i class="fa fa-user"></i>Supplier</a></li>
            <li><a href="{{route('pegawai.index')}}"><i class="fa fa-circle-o"></i>Pegawai</a></li>
            <li><a href="{{route('kategori.index')}}"><i class="fa fa-circle-o"></i>Kategori</a></li>
            <li><a href="{{route('produk.index')}}"><i class="fa fa-circle-o"></i>Produk</a></li>
        </ul>
    </li>

    <li>
        <a href="{{ route('transaksi_masuk.index')}} ">
            <i class="fa fa-th"></i> <span>Transaksi Masuk</span>
        </a>
    </li>
</ul>