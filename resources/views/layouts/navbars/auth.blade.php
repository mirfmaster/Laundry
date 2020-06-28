<?php
$userLevel = auth()->user()->level;
?>
<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/laundry.png">
            </div>
        </a>
        <a href="" class="simple-text logo-normal">
            {{ __('Laundry') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'laundry' ? 'active' : '' }}">
                <a href="{{ route('laundry.index') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Laundry') }}</p>
                </a>
            </li>
            @if($userLevel != 'kasir')
            <li class="{{ $elementActive == 'pembelian' ? 'active' : '' }}">
                <a href="{{ route('pembelian.index') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Pembelian') }}</p>
                </a>
            </li>
            @endif
            @if($userLevel != 'kepala')
            <li class="{{ $elementActive == 'pemakaian' ? 'active' : '' }}">
                <a href="{{ route('pemakaian.index') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Pemakaian') }}</p>
                </a>
            </li>
            @endif
            <li class="{{ $elementActive == 'laporanpembelian' || $elementActive == 'laporanlaundry' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laporan">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                        {{ __('Laporan') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="laporan">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'laporanpembelian' ? 'active' : '' }}">
                            <a href="{{ route('laporanpembelian') }}">
                                <span class="sidebar-mini-icon">{{ __('LP') }}</span>
                                <span class="sidebar-normal">{{ __(' Laporan Pembelian ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'laporanlaundry' ? 'active' : '' }}">
                            <a href="{{ route('laporanlaundry') }}">
                                <span class="sidebar-mini-icon">{{ __('LP') }}</span>
                                <span class="sidebar-normal">{{ __(' Laporan Penjualan ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <?php
            $selectedMasterData = $elementActive == 'customer' || $elementActive == 'supplier' || $elementActive == 'item' || $elementActive == 'layanan';
            ?>
            <li class="{{ $selectedMasterData ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#masterData">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                        Master Data
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse {{ $selectedMasterData ? 'show' : '' }}" id="masterData">
                    <ul class="nav">
                        @if($userLevel != 'kasir')
                        <li class="{{ $elementActive == 'supplier' ? 'active' : '' }}">
                            <a href="{{ route('supplier.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('S') }}</span>
                                <span class="sidebar-normal">{{ __(' Supplier ') }}</span>
                            </a>
                        </li>
                        @endif
                        <li class="{{ $elementActive == 'item' ? 'active' : '' }}">
                            <a href="{{ route('item.index') }}">
                                <span class="sidebar-mini-icon">{{ __('I') }}</span>
                                <span class="sidebar-normal">{{ __(' Item ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'layanan' ? 'active' : '' }}">
                            <a href="{{ route('layanan.index') }}">
                                <span class="sidebar-mini-icon">{{ __('L') }}</span>
                                <span class="sidebar-normal">{{ __(' Layanan ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            @if($userLevel == 'admin')
            <!-- <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                        {{ __('User Management') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li> -->
            @endif
            <!-- <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'map' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'map') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'tables' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tables') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>{{ __('Table List') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'typography' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'typography') }}">
                    <i class="nc-icon nc-caps-small"></i>
                    <p>{{ __('Typography') }}</p>
                </a>
            </li> -->
        </ul>
    </div>
</div>