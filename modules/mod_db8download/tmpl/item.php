<?php
/**
 * @version     1.0.0
 * @package     com_db8download
 * @subpackage  mod_db8download
 * @copyright   Copyright (C) 2015. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Peter Martin <joomla@db8.nl> - http://www.db8.nl
 */
defined('_JEXEC') or die;
$element = ModDb8downloadHelper::getItem($params);
?>

<?php if (!empty($element)) : ?>
    <div>
        <?php $fields = get_object_vars($element); ?>
        <?php foreach ($fields as $field_name => $field_value): ?>
            <?php if (ModDb8downloadHelper::shouldAppear($field_name)): ?>
                <div class="row">
                    <div class="span4"><strong><?php echo ModDb8downloadHelper::renderTranslatableHeader($params, $field_name); ?></strong></div>
                    <div class="span8"><?php echo ModDb8downloadHelper::renderElement($params->get('item_table'), $field_name, $field_value); ?></div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>