<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
    <?php
        $ads = Advertisement::wherePosition('ads-2')->first();
        if(count($ads)){
            echo $ads['content'];
        }
    ?>
</div>