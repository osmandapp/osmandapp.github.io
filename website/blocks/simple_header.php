<div class="simpleheader">
	<div class="shadowline">
		<div class="shadowlinecontent">
			<div class="headerlogo"></div>	
	<ul class="menu">
	  <li><a data-gatag="header_home" href="http://osmand.net">HOME</a></li>
	  <li class="<?php if($simpleheader_header == FEATURES) echo activeitem?>">
	  	<a data-gatag="header_features" href="http://osmand.net/features">FEATURES</a>
	  </li>		
	  <li class="<?php if($simpleheader_header == BLOG) echo activeitem?>">
	  	<a data-gatag="header_blog" href="http://osmand.net/blog">BLOG</a>
	  </li>
	  <li class="<?php if($simpleheader_header == HELP) echo activeitem?>">
	  	<a data-gatag="header_help" href="http://osmand.net/help-online">HELP</a>
	  </li>		
	  <li><a data-gatag="header_dvr" href="http://dvr.osmand.net">DVR</a></li>	  
	</ul>
	<div class="clear"></div>
	</div>
	</div>	 
    <div class="headercontent">
		<div class="headertext"><?php echo $simpleheader_header ?></div>
	</div>	
</div> 