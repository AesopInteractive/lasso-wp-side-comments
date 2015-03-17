<?php

/**
*	Plugin Name: Lasso - WP Side Comments
*	Description: Provides compatibilty with Lasso and WP Side Comments plugin
*	Version 0.1-alpha-prototype
*
*/
class lassoWpSideComments {


	public function __construct(){
		add_action('wp_head',		array($this,'script'));
	}

	public function script(){

		if ( function_exists('lasso_user_can') && lasso_user_can() && is_user_logged_in() ) {

			?>
			<!-- Lasso WP Side Comments -->
			<script>
				jQuery(document).ready(function($){

					// enter the editor
					$(document).on('click', '#lasso--edit',function(){

						// for reference <div class="commentable-wrapper"><p id="ui-id-1">text to keep</p><div class="side-comment"></div></div>
						var w 	= $('.commentable-wrapper')
						,	cs  = $('.commentable-section')
						,	sc 	= $('.side-comment')

						// 1. loop through .commentable-wrapper and remove the classes and atributes from <p> elements
						// 2. unwrap it
						// 3. remove the comments wrapper if there are comments
						w.each(function(){

							var $this = $(this);

							$this.find('p').each(function(){
								$(this).removeAttr('id')
								// test $(this).css({'border':'1px solid red'})
							});

							$this.children().unwrap()

							$this.find('.comments-wrapper').remove()

						});

						// 4. loop through each side comment and remove
						sc.each(function(){
							$(this).remove()
						});

						// 5. loop through each commentable-section and remove
						cs.each(function(){
							$(this).removeAttr('class data-section-id')
						});

					});
				});
			</script>
			<?php

		}

	}
}
new lassoWpSideComments;