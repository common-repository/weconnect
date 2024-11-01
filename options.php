<div class="wrap">
  <h2><?php _e( 'WeConnect.chat - settings', 'WeConnectchat'); ?></h2>

  <hr />
  <div id="poststuff">
  <div id="post-body" class="metabox-holder columns-2">
    <div id="post-body-content">
      <div class="postbox">
        <div class="inside">
          <form name="dofollow" action="options.php" method="post">

            <?php
            settings_fields( 'WeConnectchat-settings-group' );
            $settings = get_option( 'WeConnectchat-plugin-settings' );          
            $script = (array_key_exists('script', $settings) ? $settings['script'] : '');
            $showOn = (array_key_exists('showOn', $settings) ? $settings['showOn'] : 'all');

            ?>


            <p>
              <h3>Show WeConnect.chat interface on: </h3>
              <input type="radio" name="WeConnectchat-plugin-settings[showOn]"" value="all" id="all" <?php checked('all', $showOn); ?>> <label for="all"><?php _e( 'All Pages', 'WeConnectchat'); ?> </label>
              <input type="radio" name="WeConnectchat-plugin-settings[showOn]"" value="home" id="home" <?php checked('home', $showOn); ?>> <label for="home"><?php _e( 'Homepage Only', 'WeConnectchat'); ?> </label>
              <input type="radio" name="WeConnectchat-plugin-settings[showOn]"" value="nothome" id="nothome" <?php checked('nothome', $showOn); ?>> <label for="nothome"><?php _e( 'All Pages except Homepage', 'WeConnectchat'); ?> </label>
              <input type="radio" name="WeConnectchat-plugin-settings[showOn]"" value="none" id="none" <?php checked('none', $showOn); ?>> <label for="none"><?php _e( 'No Pages', 'WeConnectchat'); ?> </label>
            </p>


             <h3 class="cc-labels" for="script"><?php _e( 'Chat interface snippet:', 'WeConnectchat'); ?></h3>

            <textarea style="width:98%;" rows="10" cols="57" id="script" name="WeConnectchat-plugin-settings[script]"><?php echo esc_html( $script ); ?></textarea>



            <p class="submit">
              <input class="button button-primary" type="submit" name="Submit" value="<?php _e( 'Save settings', 'WeConnectchat'); ?>" />
            </p>
             <h3 class="cc-labels"><?php _e( 'If you are not an existing WeConnect.chat user, <a href=https://app.weconnect.chat/SignUp target="_blank">Sign Up</a> ', 'WeConnectchat'); ?></h3>

          </form>
        </div>
    </div>
    </div>


    </div>
  </div>
</div>
