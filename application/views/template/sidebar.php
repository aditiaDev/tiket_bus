<!-- Sidebar Menu -->
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          
          <li class="nav-item">
            <a href="<?php echo base_url("home")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="HOME" OR $this->uri->segment(1)==""){echo 'active';}?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <?php 
            if($this->session->userdata('level') == "SEKERTARIS"){
          ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url("user/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="USER"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("jenis_bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="JENIS_BUS"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("kategori_bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KATEGORI_BUS"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="BUS"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("jadwal_tiket/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="JADWAL_TIKET"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Tiket Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("parameter_kepuasan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PARAMETER_KEPUASAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Parameter Kepuasan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("kategori_nilai/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KATEGORI_NILAI"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Parameter Penilaian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("pelanggan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PELANGGAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url("kepuasan/")?>" class="nav-link">
              <i class="nav-icon fas fa-receipt"></i>
              <p>
                Kepuasan Pelanggan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url("login/logout")?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>

          <?php }elseif($this->session->userdata('level') == "ADMIN"){ ?>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url("pelanggan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PELANGGAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php echo base_url("penjualan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PENJUALAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Tiket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("pembayaran/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMBAYARAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembayaran Tiket</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url("jadwal_tiket/cektiket")?>" class="nav-link">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Cek Tiket
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url("login/logout")?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>

          <?php }else{ ?>

          <li class="nav-item">
            <a href="<?php echo base_url("report/pelanggan")?>" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Data Pelanggan
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-print"></i>
              <p>
                Laporan
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?php echo base_url("report/pelanggan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PELANGGAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("report/pemesanan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMESANAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pemesanan Tiket</p>
                </a>
              </li>
              <li class="nav-item">
              <a href="<?php echo base_url("report/kepuasan")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KEPUASAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kepuasan Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("report/kepuasanPeriod")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KEPUASAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kepuasan Pelanggan Period</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url("login/logout")?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li>

          <?php } ?>

          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url("jenis_bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="JENIS_BUS"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jenis Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("bus/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="BUS"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("jadwal_tiket/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="JADWAL_TIKET"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Tiket Bus</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("parameter_kepuasan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PARAMETER_KEPUASAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Parameter Kepuasan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("kategori_nilai/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="KATEGORI_NILAI"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori Nilai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("pelanggan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PELANGGAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pelanggan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("user/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="USER"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Data Transaksi
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="<?php echo base_url("penjualan/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PENJUALAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Penjualan Tiket</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("pembayaran/")?>" class="nav-link <?php if(strtoupper($this->uri->segment(1))=="PEMBAYARAN"){echo 'active';}?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pembayaran Tiket</p>
                </a>
              </li>
              
            </ul>
          </li>

          

          <li class="nav-item">
            <a href="<?php echo base_url("login/logout")?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Sign Out
              </p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>