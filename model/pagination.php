<?php

class pagination
{
    public function showPagination($currentPage, $totalPages, $requests=NULL, $file) {        
        $adjacents = 3;
        if(!empty($requests))
        $requests=  http_build_query($requests);// chuyển về dang get trên url;
        $targetpage = $file."?".$requests; //link request lại;
        $limit =PER_PAGE;// Số dòng hiên thị
        $page = $currentPage;
        // Tạo $start để bắt đầu limit;
        if($page) 
            $start = ($page - 1) * $limit;
        else
            $start = 0;

        if ($page == 0) $page = 1;					//if no page var is given, default to 1.
            $prev = $page - 1;							//previous page is page - 1
            $next = $page + 1;							//next page is page + 1
            $lastpage = ceil($totalPages/$limit);		//lastpage is = total pages / items per page, rounded up.
            $lpm1 = $lastpage - 1;						//last page minus 1

        $pagination = "";// Tao biến để nối chuổi HTML;
        
        if($lastpage > 1)
        {	
            $pagination .= "<div class=\"pagination\">";
            //previous button
            if ($page > 1) {
                $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$prev\"><span>&Lt; Prev </span> </a>";
                $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=1\"><span>First </span> </a>";
            }
            else
                $pagination.= "<span class=\"disabled\">Prev </span>";	               
            //pages	
            if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
            {	
                for ($counter = 1; $counter <= $lastpage; $counter++)
                {
                    if ($counter == $page)
                        $pagination.= " <span class=\"current\">$counter</span>";
                    else
                        $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$counter\"><span>$counter</span></a>";					
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
                            $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$counter\"><span>$counter</span></a>";					
                    }
//                    $pagination.= "...";
//                    $pagination.= "  <a style=\"text-decoration: none\"  href=\"$targetpage&page=$lpm1\">$lpm1</a>";
//                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
                }
                //in middle; hide some front and some back
                elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
                {
//                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=1\">1</a>";
//                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=2\">2</a>";
//                    $pagination.= "...";
                    for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= "<span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$counter\"><span>$counter</span></a>";					
                    }
//                    $pagination.= "...";
//                    $pagination.= " <a style=\"text-decoration: none\"  href=\"$targetpage&page=$lpm1\">$lpm1</a>";
//                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
                }
                //close to end; only hide early pages
                else
                {
//                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=1\">1</a>";
//                    $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=2\">2</a>";
//                    $pagination.= "...";
                    for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page)
                            $pagination.= " <span class=\"current\">$counter</span>";
                        else
                            $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=$counter\"><span>$counter</span></a>";					
                    }
                }
            }

            //next button
            if ($page < $counter - 1) {
                $pagination.= "<a style=\"text-decoration: none\"  href=\"$targetpage&page=".(int) ($lastpage)."\"><span>Last </span> </a>";
                $pagination.= " <a style=\"text-decoration: none\"  href=\"$targetpage&page=$next\"><span>Next &Gt;</span></a>";
      
            }
            else
                $pagination.= " <span class=\"disabled\">Next</span>";
            $pagination.= "</div>\n";		
        }

        return $pagination;
    }
}