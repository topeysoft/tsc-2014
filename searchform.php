<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
    <div class="input-group" >
       <!-- <label  for="search" class="sr-only"><i class="fa fa-search"></i> Search</label> -->
        <input class="form-control" placeholder="Seach here" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
        
        <span class="input-group-btn">
             <button class="btn btn-primary" type="submit" title="Search" >
             <span  class=" hidden-xs hidden-sm"><i class="fa fa-search fa-lg"></i> Search</span>
             <span  class=" hide visible-xs visible-sm"><i class="fa fa-search fa-lg"></i></span>
             </button>
             </span>
    </div>
    
</form>