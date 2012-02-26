<div class="sidebox-categories-wrapper ">
	<h3 class="sidebox-title">
	<span>Danh mục sản phẩm</span></h3>
	<div class="sidebox-body">
		<div class="clear">
			{$showMenuLeft}
			<ul id="vmenu_8" class="dropdown dropdown-vertical">
				{section name=loops loop=$lsMenuLeft}
				<li class="dir">
					<ul>
						<li><a href="index.php?dispatch=categories.view&amp;category_id=152">sadsadasdsa</a></li>
						<li class="h-sep">&nbsp;</li>
						<li><a href="index.php?dispatch=categories.view&amp;category_id=153">Nhóm sản phẩm con</a></li>
					</ul>
					<a href="index.php?dispatch=categories.view&amp;category_id=93">{$lsMenuLeft[loops].name}</a>
				</li>
				<li class="h-sep">&nbsp;</li>
				{/section}
			</ul>
		</div>
	</div>
	<div class="sidebox-bottom"><span>&nbsp;</span></div>
</div>