<?php
/**
 * @version     1.0.0
 * @package     com_db8download
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Peter Martin <joomla@db8.nl> - http://www.db8.nl
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_db8download', JPATH_SITE);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_db8download/assets/js/form.js');

/**/
?>
<script type="text/javascript">
	if (jQuery === 'undefined') {
		document.addEventListener("DOMContentLoaded", function (event) {
			jQuery('#form-user').submit(function (event) {
				
			});

			
			jQuery('input:hidden.file').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('filehidden')){
					jQuery('#jform_file option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_file").trigger("liszt:updated");
		});
	} else {
		jQuery(document).ready(function () {
			jQuery('#form-user').submit(function (event) {
				
			});

			
			jQuery('input:hidden.file').each(function(){
				var name = jQuery(this).attr('name');
				if(name.indexOf('filehidden')){
					jQuery('#jform_file option[value="' + jQuery(this).val() + '"]').attr('selected',true);
				}
			});
					jQuery("#jform_file").trigger("liszt:updated");
		});
	}
</script>

<div class="user-edit front-end-edit">
	<?php if (!empty($this->item->id)): ?>
		<h1>Edit <?php echo $this->item->id; ?></h1>
	<?php else: ?>
		<h1>Add</h1>
	<?php endif; ?>

	<form id="form-user" action="<?php echo JRoute::_('index.php?option=com_db8download&task=user.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
		
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />

	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('name'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('name'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('email'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('email'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('ip_address'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('ip_address'); ?></div>
	</div>
	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('file'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('file'); ?></div>
	</div>
	<?php foreach((array)$this->item->file as $value): ?>
		<?php if(!is_array($value)): ?>
			<input type="hidden" class="file" name="jform[filehidden][<?php echo $value; ?>]" value="<?php echo $value; ?>" />
		<?php endif; ?>
	<?php endforeach; ?>
	<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />

	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />

	<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />

	<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />

	<div class="control-group">
		<div class="control-label"><?php echo $this->form->getLabel('created'); ?></div>
		<div class="controls"><?php echo $this->form->getInput('created'); ?></div>
	</div>
	<?php if(empty($this->item->created_by)): ?>
		<input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>" />
	<?php else: ?>
		<input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>" />
	<?php endif; ?>
		<div class="control-group">
			<div class="controls">

				<?php if ($this->canSave): ?>
					<button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
				<?php endif; ?>
				<a class="btn" href="<?php echo JRoute::_('index.php?option=com_db8download&task=userform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
			</div>
		</div>

		<input type="hidden" name="option" value="com_db8download" />
		<input type="hidden" name="task" value="userform.save" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
