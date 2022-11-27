  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside
  	class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
  	id="sidenav-main">
  	<div class="sidenav-header">
  		<i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
  			aria-hidden="true" id="iconSidenav"></i>
  		<a class="navbar-brand m-0" href="<?= site_url('admin');?>" target="_blank">
  			<img src="<?= base_url();?>assets/images/icon.png" class="navbar-brand-img h-100" alt="main_logo">
  			<span class="ms-1 font-weight-bold">SPK BANSOS</span>
  		</a>
  	</div>
  	<hr class="horizontal dark mt-0">
  	<div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
  		<ul class="navbar-nav">
  			<li class="nav-item" id="sidebar-dashboard">
  				<a class="nav-link <?= $this->uri->segment(1) == 'admin' && empty($this->uri->segment(2)) ? 'active' : '';?>"
  					href="<?= site_url('admin');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
  						<i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Dashboard</span>
  				</a>
  			</li>
  			<li class="nav-item mt-3">
  				<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Master</h6>
  			</li>
  			<li class="nav-item" id="sidebar-bansos">
  				<a class="nav-link <?= $this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'bansos' ? 'active' : '';?>"
  					href="<?= site_url('master/bansos');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
  						<i class="fas fa-boxes text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Data Tipe Bansos</span>
  				</a>
  			</li>
  			<li class="nav-item" id="sidebar-penduduk">
  				<a class="nav-link <?= $this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'penduduk' ? 'active' : '';?>"
  					href="<?= site_url('master/penduduk');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Data Penduduk</span>
  				</a>
  			</li>
  			<li class="nav-item" id="sidebar-kategori">
  				<a class="nav-link <?= $this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'kategori' ? 'active' : '';?>"
  					href="<?= site_url('master/kategori');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
  						<i class="fas fa-boxes text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Data Kriteria</span>
  				</a>
  			</li>
  			<li class="nav-item" id="sidebar-kriteria">
  				<a class="nav-link <?= $this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'kriteria' ? 'active' : '';?>"
  					href="<?= site_url('master/kriteria');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
  						<i class="fas fa-clipboard-list text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Data Sub Kriteria</span>
  				</a>
  			</li>
  			<li class="nav-item mt-3">
  				<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Penilaian</h6>
  			</li>
  			<li class="nav-item" id="sidebar-penilaian">
  				<a class="nav-link <?= $this->uri->segment(1) == 'master' && $this->uri->segment(2) == 'penilaian' ? 'active' : '';?>"
  					href="<?= site_url('master/penilaian');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
  						<i class="fas fa-stamp text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Data Penilaian</span>
  				</a>
  			</li>
  			<li class="nav-item" id="sidebar-perhitungan">
  				<a class="nav-link <?= $this->uri->segment(1) == 'penilaian' && $this->uri->segment(2) == 'perhitungan' ? 'active' : '';?>"
  					href="<?= site_url('penilaian/perhitungan');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
  						<i class="fas fa-calculator text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Data Perhitungan</span>
  				</a>
  			</li>
  			<li class="nav-item" id="sidebar-hasil">
  				<a class="nav-link <?= $this->uri->segment(1) == 'penilaian' && $this->uri->segment(2) == 'hasil-akhir' ? 'active' : '';?>"
  					href="<?= site_url('penilaian/hasil-akhir');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
  						<i class="fas fa-chart-bar text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Hasil Akhir</span>
  				</a>
  			</li>
  			<li class="nav-item mt-3">
  				<h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pengaturan</h6>
  			</li>
  			<li class="nav-item" id="sidebar-pengaturan">
  				<a class="nav-link <?= $this->uri->segment(1) == 'pengaturan' ? 'active' : '';?>"
  					href="<?= site_url('pengaturan');?>">
  					<div
  						class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
  						<i class="fas fa-tools text-primary text-sm opacity-10"></i>
  					</div>
  					<span class="nav-link-text ms-1">Pengaturan</span>
  				</a>
  			</li>
  		</ul>
  	</div>
  	<div class="sidenav-footer mx-3 ">
  		<div class="card card-plain shadow-none" id="sidenavCard">
  			<img class="w-50 mx-auto" src="<?= base_url();?>assets/img/illustrations/icon-documentation.svg"
  				alt="sidebar_illustration">
  			<div class="card-body text-center p-3 w-100 pt-0">
  				<div class="docs-info">
  					<h6 class="mb-0">Need help?</h6>
  					<p class="text-xs font-weight-bold mb-0">Please check our intro</p>
  				</div>
  			</div>
  		</div>
  		<button class="btn btn-dark btn-sm w-100 mb-3" onclick="tour()">Intro</button>
  	</div>
  </aside>
  <main class="main-content position-relative border-radius-lg ">
