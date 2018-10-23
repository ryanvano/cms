<ul class="pagination">
    <?php
    $pageName = basename($_SERVER['PHP_SELF']);
    if(isset($_GET['u_id'])){
        $end = "&u_id=" . $_GET['u_id'];
    } elseif (isset($_GET['category'])){
        $end = "&category=" . $_GET['category'];;
    } else {$end="";}
    
        if($page == 1){
            $previousPage=1;
            $nextPage=1;
            if($page<>$pageCount){
                $nextPage = $page +1;
            }
        } elseif ($page == $pageCount){
            $nextPage = $page;
            $previousPage=$page-1;

        } else {
            $previousPage=$page-1;
            $nextPage=$page+1;
        }
    if($previousPage <> $page){
        echo "<li class='page-item'><a href='index.php?page={$previousPage}'><i class='fas fa-angle-double-left'></i></a></li>";
    } 
    for($i = 1; $i <= $pageCount; $i++){
        if($i == $page) {
            echo "<li class='page-item active'><a href='{$pageName}?page={$i}'>{$i}</a></li>";
        } else {
            echo "<li class='page-item'><a href='{$pageName}?page={$i}{$end}'>{$i}</a></li>";
        }
    }
    if($nextPage <> $page && $pageCount <> 0){
        echo "<li class='page-item'><a href='{$pageName}?page={$nextPage}'><i class='fas fa-angle-double-right'></i></a></li>";
    }

    ?>
</ul>