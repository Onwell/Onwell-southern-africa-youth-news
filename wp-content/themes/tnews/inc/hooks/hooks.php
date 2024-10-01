<?php 
/**
 * @Packge     : Tnews
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://themeforest.net/user/themeholy
 *
 */
 
	// Block direct access
	if( ! defined( 'ABSPATH' ) ){
		exit();
	}

	/**
	* Hook for preloader
	*/
	add_action( 'tnews_preloader_wrap', 'tnews_preloader_wrap_cb', 10 );

	/**
	* Hook for Subscribe Popup
	*/
	add_action( 'tnews_subscribe_popup_wrap', 'tnews_subscribe_popup_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'tnews_main_wrapper_start', 'tnews_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'tnews_header', 'tnews_header_cb', 10 );
	
	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'tnews_blog_start_wrap', 'tnews_blog_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'tnews_blog_col_start_wrap', 'tnews_blog_col_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'tnews_blog_col_end_wrap', 'tnews_blog_col_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'tnews_blog_end_wrap', 'tnews_blog_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Pagination
	*/
    add_action( 'tnews_blog_pagination', 'tnews_blog_pagination_cb', 10 );
    
    /**
	* Hook for Blog Content
	*/
	add_action( 'tnews_blog_content', 'tnews_blog_content_cb', 10 );
    
    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'tnews_blog_sidebar', 'tnews_blog_sidebar_cb', 10 );
    
    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'tnews_blog_details_sidebar', 'tnews_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'tnews_blog_details_wrapper_start', 'tnews_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'tnews_blog_post_meta', 'tnews_blog_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'tnews_blog_details_share_options', 'tnews_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Post Share Options
	*/
	add_action( 'tnews_blog_post_share_options', 'tnews_blog_post_share_options_cb', 10 );

	/**
	* Hook for Blog Details Post Author Bio
	*/
	add_action( 'tnews_blog_details_author_bio', 'tnews_blog_details_author_bio_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'tnews_blog_details_tags_and_categories', 'tnews_blog_details_tags_and_categories_cb', 10 );

	/**
	* Hook for Blog Details Related Post Navigation
	*/
	add_action( 'tnews_blog_details_post_navigation', 'tnews_blog_details_post_navigation_cb', 10 ); 

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'tnews_blog_details_comments', 'tnews_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('tnews_blog_details_col_start','tnews_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('tnews_blog_details_col_end','tnews_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('tnews_blog_details_wrapper_end','tnews_blog_details_wrapper_end_cb');
	
	/**
	* Hook for Blog Post Thumbnail Category
	*/
	add_action('tnews_blog_thumbnial_cate','tnews_blog_thumbnial_cate_cb');

	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action( 'tnews_blog_post_thumb', 'tnews_blog_post_thumb_cb', 10, 3 );
    
	/**
	* Hook for Blog Post Content
	*/
	add_action('tnews_blog_post_content','tnews_blog_post_content_cb');
	
    
	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('tnews_blog_postexcerpt_read_content','tnews_blog_postexcerpt_read_content_cb');
	
	/**
	* Hook for footer content
	*/
	add_action( 'tnews_footer_content', 'tnews_footer_content_cb', 10 );
	
	/**
	* Hook for main wrapper end
	*/
	add_action( 'tnews_main_wrapper_end', 'tnews_main_wrapper_end_cb', 10 );
	
	/**
	* Hook for Back to Top Button
	*/
	add_action( 'tnews_back_to_top', 'tnews_back_to_top_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'tnews_page_start_wrap', 'tnews_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'tnews_page_end_wrap', 'tnews_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'tnews_page_col_start_wrap', 'tnews_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'tnews_page_col_end_wrap', 'tnews_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'tnews_page_sidebar', 'tnews_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'tnews_page_content', 'tnews_page_content_cb', 10 );