<?php use App\Libraries\KdLib; ?>
<li class="menu-title"><span data-key="t-menu">Menu</span></li>
{{ kdLib::getMenu((!empty(Auth::user()->id) ? Auth::user()->id : 0))}}
