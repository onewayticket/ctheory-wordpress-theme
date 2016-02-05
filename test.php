<?php
/*
 *	Template Name: Test
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">
			
			<?php 
				
				
			$the_query = get_posts( 'posts_per_page=-1&fields=ids' );
			if($the_query){
				foreach($the_query as $id) {
					$postids[] = $id;
				}
			}
				
				foreach ($postids as $meta) {
					$authors = get_post_meta($meta, 'Author');
					
					
					$name = $authors[0];
					$names = explode(" ", $name);

					
					$initial = false;
					
					// Check to see if there is an initial and append to first name
					
					$length = strlen($names[1]);
					
					if (strlen($names[1]) == 2) {
						$firstname = $names[0] . " " . $names[1];
						$initial = true;
					}
					
					else {
						$firstname = $names[0];
					}
					
					
					// Check to see if there is an initial before first name
					
					if (preg_match("/.\\./", $names[0])) {
						$firstname = $firstname . " " . $names[1];
						$initial = true;
						}

					
					$author_nospace = str_replace(' ', '', $authors[0]);
					$email = $author_nospace . "@n.com";
					
					// Get last word of string for $lastname
					
					$lastname = array_pop($names);
					
					// Check for middle name and append to first name
					
					if ($lastname != $names[1] && $initial != true) {
						$firstname = $firstname . " " . $names[1];
					}
						
					
					$author_list[] = array(
							"first_name" => $firstname,
							"last_name" => $lastname,
							"user_login" => $author_nospace,
							"email" => $email
							);
							

					
				}
								
				$authorlist_nodups = array_unique($author_list, SORT_REGULAR);
				
				$random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
				
				foreach ($authorlist_nodups as $users) {
					$first = $users['first_name'];
					$last = $users['last_name'];
					$email = $users['email'];
					$user = $users['user_login'];

				
					$userdata = array(
						'first_name'  =>  $first,
						'last_name'    =>  $last,
						'user_login'   => $user,
						'user_email' => $email,
					
						);
						
						echo "<pre>";
						echo print_r($userdata);
						echo "</pre><br>"; 	

						
						// 	$user_id = wp_insert_user( $userdata ) ;
				
						 if ( ! is_wp_error( $user_id ) ) {
							 echo "User created : ". $user_id . "<br />";
						}
						
						else {
							// $error_string = $result->get_error_message();
							echo "Fail <br>";
						}
						
					
											
				}
				
			
				
				 



?>
			
				

									
			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
