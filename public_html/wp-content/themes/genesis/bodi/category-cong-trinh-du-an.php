<?php

/**

 * Template Name: Category

 */

remove_action( 'genesis_loop', 'genesis_do_loop' ); // Remove default loop

//add_action('genesis_post_content','the_content');  // Adds your custom page code/content before loop

add_action( 'genesis_loop', 'category_page' ); // Do custom loop

function category_page() {

    //add_action('genesis_loop', 'genesis_standard_loop');

    echo '<div class="category_list">';

    echo '<div class="title-news-img"> <h4>';
    single_cat_title( '', true );

    echo '</h4></div>';

    echo '<div class="page-featured cpage-featured  page-featured__">';



    echo '<div class="items-row row-fluid">';

    $args = array('orderby'=>'id','hide_empty'=>0);
    $categories = get_categories($args);
    for($i=2;$i<8;$i++){
            $category_ids = $categories[$i]->term_id;
            $category_num = $categories[$i]->category_count;
            $category_link = get_category_link( $category_ids);
            if($i==5){
                echo "</div>";
                echo  '<div class="items-row row-fluid">';
                }            
        echo '<div class="item column-1 span4">';

        echo '<div class="item_header"> <h3>';

        echo '<a href="'.esc_url( $category_link).'" title="'.$categories[$i]->cat_name.'">'.$categories[$i]->cat_name;

        echo '</a></h3></div>';

        echo '<div class="item_img img-intro img-intro__none"> <a href="'.esc_url( $category_link ).'" title="'.$categories[$i]->cat_name.'" class="touchGalleryLink">';

        echo '<img src="http://acihome.vn/images/category/a1.jpg" alt="'.$categories[$i]->cat_name.'">';

        echo '</a></div>';

        echo '</div>';
    }

    echo '</div>'; // end items-row 2

    echo '</div></div>';

    echo '<div class="entry-content">';

    child_grid_loop_helper();


?>

   <?php 

$post_id = get_the_ID();



$args = array(

   'orderby' => 'rand',

   'showposts'=>10,

   'cat' => 1,

   'post__not_in' => array( $postid )

);



$rand_query = new WP_Query( $args );

echo '<div class="news-content"><div class="title-news-imgs"> <h4> Thư viện công trình</h4></div>';

echo '<div class="news-img-content">';

while ( $rand_query->have_posts($echo = false) ) : $rand_query->the_post( $echo = false);

   echo '<a href="'. get_permalink().'" title="'. get_the_title().'">';thumb_img($post->ID,'198','280','100',get_the_title());'</a>';

endwhile;

echo '</div></div>';

?>



<?php

    echo '</div><!-- end .entry-content -->' ;

}





function child_grid_loop_helper() {

     $categories = get_categories();

    if( is_category() ) {

    $j=0;

    foreach ($categories as $cat) {

        $category_ids = $cat->term_id;

        $category_num = $cat->category_count;

        $category_link = get_category_link( $category_ids);

        if ($category_num >=0) {

            $j++;

             if($category_ids == 4) {

                echo '<div id="home-category">';

		echo '<ul id="item-category">';

		$sticky=get_option('sticky_posts');

		$args1=array('post__in' => $sticky,'ignore_sticky_posts' => 1,'category__in' => $category_ids,'showposts'=>1 );

		$my_query1 = new wp_query($args1);

                $e=0;

		 while ($my_query1->have_posts()){

		$my_query1->the_post();

                     $e++;

                        if($e==1) {

			echo '<li class="category_Left"><div class="title-category"><a href="'.esc_url( $category_link ).'">'.$cat->cat_name.'</a></div><div class="cate-imgthum"><a href="'.get_permalink().'">';thumb_img($post->ID,'290','410','100',get_the_title());

                            echo '</a></div><div class="cate-titlefirst"><div class="cate-date">'.get_the_date().'</div><h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2><div class="cate-des">'.get_the_excerpt().'</div></div>';

                            echo '</li>';

}

}
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args=array('category__in' => $category_ids,'paged'=>$paged,'posts_per_page' => 12);
                // 'category_name='.$catname.'&showposts=5'.'&paged='.$paged
                $my_query = new wp_query($args);

                $e=0;

                echo '<div class="category_Right">';

                while ($my_query->have_posts()){

                      $my_query->the_post();
                        if($e==1) {

                        } else {

                            echo '<li><div class="cate-titlerest"><div class="cate-imgthumb"><a href="'.get_permalink().'">';thumb_img($post->ID,'99','140','100',get_the_title());

                            echo '</a></div><h2><a href="'.get_permalink().'">'.get_the_title().'</a></h2><div class="cate-des2">'.get_the_excerpt().'</div></div></li>';

                        }

                }

                echo '</div> </ul>';
                wp_pagenavi();
                echo '</div>';
            }                   

        }

    } }

}

genesis();