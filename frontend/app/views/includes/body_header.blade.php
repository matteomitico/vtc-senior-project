	
	<a href="#" id="pull">Menu</a>
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left {{$title}}-nav" id="cbp-spmenu-s1">
		<ul>

			<li class="list-0 menu-menu"><span id="showLeft">menu {{ HTML::image('images/menu-icon.png', '', array('width' => '24', 'height' => "18")) }} </span></li>
			<li class="list-1 home-menu"><a href="{{asset('')}}home">home <img src="{{asset('')}}images/home-icon.png" width="22" height="21" alt="" /></a></li>
			<li class="list-2 about-menu"><a href="{{asset('')}}about">about us <img src="{{asset('')}}images/about-icon.png" width="24" height="23" alt="" /></a></li>
			<li class="list-3 products-menu"><a href="{{asset('')}}products">products <img src="{{asset('')}}images/products-icon.png" width="25" height="24" alt="" /></a></li>
			<li class="list-4 support-menu"><a href="{{asset('')}}support">support <img src="{{asset('')}}images/blog-icon.png" width="21" height="21" alt="" /></a></li>
			<li class="list-5 contact-menu"><a href="{{asset('')}}contact">contact us <img src="{{asset('')}}images/contact-us-icon.png" width="27" height="18" alt="" /></a></li>
			<li class="list-6 account-menu"><a href="{{asset('')}}account">my account <img src="{{asset('')}}images/portfolio-icon.png" width="24" height="24" alt="" /></a></li>
			@if (Auth::check() )
				<li class="list-7 profile-menu">
					<a href="{{asset('')}}profile">my profile 
						<img src="{{asset('')}}images/profile-icon.png" width="24" height="24" alt="" />
					</a>
				</li>
				<li class="list-8 vm-menu">
					<a href="{{asset('')}}vm/show">VMs <img src="{{asset('')}}images/vm-icon.png" width="24" height="24" alt="" /></a>
				</li>
				<li class="list-9 logout-menu"><a href="{{asset('')}}auth/logout">Logout <img src="{{asset('')}}images/logout-icon.png" width="24" height="24" alt="" /></a>
				</li>
			@endif
			
		</ul>
	</nav>
	
	<div id="banner">
		<img src="{{asset('images/about-us-img.jpg')}}" width="1430" height="385" alt="" />
	</div>

<?php
/*home => home
about us => about
services => products 
blog => support 
contact us => contact
account => portfolio*/ ?>