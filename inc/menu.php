<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



<li class="nav-item menu-is-opening menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon"><img src="account.png" style="width: 32px;"></i>
              <p>
                Accounts
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
                  <p>Edit Profile</p>
                </a>
              </li>
	



              <li class="nav-item">
                <a href="index.php?pages=bosshunt" class="nav-link">
                  <i class="nav-icon"><img src="bosshunt.png" style="width: 32px;"></i>
                  <p>Boss Hunt</p>
                </a>
              </li>	


	
              <li class="nav-item">
                <a href="index.php?pages=leaderboard" class="nav-link">
                  <i class="nav-icon"><img src="leaderboard.png" style="width: 32px;"></i>
                  <p>Leaderboard</p>
                </a>
              </li>			  
			  
			  

              <li class="nav-item">
                <a href="index.php?pages=guide" class="nav-link">
                  <i class="nav-icon"><img src="guide.png" style="width: 32px;"></i>
                  <p>Guides / Announcement</p>
                </a>
              </li>			  
			  
              <li class="nav-item">
                <a href="index.php?pages=withdrawhistory" class="nav-link">
                  <i class="nav-icon"><img src="coin2.png" style="width: 32px;"></i>
                  <p>Withdrawal History</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=shop" class="nav-link">
                  <i class="nav-icon"><img src="market.png" style="width: 32px;"></i>
                  <p>Item Shop</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=market" class="nav-link">
                  <i class="nav-icon"><img src="shop.png" style="width: 32px;"></i>
                  <p>Marketplace</p>
                </a>
              </li>



              <li class="nav-item">
                <a href="index.php?pages=useitems" class="nav-link">
                  <i class="nav-icon"><img src="upgrade.png" style="width: 32px;"></i>
                  <p>Upgrade Fighters</p>
                </a>
              </li>
			  
              <li class="nav-item">
                <a href="index.php?pages=catch" class="nav-link">
                  <i class="nav-icon"><img src="catch.png" style="width: 32px;"></i>
                  <p>Hire a Fighter</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=pokemon" class="nav-link">
                  <i class="nav-icon"><img src="pokemon.png" style="width: 32px;"></i>
                  <p>My Fighters</p>
                </a>
              </li>







              <li class="nav-item">
                <a href="index.php?pages=pokebattle" class="nav-link">
                  <i class="nav-icon"><img src="battle.png" style="width: 32px;"></i>
                  <p>My Battles</p>
                </a>
              </li>



           </ul>
</li>
          <li class="nav-item">
            <a href="index.php?pages=withdrawrequest" class="nav-link">
              <i class="nav-icon"><img src="coin.png" style="width: 32px;"></i>
              <p>
                Request Withdraw
              </p>
            </a>
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
                <a href="index.php?pages=boss" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bosses</p>
                </a>
              </li>			  
			  
			  
              <li class="nav-item">
                <a href="index.php?pages=items" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Items</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?pages=emblem" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Emblem</p>
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
                <a href="index.php?pages=payments" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=bonuses" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bonuses</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=cms" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CMS Pages</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?pages=betakey" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Beta Keys</p>
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