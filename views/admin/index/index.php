<?php head(array('title' => 'Dropbox', 'bodyclass' => 'dropbox')); ?>

<?php 
    // The following includes the Autocompleter class.
    echo js('scriptaculous', 'javascripts', array('controls'));  
?>

<script type="text/javascript" charset="utf-8">

    // Tags autocomplete
    Event.observe(window, 'load', function(){
        new Ajax.Autocompleter("dropbox-tags", "dropbox-tags-autocomplete", 
        <?php echo js_escape(uri(array('controller'=>'tags', 'action'=>'autocomplete'), 'default', array(), true)); ?>, {
            tokens: ',',
            paramName: 'tag_start'
        });
    });

</script>

<h1>Dropbox Plugin</h1>

<div id="primary">
	<?php echo flash(); ?>
	
	<p>To batch upload files, upload them to the /files/ folder of the Dropbox plugin.  After refreshing this page, they should appear listed below.</p>    
    
    <form action="<?php echo html_escape(uri(array('action'=>'add'))); ?>" method="post" accept-charset="utf-8">

        <?php include 'dropboxlist.php'; ?>

	    <fieldset>
    			<legend>Set Properties for Batch Upload</legend>
    			<p>Any properties set will be applied to each file uploaded - to customize properties, edit individual items after creating them.</p>
    			<div class="field">
    				<div class="label">Item is Public:</div> 
    				<div class="radio">
    				    <label class="radiolabel">
    				        <input type="radio" name="dropbox-public" id="dropbox-public-no" value="0" />No
    				    </label>
    				    <label class="radiolabel">
    				        <input type="radio" name="dropbox-public" id="dropbox-public-yes" value="1"  checked="checked"/>Yes
    				    </label>
    				</div>
    			</div>
    			<div class="field">
    				<div class="label">Item is Featured:</div> 
    				<div class="radio">
    				    <label class="radiolabel">
    				        <input type="radio" name="dropbox-featured" id="dropbox-featured-no" value="0" checked="checked" />No
    				    </label>
    				    <label class="radiolabel">
    				        <input type="radio" name="dropbox-featured" id="dropbox-featured-yes" value="1" />Yes
    				    </label>
    				</div>
    			</div>
    	</fieldset>

	    <fieldset id="collection-metadata">
    		<legend>Collection Metadata</legend>
            <div class="field">
            <?php echo label('dropbox-collection-id', 'Collection');?>
            <div class="inputs">
            	<?php echo select_collection(array('name'=>'dropbox-collection-id', 'id'=>'dropbox-collection-id'),$item->collection_id); ?>
            </div>
            </div>
    	</fieldset>

    	<fieldset>
    		<legend>Tagging</legend>
    		<p>Separate tags with commas (lorem,ipsum,dolor sit,amet).</p>
    		<div class="input">
    			<label for="dropbox-tags">Your Tags</label>
    			<input type="text" name="dropbox-tags" id="dropbox-tags" class="textinput" />
    			<div id="dropbox-tags-autocomplete" class="autocomplete"></div>
    		</div>
    	</fieldset>
    	
        <div class="input">
    		<input type="submit" class="submit" name="submit" id="dropbox-upload-files" value="Upload Files as Items" />
        </div>
	    
	</form>

	<p>Further information about using and installing the Dropbox plugin can be found on the <a href="http://omeka.org/codex/dropbox_plugin">Omeka Codex</a></p>

</div>

<?php foot(); ?>