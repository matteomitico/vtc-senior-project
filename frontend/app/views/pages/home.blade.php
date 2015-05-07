<!DOCTYPE html>
<html lang="en"> 
<head>
@include('includes.head')
</head>
<body class="home">
<div id="headerimgs">
	<div id="headerimg1" class="headerimg"></div>
	<div id="headerimg2" class="headerimg"></div>
</div>
<div id="wrapper">
	<header id="header">
		<!--h1 class="site-title"><a href="/"><img src="{{asset('images/logo.png')}}" width="158" height="46" alt="ULIULI LOGO" /></a></h1-->
	</header><!-- header -->
	<div id="main">	
		<a href="#" id="pull">Menu</a>
		<nav id="nav">
			<ul>
				<li class="list-1 none"><a href="{{asset('')}}about">about us</a></li>
				<li class="list-2"><a href="{{asset('')}}products">products</a></li>
				<li class="list-3"><a href="{{asset('')}}support">support</a></li>
				<li class="list-4"><a href="{{asset('')}}contact">contact</a></li>
				<li class="list-5"><a href="{{asset('')}}account">my account</a></li>
			</ul>
		</nav>
		<!-- Slideshow controls -->
		<div id="headernav-outer">	
			<div id="headernav">
				<div id="back" class="home-btn"></div>
				<div id="control" class="home-btn"></div>
				<div id="next" class="home-btn"></div>
			</div>		
			<div id="headertxt">
				<div class="caption">
					<h3 id="firstline"></h3>
					<p id="secondline"></p>
				</div>
			</div>			
		</div>
	</div><!-- #main -->
</div>
</body>
</html>