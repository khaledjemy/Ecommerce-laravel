<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			{{-- menu left --}}
			@include('admin.includes.menuleft')

			<!-- top navigation -->
			@include('admin.includes.topnavigation')
			<!-- /top navigation -->

            @yield('content')

            <!-- footer content -->
			@include('admin.includes.footer')
			<!-- /footer content -->
		</div>
	</div>

	@include('admin.includes.js')

</body></html>