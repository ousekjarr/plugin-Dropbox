<h2>Select Files From Dropbox</h2>

<?php
    $filePath = PLUGIN_DIR . DIRECTORY_SEPARATOR . 'Dropbox' . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR;
    $fileNames = dropbox_dir_list($filePath);
?>

<?php if ($fileNames == NULL): ?>
    <p>No files have been uploaded to the dropbox.</p>
<?php else: ?>
    <script type="text/javascript">
        function dropboxSelectAllCheckboxes(checked) {
    	    jQuery('#dropbox-file-checkboxes li:visible input').each(function() {
    			var v = jQuery(this);
    			v.attr('checked', checked);
    		});
    	}
    	
    	function dropboxFilterFiles() {
    	    var filter = jQuery.trim(jQuery('#dropbox-file-filter').val().toLowerCase());
    	    var someHidden = false;
    	    jQuery('#dropbox-file-checkboxes input').each(function() {
    			var v = jQuery(this);
    			if (filter != '') {
                    if (v.val().toLowerCase().match(filter)) {
                        v.parent().show();
                    } else {
                        v.parent().hide();
                        someHidden = true;
                    }
    			} else {
    			    v.parent().show();
    			}
    		});
    		if (someHidden) {
    		    jQuery('#dropbox-show-all-span').show();
    		} else {
    		    jQuery('#dropbox-show-all-span').hide();
    		}
    	}

		function dropboxNoEnter(e) {
            var e  = (e) ? e : ((event) ? event : null);
            var node = (e.target) ? e.target : ((e.srcElement) ? e.srcElement : null);
            if ((e.keyCode == 13) && (node.type=="text")) {return false;}
        }

        jQuery(document).ready(function () {
            jQuery('#dropbox-select-all').click(function () {
                dropboxSelectAllCheckboxes(true);
                return false;
            });

            jQuery('#dropbox-unselect-all').click(function () {
                dropboxSelectAllCheckboxes(false);
                return false;
            });

            jQuery('#dropbox-show-all').click(function () {
                jQuery('#dropbox-file-filter').val('');
                dropboxFilterFiles();
                return false;
            });

            jQuery('#dropbox-file-filter').keyup(function () {
                dropboxFilterFiles();
                return false;
            }).keypress(dropboxNoEnter);

            jQuery('#dropbox-show-all-span').hide();
    	});
    </script>
    <p>To filter the files, enter part of the filename below:</p>
    <p><input id="dropbox-file-filter" name="dropbox-file-filter" value="" /></p>
    <p>Select the files you wish to upload.</p>
    <p><a id="dropbox-select-all" href="#">Select All</a> / <a id="dropbox-unselect-all" href="#">Unselect All</a><span id="dropbox-show-all-span"> / <a id="dropbox-show-all" href="#">Show All</a></span></p>
    <ul id="dropbox-file-checkboxes">
        <?php foreach ($fileNames as $fileName): ?>
        <li><input type="checkbox" name="dropbox-files[]" value="<?php echo html_escape($fileName); ?>"/><?php echo html_escape($fileName); ?></li>
        <?php endforeach; ?>
    </ul>
   
<?php endif;
