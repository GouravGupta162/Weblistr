<!--
<ul class="nav navbar-nav navbar-right" style="margin-right: 0;">
<div class="s_all hhh nav">
		   <li><div class="input-group fl_rt">
                <div class="input-group-btn search-panel">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    	<span id="search_concept">All Categories</span> <span style="color:#ef3e38; font-size:16px;" class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#contains">Contains</a></li>
                      <li><a href="#its_equal">It's equal</a></li>
                      <li><a href="#greather_than">Greather than &gt;</a></li>
                      <li><a href="#less_than">Less than &lt; </a></li>
                      <li class="divider"></li>
                      <li><a href="#all">Anything</a></li>
                    </ul>
                </div>
                <input type="text" class="form-control" name="search_txt_header" id="search_txt_header" placeholder="Search for websites">
				<input id="citygeonameid" name="citygeonameid" type="hidden">
				
				
					<ul  id="DropdownProductHeader" class="txtProduct ui-autocomplete-header"  ></ul>
				
                <span class="input-group-btn">
                    <button class="btn btn-default" id='headerSearchClick' onclick='headerSearchClick()' type="button"><span class="glyphicon glyphicon-search icon"></span></button>
                </span>
            </div></li>
            </div>
            </ul>
-->
<ul class="nav navbar-nav navbar-right">
       
         <form class="navbar-form navbar-left search-b" role="search">
        <div class="form-group">
          <input type="text" class="form-control" name="search_txt_header" autocomplete='off' id="search_txt_header" placeholder="Search for websites">
          <!--<input id="citygeonameid" name="citygeonameid" type="hidden">-->
				
<button class="btn search-b-btn" id='headerSearchClick' onClick="headerSearchClicknew();" type="button"><span class="glyphicon glyphicon-search icon"></span></button>

<!--<button class="btn search-b-btn" id='headerSearchClick' onClick='headerSearchClick()' type="button"><span class="glyphicon glyphicon-search icon"></span></button>-->
					<ul  id="DropdownProductHeader" class="txtProduct ui-autocomplete-header"  ></ul>
        </div>
        
      </form>
      
          </ul>
