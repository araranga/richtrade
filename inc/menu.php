<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

     	  
			  
<li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon"><i class="fas fa-lock nav-icon"></i></i>
              <p>
                My Profile
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?pages=changepass" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=editprofile" class="nav-link">
                  <i class="fas fa-address-card nav-icon"></i>
                  <p>Edit Nickname</p>
                </a>
              </li>
	  
			  
	
           </ul>

          <li class="nav-item">
            <a href="index.php?pages=withdrawrequest" class="nav-link">
               <i class="fas fa-address-card nav-icon"></i>
              <p>
                Request Withdraw
              </p>
            </a>
          </li>
	  
			  
              <li class="nav-item">
                <a href="index.php?pages=withdrawhistory" class="nav-link">
                   <i class="fas fa-address-card nav-icon"></i>
                  <p>Withdrawal History</p>
                </a>
              </li>

          <li class="nav-item">
            <a href="index.php?pages=investrequest" class="nav-link">
               <i class="fas fa-address-card nav-icon"></i>
              <p>
                Invest Now
              </p>
            </a>
          </li>

		  <li class="nav-item">
			<a href="index.php?pages=investhistory" class="nav-link">
			   <i class="fas fa-address-card nav-icon"></i>
			  <p>Investment History</p>
			</a>
		  </li>
		  
		  
		  <li class="nav-item">
			<a href="index.php?pages=exchangerequest" class="nav-link">
			   <i class="fas fa-address-card nav-icon"></i>
			  <p>Exchange Request</p>
			</a>
		  </li>
      <li class="nav-item">
      <a href="index.php?pages=exchangehistory" class="nav-link">
         <i class="fas fa-address-card nav-icon"></i>
        <p>Exchange History</p>
      </a>
      </li>		  

</li>



<?php if ($_SESSION['role']==1) { ?>

          <li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tools"></i>
              <p>
                Administration
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
             
              <li class="nav-item">
                <a href="index.php?pages=users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
			  
			  
              <li class="nav-item">
                <a href="index.php?pages=withdraw" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Withdrawals</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=exchange" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exchanges</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=cms" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CMS Pages</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="index.php?pages=system" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Configuration</p>
                </a>
              </li>
              
           </ul></li>
<?php } ?>

          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
         </ul>
      </nav>