<?php

/**
 * @author Shubham Sachdeva
 * @copyright 2012
 */

//global variables
global $db_option_host,$db_option_name,$db_option_pwd,$db_option_user,$db_option_prefix,$db_option_url;
global $db_value_host,$db_value_name,$db_value_pwd,$db_value_user,$db_value_prefix,$db_value_url;

global $show_value_survey_notification,$db_connection_error_name,$db_connection_error;


//if user is administrator
if (current_user_can('manage_options')) 
{
    //show the page title
?>
    <div class='wrap'>
        <div id='icon-options-general' class='icon32'>
            <br/>
        </div>
        <h2><?php echo __( 'Configuration', 'menu-test' ); ?></h2>
        <br />  
          
        <?php       
            
        $hidden_field_name = 'config_form_submit_hidden';

        //process some data of the form
        // See if the user has posted us some information
        // If they did, this hidden field will be set to 'Y'
        if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) 
        {
                            
            // Read the posted values
            $db_value_name   = $_POST[ $db_option_name ];
            $db_value_user   = $_POST[ $db_option_user ];
            $db_value_host   = $_POST[ $db_option_host ];
            $db_value_pwd    = $_POST[ $db_option_pwd ];
            $db_value_url    = $_POST[ $db_option_url ]; 
            $db_value_prefix = $_POST[ $db_option_prefix ];  
        
            // Save the posted values in the database
            update_option( $db_option_name, $db_value_name );
            update_option( $db_option_user, $db_value_user );
            update_option( $db_option_host, $db_value_host );
            update_option( $db_option_pwd, $db_value_pwd );
            update_option( $db_option_prefix, $db_value_prefix );
            update_option( $db_option_url, $db_value_url );
            
            
            
        
            // Put an settings updated message on the screen

            ?>
            
            <div class='updated' id='notification'>
                <p><strong><?php _e('Settings saved.', 'menu-test' ); ?></strong></p>
            </div>
            
            <?php

        }
        
        //check database connection
        $temp = new wpdb( $db_value_user, $db_value_pwd, $db_value_name, $db_value_host );
        //if there is any error in connection, put a message for the same!
        if ( isset($temp->error) && is_object($temp->error) )
        {
            // Put an error message regarding connection fail!
            $db_connection_error = TRUE;
            update_option( $db_connection_error_name, $db_connection_error );
            ?>
            
            <div class='updated' id='notification'>
                <p><strong><?php _e('Connection with database failed. Please correct the settings below.', 'menu-test' ); ?></strong></p>
            </div>
            
        <?php

        }
        else
        {
            $db_connection_error = FALSE;
            update_option( $db_connection_error_name, $db_connection_error );
        }
                   
        //setting screen form here
        ?>               

        <p><?php _e("Details about your LimeSurvey database. All the fields are mandatory."); ?></p>
                        
        <form name="an_config_form1" method="post" action="">
        <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y" />
            
        <table class="form-table">
            
        <tr valign="top">
        <th scope="row">
        <label for="<?php echo $db_option_host; ?>" ><?php _e("Database location:", 'menu-test' ); ?> </label>
        </th>
        <td>
        <input type="text" name="<?php echo $db_option_host; ?>" id="<?php echo $db_option_host; ?>" value="<?php echo $db_value_host; ?>" size="20" class="regular-text" />
        <span class="description"><?php _e("Location of the LimeSurvey database. In most cases, <strong>localhost</strong> will work!"); ?></span>
        </td>
        </tr>
            
        <tr valign="top">
        <th scope="row">
        <label for="<?php echo $db_option_name; ?>" ><?php _e("Database name:", 'menu-test' ); ?> </label>
        </th>
        <td>
        <input type="text" name="<?php echo $db_option_name; ?>" id="<?php echo $db_option_name; ?>" value="<?php echo $db_value_name; ?>" size="20" class="regular-text" />
        <span class="description"><?php _e("Name of the database LimeSurvey is using."); ?></span>
        </td>
        </tr>
            
        <tr valign="top">
        <th scope="row">
        <label for="<?php echo $db_option_user; ?>" ><?php _e("Database username:", 'menu-test' ); ?> </label>
        </th>
        <td>
        <input type="text" name="<?php echo $db_option_user; ?>" id="<?php echo $db_option_user; ?>" value="<?php echo $db_value_user; ?>" size="20" class="regular-text" />
        <span class="description"><?php _e("Username through which above database is being accessed by LimeSurvey. In most cases, <strong>root</strong> will work!"); ?></span>
        </td>
        </tr>
            
        <tr valign="top">
        <th scope="row">            
        <label for="<?php echo $db_option_pwd; ?>" ><?php _e("Database password:", 'menu-test' ); ?> </label>
        </th>
        <td>
        <input type="password" name="<?php echo $db_option_pwd; ?>" id="<?php echo $db_option_pwd; ?>" value="<?php echo $db_value_pwd; ?>" size="20" class="regular-text" />
        <span class="description"><?php _e("Password of the user which is accessing your LimeSurvey database."); ?></span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">            
        <label for="<?php echo $db_option_prefix; ?>" ><?php _e("Database table prefix:", 'menu-test' ); ?> </label>
        </th>
        <td>
        <input type="text" name="<?php echo $db_option_prefix; ?>" id="<?php echo $db_option_prefix; ?>" value="<?php echo $db_value_prefix; ?>" size="20" class="regular-text" />
        <span class="description"><?php _e("LimeSurvey table's prefix in the database you mentioned above."); ?></span>
        </td>
        </tr>
        
        <tr valign="top">
        <th scope="row">            
        <label for="<?php echo $db_option_url; ?>" ><?php _e("LimeSurvey base url:", 'menu-test' ); ?> </label>
        </th>
        <td>
        <input type="text" name="<?php echo $db_option_url; ?>" id="<?php echo $db_option_url; ?>" value="<?php echo $db_value_url; ?>" size="20" class="regular-text code" />
        <span class="description"><?php _e("Base url of your LimeSurvey setup (<span style='color:red;'>shouldn't end with a trailing slash('/')</span>) e.g. <span class='code'>http://localhost/limesurvey</span>."); ?></span>
        </td>
        </tr>
            
        </table>
            
        <p class="submit">
        <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
        </p>
            
        </form>
            
    </div>
            
            
            
    <?php            

}
//if user is anyone except administrator, show the public active surveys that a user can take!
else
{
    global $lsdb;
    //$lsdb = new wpdb( $db_value_user, $db_value_pwd, $db_value_name, $db_value_host );

    $public_surveys = $lsdb->get_results( "SELECT a.sid, b.surveyls_title, a.publicstatistics
                            	          FROM ".$db_value_prefix."surveys AS a 
                            			  INNER JOIN ".$db_value_prefix."surveys_languagesettings AS b 
                            			  ON ( surveyls_survey_id = a.sid AND surveyls_language = a.language ) 
                            			  WHERE surveyls_survey_id=a.sid 
                            			  AND surveyls_language=a.language 
                            			  AND a.active='Y'
                            			  AND a.listpublic='Y'
                            			  AND ((a.expires >= '".date("Y-m-d H:i")."') OR (a.expires is null))
                                          AND ((a.startdate <= '".date("Y-m-d H:i")."') OR (a.startdate is null))
                            			  ORDER BY surveyls_title" );
    
    //number of surveys active and public
    $count = 0;
    //public active surveys information
    $survey = array(); 
          
    if ( $public_surveys )
    {
        foreach ( $public_surveys as $surveyinfo )
        {
            $survey[$count]['sid']   = $surveyinfo->sid;
            $survey[$count]['title'] = $surveyinfo->surveyls_title;
            
            $count = $count + 1;
        }
    }        

    ?>
    <div class='wrap'>
        <h2> <?php echo __( 'Greetings!', 'menu-test' ); ?> </h2>
    </div>
    <br/>
    <?php 
    if ( $count ) //there exist some public and active surveys.
    {
        printf(__("You can take following %d public survey(s), if you haven't already. Take them now :"), $count);
        
        $temp = 0;
        while ( $temp < $count )
        {
            if ( $temp == 0)
            {
                echo "<ul type='disc'>";
            }
            printf(__("<li> <a href='".$db_value_url."/index.php?sid=".$survey[$temp]['sid']."' target='_blank'><strong> %s </strong></a> </li>"), $survey[$temp]['title']);
            
            if ( $temp == ( $count - 1 ) )
            {
                echo "</ul>";
            }
            $temp = $temp + 1;
        } //end while
    }
    else
    {
       echo _e("No public survey(s) to take at the moment."); 
    }
    
    
} //end else

?>