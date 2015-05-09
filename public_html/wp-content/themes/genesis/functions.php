<?php
/*

  WARNING: This file is part of the core Genesis Framework. DO NOT edit

  this file under any circumstances. Please do all modifications

  in the form of a child theme.

 */



/**

 * This file calls the init.php file, but only

 * if the child theme hasn't called it first.

 *

 * This method allows the child theme to load

 * the framework so it can use the framework

 * components immediately.

 *

 * This file is a core Genesis file and should not be edited.

 *

 * @category Genesis

 * @package  Templates

 * @author   StudioPress

 * @license  GPL-2.0+

 * @link     http://my.studiopress.com/themes/genesis

 */
require_once( dirname(__FILE__) . '/lib/init.php' );



add_action('genesis_meta', 'raynoblog_custom_home_loop');

function raynoblog_custom_home_loop() {

    if (is_home()) {
        if (is_active_sidebar('home-featured-full') || is_active_sidebar('home-middle-1') || is_active_sidebar('home-middle-2') || is_active_sidebar('home-middle-3') || is_active_sidebar('home-bottom')) {

            add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

            add_action('genesis_before_content', 'raynoblog_home_do_featured');

            add_action('genesis_before_content', 'raynoblog_home_do_middle');

            add_action('genesis_before_content', 'raynoblog_home_do_bottom');
        }
    }
}

add_action('genesis_loop', 'child_do_custom_loop');

function child_do_custom_loop() {
    if (is_home()) {
//        importcss();
        list_new_category();
        $arrayItem = array('5', '6', '24', '11', '20');
        echo '<div class="home-categorys">';
        for ($i = 0; $i < sizeof($arrayItem); $i++) {
            $category_ids = $arrayItem[$i];
            $cat = get_the_category_by_ID($category_ids);
            $category_link = get_category_link($category_ids);
            $j++;
            if ($category_ids == $arrayItem[$i]) {
                echo '<div id="home-category">';
                echo '<ul id="item-category">';
                $args = array('category__in' => $category_ids, 'showposts' => 1);
                $my_query = new wp_query($args);
                $e = 0;
                echo '<div class="categoryRight">';
                while ($my_query->have_posts()) {
                    $my_query->the_post();
                    if ($e == 1) {
                        
                    } else {
                        echo '<li><div class="title-category"><a href="' . esc_url($category_link) . '">' . $cat . '</a></div><div class="cate-titlerest"><div class="cate-imgthumb"><a href="' . get_permalink() . '">';
                        thumb_img($post->ID, '290', '410', '100', get_the_title());
                        echo '</a></div><h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2><div class="cate-des2">' . get_the_excerpt() . '</div></div></li>';
                    }
                }
                echo '</div></ul> </div>';
            }
        }
        echo '</div>';
        list_library();
        view_post_new();
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
function importcss(){
    echo ' <style type="text/css">
        body{background:#f8f8f8;}
        #rt-header{background:transparent;}
        #rt-header .rt-container{background:transparent;}
        #rt-showcase{background:transparent;}
        #rt-showcase .rt-container{background:transparent;}
        #rt-feature{background:transparent;}
        #rt-feature .rt-container{background:transparent;}
        #rt-utility{background:transparent;}
        #rt-utility .rt-container{background:transparent;}
        #rt-maintop{background:transparent;}
        #rt-maintop .rt-container{background:transparent;}
        #rt-main{background:transparent;}
        #rt-main .rt-container{background:transparent;}
        #rt-mainbottom{background:transparent;}
        #rt-mainbottom .rt-container{background:transparent;}
        #rt-bottom{background:transparent;}
        #rt-bottom .rt-container{background:transparent;}
        body a{color:#505050;}
        body a:hover{color:#61AE20;}
        a.moduleItemReadMore,a.k2ReadMore{color:#ffffff;background:#303030;}
        a.moduleItemReadMore:hover,a.k2ReadMore:hover{color:#ffffff;background:#0493f7;}
        div.itemCommentsForm form input#submitCommentButton,input[type="submit"],button.button{color:#ffffff;background:#303030;}
        div.itemCommentsForm form input#submitCommentButton:hover,input[type="submit"]:hover,button.button:hover{color:#ffffff;background:#61AE20;}
        .menutop li.root>.item{color:#ffffff;background:transparent;}
        .menutop li.root>.item:hover,.menutop li.root.active>.item,.menutop li.root.f-mainparent-itemfocus>.item{color:#61AE20;background:#222222;}
        .menutop ul{background:#393939;}.menutop ul li>.item{color:#8b8a8a;background:transparent;}
        .menutop ul li>.item:hover,.menutop ul li.active>.item,.menutop ul li.f-menuparent-itemfocus>.item{color:#ffffff;background:transparent;}
        body {font: 0.9em/20px Arial;  color:#000000; }
    </style>';
}

function view_post_new() {
    $myposts = get_posts('posts_per_page=5');
    echo '<div class="home-categorys"><div id="home-category">';
    echo '<ul id="item-category">';

    $count = 0;
    $itemfirst;
    foreach ($myposts as $mypost) {
        if (get_the_post_thumbnail($mypost->ID, 'thumbnail')) {
            $count++;
            if ($count == 1) {
                $itemfirst = $mypost;
                echo '<li class="categoryLeft"><div class="title-category"><a href="#">Bài viết mới</a></div><div class="cate-imgthum"><a href="' . get_permalink($mypost->ID) . '">';
                echo get_the_post_thumbnail($mypost->ID);
                echo '</a></div><div class="cate-titlefirst"><div class="cate-date">' . get_the_date() . '</div><h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2><div class="cate-des">' . get_the_excerpt() . '</div></div>';
                echo '</li>';
                echo '<div class="categoryRight categoryRightlistright">';
            } else {

                echo '<li><div class="title-category title-category-right"><a href="' . get_permalink($mypost->ID) . '">' . get_the_post_thumbnail($mypost->ID, 'thumbnail') . '</a></div><div class="cate-titlerest div-category-right">';
                echo '<a href="' . get_permalink($mypost->ID) . '">' . get_the_title($mypost->ID) . '</div><div class="cate-date">' . get_the_date() . '</div></li>';
            }
        }
    }

    echo '</div></ul></div>';
    echo '<div class="image-post-new-full">' . get_the_post_thumbnail($mypost->ID) . '</div></div>';
}

function list_new_category() {
    $myposts = get_posts('posts_per_page=20');
    echo '<div id="rt-maintop">
            <div class="rt-container">
    <div class="rt-grid-12 rt-alpha rt-omega">
                    <div class="jcarousel">
                        <div class="rt-block">                        <script>
                            jQuery(window).load(function() {
                                var $carousel_ul_id1 = $("#jcarouseld103");

                                $carousel_ul_id1.jcarousel({
                                    visible : 5,
                                    scroll : 1,
                                    wrap : "circular",
                                    autostart: true,
                                    animation : "slow"
                                })
                            });
                        </script>		<div class="module-title">
                            <h2 class="title black1"><a href="#">Công trình mới</a></h2>
                        </div>


                            <div id="k2ModuleBox93" class="k2ItemsBlock jcarousel">

                                <ul id="jcarouseld103">';
    foreach ($myposts as $mypost) {
        if (get_the_post_thumbnail($mypost->ID, 'thumbnail')) {
            echo '  <li class="even"><div class="responsive-slider"><div class="moduleItemIntrotext">
                                                      <a class="moduleItemImage" href="' . get_permalink($mypost->ID) . '">
                                                      ';
            echo get_the_post_thumbnail($mypost->ID, 'thumbnail');

            echo '</div></div>
                                        <div class="clr"></div>
                                                       </li>';
        }
    }
    echo '
                                </ul>
                            </div>
                        </div>
                    </div></div>
            </div></div>';
}

function list_category() {
    $arrayItem = array('5', '6', '24', '11', '20');
    echo'
    <div id="rt-sidebar-a">
    <div class="rt-block an_mobi">
        <div class="module-title">
            <h2 class="title">Danh mục</h2>
        </div>
        <ul class="menu-style">';
    for ($i = 0; $i < sizeof($arrayItem); $i++) {
        $category_ids = $arrayItem[$i];
        $category_link = get_category_link($category_ids);
        $cat = get_the_category_by_ID($category_ids);
        echo' <li class="firstItem"><a href="' . $category_link . '" style="margin-left:20px"><span>' . $cat . '</span></a></li>';
    }
    echo' </ul>
    </div> </div>';
}

function list_library() {
    echo '<div class="home-categorys-right">';
    list_category();
    list_library_work();
    contact();
    echo '</div>';
}

function list_library_work() {
    $categorys = 5;
    echo '<div class="rt-block">
            <div class="module-title">
                <h2 class="title">Thư viện công trình</h2>
            </div>
            <div class="khungquangcao">';
    $args = array('category__in' => $categorys, 'showposts' => 10);
    $my_query = new wp_query($args);
    while ($my_query->have_posts()) {
        $my_query->the_post();
        echo'<div class="quangcao">
                                    <a href="' . get_permalink() . '">';
        thumb_img($post->ID, '99', '140', '100', get_the_title());
        echo '</a>
                                    <p class="quangcao_p">' . get_the_title() . '</p>
                                </div>';
    };
    echo '</div>
                    </div>';
}

function contact() {
    echo '<div class="rt-block" style="margin-top: 10px;">
                <div class="module-title">
                    <h2 class="title">Gửi câu hỏi tư vấn</h2>
                </div>
                <div class="khungquangcao1">
                    <div id="formlienhe">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:20px;">

                            <tbody><tr>
                                <td width="100%" valign="top">


                                    <form action="http://bietthunhadep.com.vn/Lien-he/5/blog" method="post">

                                        <table width="100%" border="0" cellspacing="5" cellpadding="4">
                                            <tbody><tr>
                                                <td valign="top">To</td>
                                                <td valign="top"><input class="widt2" type="text" readonly="readonly"  value="goodhopearc@gmail.com" name="to">
                                                    <input type="hidden" size="30" value="goodhopejsc1@gmail.com" name="from">
                                                    <input type="hidden" size="30" value="01081990" name="pass">
                                                    <input type="hidden" size="30" value="Khách hàng" name="name">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top">Tiêu đề</td>
                                                <td valign="top"><input class="widt2" type="text" size="30" value="" name="subject"></td>
                                            </tr>
                                            <tr>
                                                <td valign="top">Email</td>
                                                <td valign="top"><input class="widt2" type="text" size="30" value="" name="email"></td>
                                            </tr>
                                            <tr>
                                                <td valign="top">Điện thoại</td>
                                                <td valign="top"><input class="widt2" type="text" size="30" value="" name="dt"></td>
                                            </tr>
                                            <tr>
                                                <td valign="top">Nội dung</td>
                                                <td valign="top"><textarea rows="5" cols="23" name="message"></textarea></td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td><input type="submit" value="Gửi đi"> </td>
                                            </tr>
                                            </tbody></table>

                                    </form>                                                                       			</td>

                            </tr>
                            </tbody></table></div>
                </div>
            </div>';
}

function slider_post_thietkenoithat($categorys) {
    //load slider small
    $args = array('category__in' => $categorys, 'showposts' => 9);
    $my_query = new wp_query($args);
    $cat = get_the_category_by_ID($categorys);
    echo '    
<div class="rt-grid-12 rt-alpha rt-omega">
        <div class="jcarousel">
            <div class="rt-block">                        <script>
                jQuery(window).load(function() {
                    var $carousel_ul_id1 = $("#jcarousel126");

                    $carousel_ul_id1.jcarousel({
                        visible : 5,
                        scroll : 1,
                        wrap : "circular",
                        autostart: true,
                        animation : "slow"
                    })
                });
            </script>		<div class="module-title">
                <h2 class="title">' . $cat . '</h2>
            </div>


                <div id="k2ModuleBox93" class="k2ItemsBlock jcarousel">

                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;"><div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                    <ul id="jcarousel126" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px;height: 161px;">';
    while ($my_query->have_posts()) {
        $my_query->the_post();
        
        echo '<li class="even jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none; width: 165px;">
                            <div class="moduleItemIntrotext">
                   <a class="moduleItemImage" href="' . get_permalink() . '" title="'.get_the_title().'">                                   
                       <div class="responsive-slider">
';                  echo thumb_img($post->ID, '95', '162', '100', get_the_title());
//                    thumb_img($post->ID, '99', '140', '100', get_the_title());
        echo '</div><a class="moduleItemImage1" href="' . get_permalink() . '" title="'.get_the_title().' "> ' . get_the_title() . '</a>
                            </div>
                            <div class="clr"></div>
                       </li>';
    };
    echo '</ul></div><div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div><div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div></div>
                </div>
            </div>
        </div></div>
';
}
function slider_post_thietkebietthu($categorys){
     //load slider small
    $args = array('category__in' => $categorys, 'showposts' => 9);
    $my_query = new wp_query($args);
    $cat = get_the_category_by_ID($categorys);
    echo '     
<div class="rt-grid-12 rt-alpha rt-omega">
        <div class="jcarousel">
            <div class="rt-block">                        <script>
                jQuery(window).load(function() {
                    var $carousel_ul_id1 = $("#jcarousel104");

                    $carousel_ul_id1.jcarousel({
                        visible : 5,
                        scroll : 1,
                        wrap : "circular",
                        autostart: true,
                        animation : "slow"
                    })
                });
            </script>		<div class="module-title">
                <h2 class="title">' . $cat . '</h2>
            </div>


                <div id="k2ModuleBox93" class="k2ItemsBlock jcarousel">

                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;"><div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                    <ul id="jcarousel104" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px;height: 161px;">';
    while ($my_query->have_posts()) {
        $my_query->the_post();
        
        echo '<li class="even firstItem jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none; width: 149px;">
                            <div class="moduleItemIntrotext">
                   <a class="moduleItemImage" href="' . get_permalink() . '" title="Nội thất đẹp cho đại gia đình ">                                   
                       <div class="responsive-slider">
';                  echo thumb_img($post->ID, '95', '162', '100', get_the_title());
//                    thumb_img($post->ID, '99', '140', '100', get_the_title());
        echo '</div><a class="moduleItemImage1" href="' . get_permalink() . '" title="Nội thất đẹp cho đại gia đình "> ' . get_the_title() . '</a>
                            </div>
                            <div class="clr"></div>
                       </li>';
    };
    echo '</ul></div><div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div><div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div></div>
                </div>
            </div>
        </div></div>
';
}
function slider_post_thietkenhapho($categorys){
        //load slider small
    
    $args = array('category__in' => $categorys, 'showposts' => 9);
    $my_query = new wp_query($args);
    $cat = get_the_category_by_ID($categorys);
    echo '    
<div class="rt-grid-12 rt-alpha rt-omega">
        <div class="jcarousel">
            <div class="rt-block">                        <script>
                jQuery(window).load(function() {
                    var $carousel_ul_id1 = $("#jcarousel112");

                    $carousel_ul_id1.jcarousel({
                        visible : 5,
                        scroll : 1,
                        wrap : "circular",
                        autostart: true,
                        animation : "slow"
                    })
                });
            </script>		<div class="module-title">
                <h2 class="title">' . $cat . '</h2>
            </div>


                <div id="k2ModuleBox93" class="k2ItemsBlock jcarousel">

                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;"><div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                    <ul id="jcarousel112" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px;height: 161px;">';
    while ($my_query->have_posts()) {
        $my_query->the_post();
        
        echo '<li class="even firstItem jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none; width: 149px;">
                            <div class="moduleItemIntrotext">
                   <a class="moduleItemImage" href="' . get_permalink() . '" title="Nội thất đẹp cho đại gia đình ">                                   
                       <div class="responsive-slider">
';                  echo thumb_img($post->ID, '95', '162', '100', get_the_title());
//                    thumb_img($post->ID, '99', '140', '100', get_the_title());
        echo '</div><a class="moduleItemImage1" href="' . get_permalink() . '" title="Nội thất đẹp cho đại gia đình "> ' . get_the_title() . '</a>
                            </div>
                            <div class="clr"></div>
                       </li>';
    };
    echo '</ul></div><div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div><div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div></div>
                </div>
            </div>
        </div></div>
';
}
function slider_post_thietkevanphongkhachsan($categorys){
          //load slider small
    
    $args = array('category__in' => $categorys, 'showposts' => 9);
    $my_query = new wp_query($args);
    $cat = get_the_category_by_ID($categorys);
    echo '      
<div class="rt-grid-12 rt-alpha rt-omega">
        <div class="jcarousel">
            <div class="rt-block">                        <script>
                jQuery(window).load(function() {
                    var $carousel_ul_id1 = $("#jcarousel106");

                    $carousel_ul_id1.jcarousel({
                        visible : 5,
                        scroll : 1,
                        wrap : "circular",
                        autostart: true,
                        animation : "slow"
                    })
                });
            </script>		<div class="module-title">
                <h2 class="title">' . $cat . '</h2>
            </div>


                <div id="k2ModuleBox93" class="k2ItemsBlock jcarousel">

                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;"><div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                    <ul id="jcarousel106" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px;height: 161px;">';
    while ($my_query->have_posts()) {
        $my_query->the_post();
        
        echo '<li class="even firstItem jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none; width: 149px;">
                            <div class="moduleItemIntrotext">
                   <a class="moduleItemImage" href="' . get_permalink() . '" title="Nội thất đẹp cho đại gia đình ">                                   
                       <div class="responsive-slider">
';                  echo thumb_img($post->ID, '95', '162', '100', get_the_title());
//                    thumb_img($post->ID, '99', '140', '100', get_the_title());
        echo '</div><a class="moduleItemImage1" href="' . get_permalink() . '" title="Nội thất đẹp cho đại gia đình "> ' . get_the_title() . '</a>
                            </div>
                            <div class="clr"></div>
                       </li>';
    };
    echo '</ul></div><div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div><div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div></div>
                </div>
            </div>
        </div></div>
';
}
function slider_post_thietkecongtrinhduan($categorys){
        //load slider small
    $args = array('category__in' => $categorys, 'showposts' => 9);
    $my_query = new wp_query($args);
    $cat = get_the_category_by_ID($categorys);
    echo '        
<div class="rt-grid-12 rt-alpha rt-omega">
        <div class="jcarousel">
            <div class="rt-block">                        <script>
                jQuery(window).load(function() {
                    var $carousel_ul_id1 = $("#jcarousel103");

                    $carousel_ul_id1.jcarousel({
                        visible : 5,
                        scroll : 1,
                        wrap : "circular",
                        autostart: true,
                        animation : "slow"
                    })
                });
            </script>		<div class="module-title">
                <h2 class="title">' . $cat . '</h2>
            </div>


                <div id="k2ModuleBox93" class="k2ItemsBlock jcarousel">

                    <div class="jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;"><div class="jcarousel-clip jcarousel-clip-horizontal" style="position: relative;">
                    <ul id="jcarousel103" class="jcarousel-list jcarousel-list-horizontal" style="overflow: hidden; position: relative; top: 0px; margin: 0px; padding: 0px; left: 0px;height: 161px;">';
    while ($my_query->have_posts()) {
        $my_query->the_post();
        
        echo '<li class="even firstItem jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1" style="float: left; list-style: none; width: 149px;">
                            <div class="moduleItemIntrotext">
                   <a class="moduleItemImage" href="' . get_permalink() . '" title="Nội thất đẹp cho đại gia đình ">                                   
                       <div class="responsive-slider">
';                  echo thumb_img($post->ID, '95', '162','100', get_the_title());
//                    thumb_img($post->ID, '99', '140', '100', get_the_title());
        echo '</div><a class="moduleItemImage1" href="' . get_permalink() . '" title="Nội thất đẹp cho đại gia đình "> ' . get_the_title() . '</a>
                            </div>
                            <div class="clr"></div>
                       </li>';
    };
    echo '</ul></div><div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div><div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div></div>
                </div>
            </div>
        </div></div>
';
}

// Home page widgets

genesis_register_sidebar(array(
    'id' => 'home-featured-full',
    'name' => __('Home Featured Full', 'CHILD_THEME_NAME'),
    'description' => __('This is the featured area if you want full width.', 'CHILD_THEME_NAME'),
));

genesis_register_sidebar(array(
    'id' => 'home-middle-1',
    'name' => __('Home Middle 1', 'CHILD_THEME_NAME'),
    'description' => __('This is the home middle left area.', 'CHILD_THEME_NAME'),
));

genesis_register_sidebar(array(
    'id' => 'home-middle-2',
    'name' => __('Home Middle 2', 'CHILD_THEME_NAME'),
    'description' => __('This is the home middle center area.', 'CHILD_THEME_NAME'),
));

genesis_register_sidebar(array(
    'id' => 'home-middle-3',
    'name' => __('Home Middle 3', 'CHILD_THEME_NAME'),
    'description' => __('This is the home middle right area.', 'CHILD_THEME_NAME'),
));

genesis_register_sidebar(array(
    'id' => 'home-bottom',
    'name' => __('Home Bottom', 'CHILD_THEME_NAME'),
    'description' => __('This is the home bottom area.', 'CHILD_THEME_NAME'),
));

// Home feature widget section

function raynoblog_home_do_featured() {



    if (is_active_sidebar('home-featured-full') || is_active_sidebar('home-featured-left') || is_active_sidebar('home-featured-right')) {



        echo '<section id="home-featured" class="clearfix"><div class="wrap">';



        genesis_widget_area('home-featured-full', array(
            'before' => '<main class="home-featured-full">',
            'after' => '</main>',
        ));



        echo '<section id="home-featured-halves">';



        genesis_widget_area('home-featured-one', array(
            'before' => '<aside class="home-featured-one one-half first">',
            'after' => '</aside>',
        ));



        genesis_widget_area('home-featured-two', array(
            'before' => '<aside class="home-featured-two one-half">',
            'after' => '</aside>',
        ));



        echo '</section><!-- end home-featured-halves --></div><!-- end wrap --></section><!-- end home-featured -->';
    }
}

// Home middle widget section



function raynoblog_home_do_middle() {



    if (is_active_sidebar('home-middle-1') || is_active_sidebar('home-middle-2') || is_active_sidebar('home-middle-3')) {



        echo '<section id="home-middle" class="clearfix"><div class="wrap">';



        genesis_widget_area('home-middle-1', array(
            'before' => '<aside class="home-middle-1 widget-area one-third first">',
            'after' => '</aside>',
        ));



        genesis_widget_area('home-middle-2', array(
            'before' => '<aside class="home-middle-2 widget-area one-third">',
            'after' => '</aside>',
        ));



        genesis_widget_area('home-middle-3', array(
            'before' => '<aside class="home-middle-3 widget-area one-third">',
            'after' => '</aside>',
        ));



        echo '</div><!-- end wrap --></section><!-- end home-middle -->';
    }
}

// Home bottom widget section



function raynoblog_home_do_bottom() {

    if (function_exists("drawslider")) {
        drawslider();
    };
// echo do_shortcode('[print_responsive_thumbnail_slider]');

    if (is_active_sidebar('home-bottom')) {



        echo '<section id="home-bottom" class="clearfix"><div class="wrap">';



        genesis_widget_area('home-bottom', array(
            'before' => '<aside class="home-bottom">',
        ));



        echo '</div><!-- end .wrap --></section><!-- end #home-bottom -->';
    }
}

//* Register widget areas

genesis_register_sidebar(array(
    'id' => 'after-category',
    'name' => __('After Category', 'theme-prefix'),
    'description' => __('This is the after category post.', 'theme-prefix'),
));



//* Hooks after-category widget area to single posts

add_action('genesis_category_footer', 'my_after_category_widget');

function my_after_category_widget() {

    if (!is_category('post'))
        return;

    genesis_widget_area('after-category', array(
        'before' => '<div class="after-category widget-area"><div class="wrap">',
        'after' => '</div></div>',
    ));
}

//* Register widget areas

genesis_register_sidebar(array(
    'id' => 'after-entry',
    'name' => __('After Entry', 'theme-prefix'),
    'description' => __('This is the after entry post.', 'theme-prefix'),
));



//* Hooks after-entry widget area to single posts

add_action('genesis_entry_footer', 'my_after_entry_widget');

function my_after_entry_widget() {

    if (!is_singular('post'))
        return;

    genesis_widget_area('after-entry', array(
        'before' => '<div class="after-entry widget-area"><div class="wrap">',
        'after' => '</div></div>',
    ));
}

//* Register widget areas

genesis_register_sidebar(array(
    'id' => 'before-entry',
    'name' => __('Before Entry', 'theme-prefix'),
    'description' => __('This is the before entry post.', 'theme-prefix'),
));



//* Hooks after-entry widget area to single posts

add_action('genesis_entry_footer', 'my_before_entry_widget');

function my_before_entry_widget() {

    if (!is_singular('post'))
        return;

    genesis_widget_area('before-entry', array(
        'before' => '<div class="before-entry widget-area"><div class="wrap">',
        'after' => '</div></div>',
    ));
}

add_theme_support('post-thumbnails');

function get_featured_img($post_id) {

    $error_img = get_bloginfo('template_url') . '/images/no-image.jpg'; // link hình ảnh nếu ko có ảnh featured

    $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail'); // lấy link hình ảnh?

    if ($images) { // nếu có hình ảnh featured
        return $images[0]; // sẽ trả về giá trị link hình của featured
    } else {

        return $error_img; // nếu ko có thì sẽ trả về giá trị hình error
    }
}

function thumb_img($post_id, $h, $w, $q, $alt) {

    echo '<img align="middle" src="';

    echo bloginfo('template_url');

    echo '/timthumb.php?src=' . get_featured_img($post_id) . '&amp;h=' . $h . '&amp;w=' . $w . '&amp;q=' . $q . '" alt="' . $alt . '" />';
}
