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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_db8download');
$canEdit = $user->authorise('core.edit', 'com_db8download');
$canCheckin = $user->authorise('core.manage', 'com_db8download');
$canChange = $user->authorise('core.edit.state', 'com_db8download');
$canDelete = $user->authorise('core.delete', 'com_db8download');
?>

<form action="<?php echo JRoute::_('index.php?option=com_db8download&view=files'); ?>" method="post" name="adminForm"
      id="adminForm">

    <?php echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
    <table class="table table-striped" id="fileList">
        <thead>
        <tr>
            <?php if (isset($this->items[0]->state)): ?>
                <th width="5%">
                    <?php echo JHtml::_('grid.sort', 'JPUBLISHED', 'a.state', $listDirn, $listOrder); ?>
                </th>
            <?php endif; ?>

            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_NAME', 'a.name', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_ALIAS', 'a.alias', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_CATID', 'a.catid', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_FILENAME', 'a.filename', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_IMAGE', 'a.image', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_ACCESS', 'a.access', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_LANGUAGE', 'a.language', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_CREATED', 'a.created', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_CREATED_BY', 'a.created_by', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_HITS', 'a.hits', $listDirn, $listOrder); ?>
            </th>
            <th class=''>
                <?php echo JHtml::_('grid.sort', 'COM_DB8DOWNLOAD_FILES_TAGS', 'a.tags', $listDirn, $listOrder); ?>
            </th>


            <?php if (isset($this->items[0]->id)): ?>
                <th width="1%" class="nowrap center hidden-phone">
                    <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
            <?php endif; ?>

            <?php if ($canEdit || $canDelete): ?>
                <th class="center">
                    <?php echo JText::_('COM_DB8DOWNLOAD_FILES_ACTIONS'); ?>
                </th>
            <?php endif; ?>

        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
                <?php echo $this->pagination->getListFooter(); ?>
            </td>
        </tr>
        </tfoot>
        <tbody>
        <?php foreach ($this->items as $i => $item) : ?>
            <?php $canEdit = $user->authorise('core.edit', 'com_db8download'); ?>


            <tr class="row<?php echo $i % 2; ?>">

                <?php if (isset($this->items[0]->state)): ?>
                    <?php $class = ($canEdit || $canChange) ? 'active' : 'disabled'; ?>
                    <td class="center">
                        <a class="btn btn-micro <?php echo $class; ?>"
                           href="<?php echo ($canEdit || $canChange) ? JRoute::_('index.php?option=&task=file.publish&id=' . $item->id . '&state=' . (($item->state + 1) % 2), false, 2) : '#'; ?>">
                            <?php if ($item->state == 1): ?>
                                <i class="icon-publish"></i>
                            <?php else: ?>
                                <i class="icon-unpublish"></i>
                            <?php endif; ?>
                        </a>
                    </td>
                <?php endif; ?>

                <td>
                    <?php if (isset($item->checked_out) && $item->checked_out) : ?>
                        <?php echo JHtml::_('jgrid.checkedout', $i, $item->editor, $item->checked_out_time, 'files.', $canCheckin); ?>
                    <?php endif; ?>
                    <a href="<?php echo JRoute::_('index.php?option=com_db8download&view=file&id=' . (int)$item->id); ?>">
                        <?php echo $this->escape($item->name); ?></a>
                </td>
                <td>
                    <?php echo $item->alias; ?>
                </td>
                <td>
                    <?php echo $item->catid; ?>
                </td>
                <td>

                    <?php
                    if (!empty($item->filename)):
                        $uploadPath = 'administrator' . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . 'com_db8download' . DIRECTORY_SEPARATOR . 'com_db8download' . DIRECTORY_SEPARATOR . $item->filename;
                        echo '<a href="' . JRoute::_(JUri::base() . $uploadPath, false) . '" target="_blank" title="See the filename">' . $item->filename . '</a>';
                    else:
                        echo $item->filename;
                    endif; ?>
                </td>
                <td>
                    <?php echo $item->image; ?>
                </td>
                <td>
                    <?php echo $item->access; ?>
                </td>
                <td>
                    <?php echo $item->language; ?>
                </td>
                <td>
                    <?php echo $item->created; ?>
                </td>
                <td>
                    <?php echo JFactory::getUser($item->created_by)->name; ?>                </td>
                <td>
                    <?php echo $item->hits; ?>
                </td>
                <td>
                    <?php echo $item->tags; ?>
                </td>


                <?php if (isset($this->items[0]->id)): ?>
                    <td class="center hidden-phone">
                        <?php echo (int)$item->id; ?>
                    </td>
                <?php endif; ?>

                <?php if ($canEdit || $canDelete): ?>
                    <td class="center">
                    </td>
                <?php endif; ?>

            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if ($canCreate): ?>
        <a href="<?php echo JRoute::_('index.php?option=com_db8download&task=fileform.edit&id=0', false, 2); ?>"
           class="btn btn-success btn-small"><i
                class="icon-plus"></i> <?php echo JText::_('COM_DB8DOWNLOAD_ADD_ITEM'); ?></a>
    <?php endif; ?>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>

<script type="text/javascript">

    jQuery(document).ready(function () {
        jQuery('.delete-button').click(deleteItem);
    });

    function deleteItem() {
        var item_id = jQuery(this).attr('data-item-id');
        if (confirm("<?php echo JText::_('COM_DB8DOWNLOAD_DELETE_MESSAGE'); ?>")) {
            window.location.href = '<?php echo JRoute::_('index.php?option=com_db8download&task=fileform.remove&id=', false, 2) ?>' + item_id;
        }
    }
</script>


