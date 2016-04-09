<?php
    use App\Utilities\Menu;
?>

<nav class="navbar navbar-default">
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    {!!
    Menu::create(function($menu) {
        event('admin.menu.build', $menu);
    })->render();
    !!}
    </div>
</nav>