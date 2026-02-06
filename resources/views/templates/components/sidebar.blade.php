<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<div>
    <aside id="layout-menu" class="layout-menu menu-vertical menu">
        <div class="app-brand demo ">
            <a href="index.html" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <span class="text-primary">
                        <img src="{{ asset('assets/img/icons/medina-no-bg.png') }}" alt="medina" style="height: 70px;">
                    </span>
                </span>
                <span class="app-brand-text demo menu-text fw-bold ms-2" style="font-size:17px;">Admin
                    <span style="color:#0249b4;">Master</span>
                </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
                <i class="icon-base ti tabler-x d-block d-xl-none"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-header small">
                <span class="menu-header-text">Dashboard</span>
            </li>
            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-layout-grid"></i>
                    <div>Dashboard</div>
                </a>
            </li>
            <!-- Master Kawasan -->
            <li class="menu-header small">
                <span class="menu-header-text">Master Kawasan</span>
            </li>
            <li class="menu-item {{ request()->routeIs('kawasan.*') ? 'open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-building"></i>
                    <div>Kawasan Hunian</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('kawasan.data') ? 'active' : '' }}">
                        <a href="{{ route('kawasan.data') }}" class="menu-link">
                            <div>Data Kawasan</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('kawasan.create') ? 'active' : '' }}">
                        <a href="{{ route('kawasan.create') }}" class="menu-link">
                            <div>Kawasan Baru</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-file"></i>
                    <div>RAB</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div>Data RAB</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div>RAB Baru</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div>Detail RAB</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-cash"></i>
                    <div>Pembiayaan</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div>Data Pembiayaan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div>Pembiayaan Baru</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div>Detail Pembiayaan</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon icon-base ti tabler-building-community"></i>
                    <div>Unit</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="#" class="menu-link">
                            <div>Data Unit</div>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- Operasional --}}
            <li class="menu-header small">
                <span class="menu-header-text">Operasional</span>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
                    <div>Purchase Order</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-wallet"></i>
                    <div>Permintaan Dana</div>
                </a>
            </li>
            {{-- Laporan --}}
            <li class="menu-header small">
                <span class="menu-header-text">Laporan</span>
            </li>
            <li class="menu-item">
                <a href="#" class="menu-link">
                    <i class="menu-icon icon-base ti tabler-chart-pie-2"></i>
                    <div>Debit Kredit</div>
                </a>
            </li>
        </ul>
    </aside>

    <div class="menu-mobile-toggler d-xl-none rounded-1">
        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
            <i class="ti tabler-menu icon-base"></i>
            <i class="ti tabler-chevron-right icon-base"></i>
        </a>
    </div>
</div>
