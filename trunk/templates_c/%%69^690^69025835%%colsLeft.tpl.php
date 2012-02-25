<?php /* Smarty version 2.6.10, created on 2012-02-25 11:24:52
         compiled from D:/AppServ/www/projects/templates/shopping/colsLeft.tpl */ ?>
<div class="left-column">
	<div class="sidebox-categories-wrapper ">
	<h3 class="sidebox-title"><span>Danh mục sản phẩm</span></h3>
					<div class="sidebox-body">
				
				<div class="clear">
					<?php echo $this->_tpl_vars['showMenuLeft']; ?>

					<ul id="vmenu_8" class="dropdown dropdown-vertical">
						<?php unset($this->_sections['loops']);
$this->_sections['loops']['name'] = 'loops';
$this->_sections['loops']['loop'] = is_array($_loop=$this->_tpl_vars['lsMenuLeft']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loops']['show'] = true;
$this->_sections['loops']['max'] = $this->_sections['loops']['loop'];
$this->_sections['loops']['step'] = 1;
$this->_sections['loops']['start'] = $this->_sections['loops']['step'] > 0 ? 0 : $this->_sections['loops']['loop']-1;
if ($this->_sections['loops']['show']) {
    $this->_sections['loops']['total'] = $this->_sections['loops']['loop'];
    if ($this->_sections['loops']['total'] == 0)
        $this->_sections['loops']['show'] = false;
} else
    $this->_sections['loops']['total'] = 0;
if ($this->_sections['loops']['show']):

            for ($this->_sections['loops']['index'] = $this->_sections['loops']['start'], $this->_sections['loops']['iteration'] = 1;
                 $this->_sections['loops']['iteration'] <= $this->_sections['loops']['total'];
                 $this->_sections['loops']['index'] += $this->_sections['loops']['step'], $this->_sections['loops']['iteration']++):
$this->_sections['loops']['rownum'] = $this->_sections['loops']['iteration'];
$this->_sections['loops']['index_prev'] = $this->_sections['loops']['index'] - $this->_sections['loops']['step'];
$this->_sections['loops']['index_next'] = $this->_sections['loops']['index'] + $this->_sections['loops']['step'];
$this->_sections['loops']['first']      = ($this->_sections['loops']['iteration'] == 1);
$this->_sections['loops']['last']       = ($this->_sections['loops']['iteration'] == $this->_sections['loops']['total']);
?>
						<li class="dir">
							<ul>
								<li><a href="index.php?dispatch=categories.view&amp;category_id=152">sadsadasdsa</a></li>
								<li class="h-sep">&nbsp;</li>
								<li><a href="index.php?dispatch=categories.view&amp;category_id=153">Nhóm sản phẩm con</a></li>
							</ul>
							<a href="index.php?dispatch=categories.view&amp;category_id=93"><?php echo $this->_tpl_vars['lsMenuLeft'][$this->_sections['loops']['index']]['name']; ?>
</a>
						</li>
						<li class="h-sep">&nbsp;</li>
						<?php endfor; endif; ?>
					</ul>
				
				</div></div>
					<div class="sidebox-bottom"><span>&nbsp;</span></div>
				</div><div class="sidebox-wrapper ">
					<h3 class="sidebox-title"><span>Mua sắm tùy chọn</span></h3>
					<div class="sidebox-body">
					
				
				
				
				<h4>Giá</h4>
				<ul class="product-filters" id="content_product_more_filters_20_1">
					<li >
						<a href="index.php?dispatch=products.search&amp;features_hash=P1" rel="nofollow">$0.00 - $50.00</a>&nbsp;<span class="details">&nbsp;(51)</span>
				
					</li>
					<li >
						<a href="index.php?dispatch=products.search&amp;features_hash=P2" rel="nofollow">$50.00 - $100.00</a>&nbsp;<span class="details">&nbsp;(18)</span>
					</li>
					<li >
						<a href="index.php?dispatch=products.search&amp;features_hash=P3" rel="nofollow">$100.00 - $150.00</a>&nbsp;<span class="details">&nbsp;(8)</span>
					</li>
				
				
				
				<li class="delim">&nbsp;</li>
				
				</ul>
				
				
				<h4>Nhà sản xuất</h4>
				<ul class="product-filters" id="content_product_more_filters_20_2">
					<li >
						<a href="index.php?dispatch=product_features.view&amp;variant_id=10">Adidas</a>&nbsp;<span class="details">&nbsp;(8)</span>
				
					</li>
					<li >
						<a href="index.php?dispatch=product_features.view&amp;variant_id=11">Nike</a>&nbsp;<span class="details">&nbsp;(4)</span>
					</li>
					<li >
						<a href="index.php?dispatch=product_features.view&amp;variant_id=12">Reebok</a>&nbsp;<span class="details">&nbsp;(3)</span>
					</li>
				
					<li >
						<a href="index.php?dispatch=product_features.view&amp;variant_id=13">Sony</a>&nbsp;<span class="details">&nbsp;(4)</span>
					</li>
					<li class="hidden">
						<a href="index.php?dispatch=product_features.view&amp;variant_id=14">Nokia</a>&nbsp;<span class="details">&nbsp;(2)</span>
					</li>
					<li class="hidden">
				
						<a href="index.php?dispatch=product_features.view&amp;variant_id=15">Sanyo</a>&nbsp;<span class="details">&nbsp;(3)</span>
					</li>
					<li class="hidden">
						<a href="index.php?dispatch=product_features.view&amp;variant_id=16">palmOne</a>&nbsp;<span class="details">&nbsp;(4)</span>
					</li>
					<li class="hidden">
						<a href="index.php?dispatch=product_features.view&amp;variant_id=17">Panasonic</a>&nbsp;<span class="details">&nbsp;(3)</span>
				
					</li>
					<li class="hidden">
						<a href="index.php?dispatch=product_features.view&amp;variant_id=18">Toshiba</a>&nbsp;<span class="details">&nbsp;(2)</span>
					</li>
				
					<li class="right">
						<a onclick="$('#content_product_more_filters_20_2 li').show(); $('#view_all_20_2').show(); $(this).hide(); return false;" class="extra-link">Tìm thêm</a>
					</li>
				
				
				<li class="delim">&nbsp;</li>
				
				</ul>
				
				<div class="clear filters-tools">
					<div class="float-right"><a href="index.php?dispatch=products.search&amp;advanced_filter=Y" rel="nofollow" class="secondary-link lowercase">Tìm nâng cao</a></div>
					</div>
				</div>
					<div class="sidebox-bottom"><span>&nbsp;</span></div>
	</div>
</div>