<?php require 'functions/header.php'; ?>

        
        <div class="container mt-3" >
            <div class="row g-2">
                <div class="col-8 gv-3 px-4">
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                       <h2>Top Rated Places</h2>
                        <p>   Sed sit amet augue congue, tincidunt ligula pretium, acumin dolor ligula dolor condimentum leo. 
                              Proin vel diam sit amet orci tincidunt commodo. Nulla acumin ligula, dolor sit buncha elementum ligula.</p>
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
