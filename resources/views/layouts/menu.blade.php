
<div class="polished-sidebar bg-light col-12 col-md-3 col-lg-2 p0 collapse d-md-inline" id="sidebar-nav">
	<ul class="polished-sidebar-menu ml-0 pt-4 p-0 d-md-block">
		<input class="border-dark form-control form-control-sm d-block  mb-4" type="text" placeholder="Search" aria-label="Search"/>
		<li>
			<a href="{{ route('home') }}"><span class="oi oi-home"></span>Home</a>
		</li>
		<li>
			<a href="/users"><span class="fas fa-user"></span>User</a>
		</li>
		<li>
			<a href="/category"><span class="fas fa-list"></span>Category</a>
		</li>
		<li>
			<a href="/book"><span class="fas fa-book"></span>Buku</a>
		</li>
		<div class="d-block d-md-none">
			<div class="dropdown-divider"></div>
			<li><a href="#">Profile</a></li>
			<li><a href="#">Setting</a></li>
			<li>
				<form action="{{route("logout")}}" method="POST">
					@csrf
					<button class="dropdown-item" style="cursor:pointer">Sign Out</button>
				</form>
			</li>
		</div>
	</ul>
	<div class="pl-3 d-none d-md-block position-fixed" style="bottom: 0px">
		<span class="oi oi-cog"></span> Setting
	</div>
</div>