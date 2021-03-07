<?php
include_once '../model/ym_app_pages.php';;
class pagination
{
    public function display($currentPage, $totalPages, $requests, $file)
    {        
        // How many adjacent pages should be shown on each side?
        $adjacents = 3;
      
        /* Setup vars for query. */
        $targetpage = $file."?".$requests; 	//your file name  (the name of this file)
        $limit = Ym_App_Pages::LIMIT_PER_PAGE; 								//how many items to show per page
        $page = $currentPage;
        if($page) 
            $start = ($page - 1) * $limit; 			//first item to display on this page
        else
            $start = 0;								//if no page var is given, set start to 0

        /* Get data. */
        //$sql = "SELECT column_name FROM $tbl_name LIMIT $start, $limit";
        

        /* Setup page vars for display. */
        if ($page == 0) $page = 1;					//if no page var is given, default to 1.
        $prev = $page - 1;							//previous page is page - 1
        $next = $page + 1;							//next page is page + 1
        $lastpage = ceil($totalPages/$limit);		//lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1;						//last page minus 1

        /* 
            Now we apply our rules and draw the pagination object. 
            We're actually saving the code to a variable in case we want to draw it more than once.
        */
        $pagination = "";
        if($lastpage > 1)
        {	
            $pagination .= "<div class=\"pagination\">";
            //previous button
            if ($page > 1) 
                $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$prev\">Prev </a>";
            else
                $pagination.= "<span class=\"disabled\">Prev </span>";	

            //pages	
            if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
            {	
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= " - <span class=\"current\">$counter</span>";
                    else
                        $pagination.= " - <a style=\"text-decoration: none\"  href=\"$targetpage&page=$counter\">$counter</a>";					
                }
            }
            elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
            {
                //close to beginning; only hide later pages
                if($page < 1 + ($adjacents * 2))		
                {
                    for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$counter\">$counter</a>";					
                    }
                    $pagination.= "...";
                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
                }
                //in middle; hide some front and some back
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=1\">1</a>";
                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=2\">2</a>";
                    $pagination.= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$counter\">$counter</a>";					
                    }
                    $pagination.= "...";
                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$lpm1\">$lpm1</a>";
                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
                }
                //close to end; only hide early pages
                else
                {
                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=1\">1</a>";
                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=2\">2</a>";
                    $pagination.= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$counter\">$counter</a>";					
                    }
                }
            }

            //next button
            if ($page < $counter - 1) 
                $pagination.= " <a style=\"text-decoration: none\"  href=\"$targetpage&page=$next\">Next</a>";
            else
                $pagination.= " <span class=\"disabled\">Next</span>";
            $pagination.= "</div>\n";		
        }

        return $pagination;
    }
}