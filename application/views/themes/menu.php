<nav id="mainmenu" class="menu">
    <ul>
        <li <?php if($k == 1)echo 'class="current-menu-item"'; ?>><a href="/">Home</a></li>
        <li <?php if($k == 11 || $k == 12)echo 'class="current-menu-item"'; ?>><a href="#">Products</a>
            <ul>
                <li <?php if($k == 12)echo 'class="current-menu-item"'; ?>><a href="/products">In-Gym Solution</a></li>
             </ul>
        <li <?php if($k == 2 || $k == 3 || $k == 4)echo 'class="current-menu-item"'; ?>><a href="#">About</a>
            <ul>
                <li <?php if($k == 2)echo 'class="current-menu-item"'; ?>><a href="/energy">Renewable Energy</a></li>
                <li <?php if($k == 3)echo 'class="current-menu-item"'; ?>><a href="/social">Social Media</a></li>

            </ul>
        </li>
        <li <?php if($k == 5)echo 'class="current-menu-item"'; ?>><a href="/team">Management Team</a></li>
        <!--<li <?php if($k == 15)echo 'class="current-menu-item"'; ?>><a href="/blog">Blog</a></li>-->
        <li <?php if($k == 6)echo 'class="current-menu-item"'; ?>><a href="/contactus">Contact us</a></li>
		<li  <?php if($k == 7)echo 'class="current-menu-item"'; ?>><a href="/blog">Blog</a>					
        <li><a href="/members">Login</a></li>
    </ul>
</nav>
