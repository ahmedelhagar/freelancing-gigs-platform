<?php header('Content-type: text/xml'); ?>
<?= '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?= base_url();?></loc> 
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?= base_url().'pages/windows' ;?></loc> 
        <priority>0.5</priority>
    </url>
    <url>
        <loc><?= base_url().'pages/android' ;?></loc> 
        <priority>0.5</priority>
    </url>
    <url>
        <loc><?= base_url().'pages/games' ;?></loc> 
        <priority>0.5</priority>
    </url>
    <url>
        <loc><?= base_url().'pages/posts' ;?></loc> 
        <priority>0.5</priority>
    </url>
    <?php if($records){foreach($records as $url) { ?>
    <url>
        <loc>
        <?php 
                          if($url->v_link !== ''){
                              $url_l =$url->v_link;
                          }  else {
                              $url_l =$url->id;
                          }
                          echo base_url().'i/'.$url_l;
                          ?>
        </loc>
        <priority>0.5</priority>
    </url>
    <?php }} ?>
</urlset>