<?php require 'functions/header.php'; ?>

        
        <div class="container mt-3" >
            <div class="row g-2">
                <div class="col-8 gv-3 px-4">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <p>   美濃湖原名瀰濃湖、中圳湖、中正湖，興建於西元1748年，湖面積達21公頃，是僅次於澄清湖的高雄市第二大人工湖。
                        西北背山、三面環田，湖光山色、景色秀麗，美濃湖全區沿著湖畔設有環湖步道及自行車道，遊客喜歡來此輕騎、散步或垂釣，中正湖旅遊服務中心提供出租單車。</p>
                        <p>   美濃湖東側規劃栽種紅花鐵刀木、落羽杉、水柳、鳳凰木及苦楝等喬木，以及開花性灌木及水生植物，讓美濃湖除了美景，還多了分生態教育功能。</p>
                        <div class="carousel-inner">
                            <!-- image slide from folder w/ php -->
                            <?php
                                $dir = "images/";
                                $images =  glob($dir . "*.{JPG,jpg,gif,png,bmp}" , GLOB_BRACE);
                                $length = count($images);
                                $flag = 0; # The flag is used to identify if it's the 1st image or not
                                foreach ($images as $image) {
                                    #echo $image;
                                    $class='';
                                    if ($flag == 0) { $class='active'; }
                                    #echo '<div class="carousel-item' .($flag?' active':''). '">';
                                    echo '<div class="carousel-item ' .$class. '">';
                                    echo '<img src="' .$image. '" class="d-block w-100" alt=""></div>';
                                    $flag++; 
                                }
                            ?>
                                    
                        </div>
                           
                        <!-- next/prev control -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <!-- Sidebar section-->
                <div class="col-4 gv-3 px-4">
                    <h4>News Feed</h4>
                    <?php require 'functions/rss.php';
                    $rss = 'data/recent-opeds.rss';
                    show_title('data/rr.rss');
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
