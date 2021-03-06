<?php

/**

 * Genesis Framework.

 *

 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.

 * Please do all modifications in the form of a child theme.

 *

 * @package Genesis\Templates

 * @author  StudioPress

 * @license GPL-2.0+

 * @link    http://my.studiopress.com/themes/genesis/

 */



do_action( 'genesis_doctype' );

do_action( 'genesis_title' );

do_action( 'genesis_meta' );



wp_head(); //* we need this for plugins

?>

<script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');



  ga('create', 'UA-58390135-1', 'auto');

  ga('send', 'pageview');



</script>



    <script src="http://bietthunhadep.com.vn/js/jquery.min.js" type="text/javascript"></script>

    <script src="http://bietthunhadep.com.vn/js/jquery.mobile.customized.min.js" type="text/javascript"></script>

    <script src="http://bietthunhadep.com.vn/js/jquery.easing.1.3.js" type="text/javascript"></script>

    <script src="http://bietthunhadep.com.vn/js/bootstrap.js" type="text/javascript"></script>

    <script src="http://bietthunhadep.com.vn/js/scripts.js" type="text/javascript"></script>

    <script src="http://bietthunhadep.com.vn/js/superfish.js" type="text/javascript"></script>

    <script src="http://bietthunhadep.com.vn/js/jquery.mobilemenu.js" type="text/javascript"></script>
    <!-- new update -->
    <!--<script src="http://bietthunhadep.com.vn/js/jquery.jcarousel.js" type="text/javascript"></script>-->
    <!--<script src="http://bietthunhadep.com.vn/js/jcarousel.responsive.js" type="text/javascript"></script>-->
    <!--<link media="(min-width: 600px)" rel="stylesheet" href="wp-content/themes/genesis/asset/css/modal.css" type="text/css"/>-->
    <!--<link  media="(min-width: 600px)" rel="stylesheet" href="wp-content/themes/genesis/asset/css/k2.css" type="text/css"/>-->
    <link media="(min-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/gantry.css" type="text/css"/>
    <link media="(min-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/grid-12.css" type="text/css"/>
    <link  rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/style1.css" type="text/css" />
    <link  rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/reponsive.css" type="text/css" />
    <link media="(min-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/template.css" type="text/css"/>
    <link media="(min-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/tooltips.css" type="text/css"/>
    <link media="(min-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/framework-reset.css" type="text/css"/>
    <link media="(min-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/fusionmenu.css" type="text/css"/>
    <link  rel="stylesheet" href="wp-content/themes/genesis/asset/css/tabs.css" type="text/css"/>
    <link media="(min-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/jquery.jcarousel.css" type="text/css"/>
    <link media="(min-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/nivo-slider.css" type="text/css"/>
    <link media="(max-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/style.css" type="text/css"/>
    <link media="(max-width: 600px)" rel="stylesheet" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/css/fusionmenu2.css" type="text/css"/>

    <script src="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/js/jquery.min.js" type="text/javascript"></script>
    <script src="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/js/scripts.js" type="text/javascript"></script>
    <script src="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/js/fusion.js" type="text/javascript"></script>
    <script src="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/js/jquery.jcarousel.min.js" type="text/javascript"></script>
    <script src="http://bietthunhadep.com.vn/wp-content/themes/genesis/asset/js/jquery.nivo.slider.js" type="text/javascript"></script>
    
    
    
    <link rel="stylesheet" type="text/css" href="http://bietthunhadep.com.vn/wp-content/themes/genesis/lib/css/jcarousel.responsive.css">
    <script type="text/javascript">

        window.addEvent('load', function() {

            new JCaption('img.caption');

        });

        jQuery.noConflict()

    </script>

    <script type="text/javascript" language="javascript">

                            jQuery(function(){

                                jQuery('ul.menu')

                                    .superfish({

                                        hoverClass:    'sfHover',

                                        pathClass:     'overideThisToUse',

                                        pathLevels:    1,

                                        delay:         500,

                                        animation:     {opacity:'show', height:'show'},

                                        speed:         'normal',

                                        speedOut:      'fast',

                                        autoArrows:    false,

                                        disableHI:     false,

                                        useClick:      0,

                                        easing:        "swing",

                                        onInit:        function(){},

                                        onBeforeShow:  function(){},

                                        onShow:        function(){},

                                        onHide:        function(){},

                                        onIdle:        function(){}

                                    });

                            });

                        </script>
                        <script>
           
    jQuery(window).load(function() {
        /*Tabs ID is defined by the module class suffix.*/

        var $tabs_container_id = $("#tabs");

        $tabs_container_id.tabs({
            fx : {
                opacity : "toggle"
            },
            select : function(event, ui) {
                jQuery(this).css("height", jQuery(this).height());
                jQuery(this).css("overflow", "hidden");
            },
            show : function(event, ui) {
                jQuery(this).css("height", "auto");
                jQuery(this).css("overflow", "visible");
            }
        });
    });
</script>
                        <style type="text/css">
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
</style>

</head>

<?php

genesis_markup( array(

	'html5'   => '<body %s>',

	'xhtml'   => sprintf( '<body class="%s">', implode( ' ', get_body_class() ) ),

	'context' => 'body',

) );

do_action( 'genesis_before' );



genesis_markup( array(

	'html5'   => '<div %s>',

	'xhtml'   => '<div id="wrap">',

	'context' => 'site-container',

) );



do_action( 'genesis_before_header' );

do_action( 'genesis_header' );

do_action( 'genesis_after_header' );



genesis_markup( array(

	'html5'   => '<div %s>',

	'xhtml'   => '<div id="inner">',

	'context' => 'site-inner',

) );

genesis_structural_wrap( 'site-inner' );



