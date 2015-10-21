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
$elements = ModDb8downloadHelper::getList($params);
?>

<?php if (!empty($elements)) : ?>
    <table class="table">
        <?php foreach ($elements as $element): ?>
            <tr>
                <th><?php echo ModDb8downloadHelper::renderTranslatableHeader($params, $params->get('field')); ?></th>
                <td><?php echo ModDb8downloadHelper::renderElement($params->get('table'), $params->get('field'), $element->{$params->get('field')}); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>