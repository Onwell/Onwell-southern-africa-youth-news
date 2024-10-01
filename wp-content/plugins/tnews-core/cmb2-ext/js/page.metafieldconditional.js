(function($){
    "use strict";
    
    let $tnews_page_breadcrumb_area      = $("#_tnews_page_breadcrumb_area");
    let $tnews_page_settings             = $("#_tnews_page_breadcrumb_settings");
    let $tnews_page_breadcrumb_image     = $("#_tnews_breadcumb_image");
    let $tnews_page_title                = $("#_tnews_page_title");
    let $tnews_page_title_settings       = $("#_tnews_page_title_settings");

    if( $tnews_page_breadcrumb_area.val() == '1' ) {
        $(".cmb2-id--tnews-page-breadcrumb-settings").show();
        if( $tnews_page_settings.val() == 'global' ) {
            $(".cmb2-id--tnews-breadcumb-image").hide();
            $(".cmb2-id--tnews-page-title").hide();
            $(".cmb2-id--tnews-page-title-settings").hide();
            $(".cmb2-id--tnews-custom-page-title").hide();
            $(".cmb2-id--tnews-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--tnews-breadcumb-image").show();
            $(".cmb2-id--tnews-page-title").show();
            $(".cmb2-id--tnews-page-breadcrumb-trigger").show();
    
            if( $tnews_page_title.val() == '1' ) {
                $(".cmb2-id--tnews-page-title-settings").show();
                if( $tnews_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--tnews-custom-page-title").hide();
                } else {
                    $(".cmb2-id--tnews-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--tnews-page-title-settings").hide();
                $(".cmb2-id--tnews-custom-page-title").hide();
    
            }
        }
    } else {
        $tnews_page_breadcrumb_area.parents('.cmb2-id--tnews-page-breadcrumb-area').siblings().hide();
    }


    // breadcrumb area
    $tnews_page_breadcrumb_area.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--tnews-page-breadcrumb-settings").show();
            if( $tnews_page_settings.val() == 'global' ) {
                $(".cmb2-id--tnews-breadcumb-image").hide();
                $(".cmb2-id--tnews-page-title").hide();
                $(".cmb2-id--tnews-page-title-settings").hide();
                $(".cmb2-id--tnews-custom-page-title").hide();
                $(".cmb2-id--tnews-page-breadcrumb-trigger").hide();
            } else {
                $(".cmb2-id--tnews-breadcumb-image").show();
                $(".cmb2-id--tnews-page-title").show();
                $(".cmb2-id--tnews-page-breadcrumb-trigger").show();
        
                if( $tnews_page_title.val() == '1' ) {
                    $(".cmb2-id--tnews-page-title-settings").show();
                    if( $tnews_page_title_settings.val() == 'default' ) {
                        $(".cmb2-id--tnews-custom-page-title").hide();
                    } else {
                        $(".cmb2-id--tnews-custom-page-title").show();
                    }
                } else {
                    $(".cmb2-id--tnews-page-title-settings").hide();
                    $(".cmb2-id--tnews-custom-page-title").hide();
        
                }
            }
        } else {
            $(this).parents('.cmb2-id--tnews-page-breadcrumb-area').siblings().hide();
        }
    });

    // page title
    $tnews_page_title.on("change",function(){
        if( $(this).val() == '1' ) {
            $(".cmb2-id--tnews-page-title-settings").show();
            if( $tnews_page_title_settings.val() == 'default' ) {
                $(".cmb2-id--tnews-custom-page-title").hide();
            } else {
                $(".cmb2-id--tnews-custom-page-title").show();
            }
        } else {
            $(".cmb2-id--tnews-page-title-settings").hide();
            $(".cmb2-id--tnews-custom-page-title").hide();

        }
    });

    //page settings
    $tnews_page_settings.on("change",function(){
        if( $(this).val() == 'global' ) {
            $(".cmb2-id--tnews-breadcumb-image").hide();
            $(".cmb2-id--tnews-page-title").hide();
            $(".cmb2-id--tnews-page-title-settings").hide();
            $(".cmb2-id--tnews-custom-page-title").hide();
            $(".cmb2-id--tnews-page-breadcrumb-trigger").hide();
        } else {
            $(".cmb2-id--tnews-breadcumb-image").show();
            $(".cmb2-id--tnews-page-title").show();
            $(".cmb2-id--tnews-page-breadcrumb-trigger").show();
    
            if( $tnews_page_title.val() == '1' ) {
                $(".cmb2-id--tnews-page-title-settings").show();
                if( $tnews_page_title_settings.val() == 'default' ) {
                    $(".cmb2-id--tnews-custom-page-title").hide();
                } else {
                    $(".cmb2-id--tnews-custom-page-title").show();
                }
            } else {
                $(".cmb2-id--tnews-page-title-settings").hide();
                $(".cmb2-id--tnews-custom-page-title").hide();
    
            }
        }
    });

    // page title settings
    $tnews_page_title_settings.on("change",function(){
        if( $(this).val() == 'default' ) {
            $(".cmb2-id--tnews-custom-page-title").hide();
        } else {
            $(".cmb2-id--tnews-custom-page-title").show();
        }
    });
    
})(jQuery);