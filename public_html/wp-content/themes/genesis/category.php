<?php

/**

 * Template Name: Category

 */
remove_action('genesis_loop', 'genesis_do_loop'); // Remove default loop
//add_action('genesis_post_content','the_content');  // Adds your custom page code/content before loop

add_action('genesis_loop', 'category_page'); // Do custom loop

function category_page() {

    //add_action('genesis_loop', 'genesis_standard_loop');

    echo '<div class="entry-content">';

    child_grid_loop_helper();


    echo '</div><!-- end .entry-content -->';
}

function child_grid_loop_helper() {

    $categories = get_categories();

    // $id_Category =  the_category_ID( $echo = false);
    // echo get_site_url();
    // print_r(get_queried_object());
    // lay id cua category
    $id_Category = get_queried_object()->term_id;

    if (is_category()) {
//        echo '<div class="home-categorys">';
//        // $j=0;
//        //get sub category

//        
//        foreach ($categories as $cat) {
//
//            $category_ids = $cat->term_id; 
//
//            if ($category_ids == $id_Category) {
//
//                $category_num = $cat->category_count;
//
//                $category_link = get_category_link($category_ids);
//
//                echo '<div id="home-category">';
//                echo '<ul id="item-category">';
//
//                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
//                $args = array('category__in' => $category_ids, 'paged' => $paged, 'posts_per_page' => 12);
//                // 'category_name='.$catname.'&showposts=5'.'&paged='.$paged
//                $my_query = new wp_query($args);
//
//                $e = 0;
//
//                echo '<div class="category_Right">';
//
//                while ($my_query->have_posts()) {
//
//                    $my_query->the_post();
//                    if ($e == 1) {
//                        
//                    } else {
//
//                        echo '<li><div class="cate-titlerest"><h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2><div class="cate-imgthumb"><a href="' . get_permalink() . '">';
//                        thumb_img($post->ID, '290', '410', '100', get_the_title());
//
//                        echo '</a></div><div class="cate-des2">' . get_the_excerpt() . '</div></div></li>';
//                    }
//                }
//
//                echo '</div> </ul>';
//                // wp_pagenavi();
//                // wp_paginate();
//                echo '</div>';
//            }
//        }
//        wp_paginate();
//        echo '</div>';
//        list_library(5);
//        slider_post(5);
//        slider_post(6);
//        slider_post(24);
//        slider_post(11);
//        slider_post(20);
//    }
        echo '<div class="rt-container">
            <!----start grid -8 -->
            <div class="rt-grid-8">
                <div id="rt-content-bottom">
                    <div class="rt-grid-8 rt-alpha rt-omega">
                        <div class="tabs">
                            <div class="rt-block">
                                <div id="k2ModuleBox94" class="k2ItemsBlock tabs">
                                    <div id="tabs">
                                    <ul>
                                            <li><a class="moduleTabTitle" href="#tab-0">'.get_the_category_by_id($id_Category).'</a></li>

                                        </ul> <div id="tab-0" class="even">
                                            <div class="moduleItemIntrotext" style="margin-left: 20px;">';
            getsubcategory($id_Category);
        echo '<div style="margin-bottom:10px" class="clearfix"><hr color="#999999" width="94%" size="1" align="center" style="margin-top: 10px; margin-bottom: 10px; margin-left: -1px;"></div>';
            getpost($id_Category,$categories);
        echo '</div></div></div></div></div></div></div></div></div></div>';
         list_library();
         echo '<div id="footer">
    <div class="footer-container">
    <div id="rt-footer">
        <div class="rt-container">    ';
        slider_post_thietkenoithat(6);
        slider_post_thietkebietthu(5);
        slider_post_thietkenhapho(7);
        slider_post_thietkevanphongkhachsan(8);
        slider_post_thietkecongtrinhduan(4);
        echo '</div></div></div></div>';
    }
}
function getpost($id_Category,$categories){
//    foreach ($categories as $cat) {
//            $category_ids = $cat->term_id; 
//            var_dump($id_Category);
//            die();
//            if ($category_ids == $id_Category) {
                $category_ids = $id_Category;
                if ($category_ids) {
//                $category_num = $cat->category_count;
                $category_link = get_category_link($category_ids);
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array('category__in' => $category_ids, 'paged' => $paged, 'posts_per_page' => 10);
                $my_query = new wp_query($args);
                $count = 0;
//                $countpost = 0;
                while ($my_query->have_posts()) {
                    $my_query->the_post();
//                    $e = 0;
//                    if ($e == 0) {
                         echo '<div class="project1"><a rel="dofollow" title="' . get_the_title() . '" class="ititle" href="' . get_permalink() . '">' . get_the_title() . '</a><a title="' . get_the_title() . '" href="' . get_permalink() .  '">';thumb_img($post->ID, '290', '410', '100', get_the_title());echo '</a><div class="introtext" style="width:100%"><p style="font: 13px Arial;">
                                                <span style="color:#696969;"></span><em>' . get_the_excerpt() . '<em></em></p>
                                            </div></div>';
                         $count++;
                         if($count==2){
                             echo '<div style="clear:both;margin:5x;height:20px;widht:700px" color="#999999" /></div>';
                             $count = 0;
                         }
//                    }
//                    $countpost++;
//                    if($countpost ==10){
//                        $countpost = 0;
//                        break;
//                    }
                }
            }
    
//    }
   wp_paginate();
}
function getsubcategory($id) {
//    $categoriessub = get_categories('child_of=' . $id . '&hide_empty=0');
//    foreach ($categoriessub as $categorysub) {
//        echo '<div id="home-category">';
////        echo '<ul id="item-category">';
//        echo '<div class="category_Right">';
//        echo '<div class="title-category"><h2><a href="' . get_category_link($categorysub->term_id) . '">' . $categorysub->name . '</a></h2><div class="cate-imgthumb"><a href="' . get_category_link($categorysub->term_id). '">';
//        if(z_taxonomy_image_url($categorysub->term_id)!=""){
//            echo '<img src="'.z_taxonomy_image_url($categorysub->term_id,array(257, 181)).'" />';
//        }else{
//            echo '<img src="'.z_taxonomy_image_url(9).'"/>';
//        }
//        echo '</a></div></div></li>';
//        echo '</div></ul></div>';
//    }
//    // if (function_exists('z_taxonomy_image'))
//    //           {
//    //             z_taxonomy_image();
//    //           } 
//    echo '<hr>';
    
    $categoriessub = get_categories('child_of=' . $id . '&hide_empty=0');
    $count = 0;
    foreach ($categoriessub as $categorysub) {
         echo '<div class="project1">
         <div ><a class="ititle1" href="' . get_category_link($categorysub->term_id) . '" title="' . $categorysub->name . '"> ' . $categorysub->name . '</a></div>
             ';
         if(z_taxonomy_image_url($categorysub->term_id)!=""){
echo '<a class="image" href="' . get_category_link($categorysub->term_id) . '" title=" ' . $categorysub->name . '"><img src="'.z_taxonomy_image_url($categorysub->term_id,array(257, 181)).'" title=" ' . $categorysub->name . '"  alt="' . $categorysub->name . '"/></a>
         '; }else{
echo '<a class="image" href="' . get_category_link($categorysub->term_id) . '" title=" ' . $categorysub->name . '"><img src="'.z_taxonomy_image_url(9).'" title=" ' . $categorysub->name . '"  alt="' . $categorysub->name . '"/></a>            
         ';}        
echo '</div>';
$count++;
if($count==2){
    echo '<div style="width:100%;clear:both;height:1px;"></div>';
    $count = 0;
}
    }
}

genesis();
