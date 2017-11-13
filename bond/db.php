<div id="errordiv">
</div>
<!-- start page -->
<div id="page" >
<div id="content">
		
		<div class="post">
			<h1 class="title">University Bonds Search </h1>	

			<div class="form-inline" >

				<div class="form-group">
				  <label >State:</label>
				  <?php echo $state_select_html;?>
				  
				</div>
				<div class="form-group">
				  <label >College:</label>
				  <input type="search" class="form-control" id="i_college" onkeydown="search_enter(event);" placeholder="Enter College" />
				</div>
				<button class="btn btn-default" id="i_click" onclick="search_grid();"><span class="glyphicon glyphicon-search"></span>Search</button>
			</div>

			<div style="clear:both;margin-bottom:10px;"></div>



			<table id="jqGrid"></table>
		    <div id="jqGridPager"></div>	
			
			<div class="emma_link" >
				<a href="http://emma.msrb.org/Home/Index"  style="color:#7BAA0F;text-decoration:underline;padding: 0 20px 0 18px;background: url(./contents/images/img06.gif) no-repeat left center;" >Go EMMA - Electronic Municipal Market Access</a>
			</div>
		</div>
</div>