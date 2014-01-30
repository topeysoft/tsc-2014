	<table class="form-table"><!-- Grab a hot cup of coffee, yes we're using tables! -->
            
              <tr valign="top"><th scope="row"><label for="tsc_logo_url">Website Logo</label></th>
                <td>
                  
                    <input id="upload_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', 'topeysoft' ); ?>" /> 
                    <input id="tsc_logo_url" name="sa_options[site_logo]" type="text" value="<?php  esc_attr_e($settings['site_logo']); ?>" /><br>

                    <img id="tsc_logo_preview" src="<?php  esc_attr_e($settings['site_logo']); ?>" style="max-height:40px" />
                </td>
                </tr>
                 <tr valign="top"><th scope="row"><label for="tsc_icon_url">Website favicon</label></th>
                <td>
                <input id="upload_icon_button" type="button" class="button" value="<?php _e( 'Upload Icon', 'topeysoft' ); ?>" /> 
                <input id="tsc_icon_url" name="sa_options[site_icon]" type="text" value="<?php  esc_attr_e($settings['site_icon']); ?>" />
                <br>

                <img id="tsc_icon_preview" src="<?php  esc_attr_e($settings['site_icon']); ?>" style="max-height:20px" />
                </td>
                </tr>
                
                 <tr valign="top"><th scope="row"><label for="footer_copyright">Footer Copyright Notice</label></th>
                <td>
                <input id="footer_copyright" name="sa_options[footer_copyright]" type="text" value="<?php  esc_attr_e($settings['footer_copyright']); ?>" />
                </td>
                </tr>
            
                <tr valign="top"><th scope="row"><label for="intro_text">Intro Text</label></th>
                <td>
                <textarea id="intro_text" name="sa_options[intro_text]" rows="5" cols="30"><?php echo stripslashes($settings['intro_text']); ?></textarea>
                </td>
                </tr>
            
                <tr valign="top"><th scope="row"><label for="featured_cat">Featured Category</label></th>
                <td>
                <select id="featured_cat" name="sa_options[featured_cat]">
                <?php
                foreach ( $sa_categories as $category ) :
                    $label = $category['label'];
                    $selected = '';
                    if ( $category['value'] == $settings['featured_cat'] )
                        $selected = 'selected="selected"';
                    echo '<option style="padding-right: 10px;" value="' . esc_attr( $category['value'] ) . '" ' . $selected . '>' . $label . '</option>';
                endforeach;
                ?>
                </select>
                </td>
                </tr>
            
                <tr valign="top"><th scope="row">Layout View</th>
                <td>
                <?php 
				
                global $sa_layouts;
            foreach( $sa_layouts as $layout ) : ?>
                <input type="radio" id="<?php echo $layout['value']; ?>" name="sa_options[layout_view]" value="<?php esc_attr_e( $layout['value'] ); ?>" <?php checked( $settings['layout_view'], $layout['value'] ); ?> />
                <label for="<?php echo $layout['value']; ?>"><?php echo $layout['label']; ?></label><br />
                <?php endforeach;
                ?>
                
                </td>
                </tr>
            
                <tr valign="top"><th scope="row">Author Credits</th>
                <td>
                <input type="checkbox" id="author_credits" name="sa_options[author_credits]" value="1" <?php checked( true, $settings['author_credits'] ); ?> />
                <label for="author_credits">Show Author Credits</label>
                </td>
                </tr>
            
                </table>