<?php
// $Id: views-view-table.tpl.php,v 1.8 2009/01/28 00:43:43 merlinofchaos Exp $
/**
 * @file views-view-table.tpl.php
 * Template to display a view as a table.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $header: An array of header labels keyed by field id.
 * - $fields: An array of CSS IDs to use for each field id.
 * - $class: A class or classes to apply to the table, based on settings.
 * - $row_classes: An array of classes to apply to each row, indexed by row
 *   number. This matches the index in $rows.
 * - $rows: An array of row items. Each row is an array of content.
 *   $rows are keyed by row number, fields within rows are keyed by field ID.
 * @ingroup views_templates
 */
	global $base_url;
	//print_r($rows); exit;
?>
<div class="view-wrapper">
	<?php foreach ($rows as $count => $row): ?>
		<?php $node = node_load($row['nid']); ?>
		<div class="views-row <?php print implode(' ', $row_classes[$count]); ?>">		
			<?php foreach ($row as $field => $content): ?>
				<?php if($field != 'uid' && $field != 'nid'): ?>
					<div class="views-field views-field-<?php print $fields[$field]; ?>">
						<?php 	
							print $content;
						?>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>
			<div class="views-row-comment">
				<?php print comment_render($node); ?>
				<?php print drupal_get_form('comment_form', array('nid' => $node->nid)); ?>
			</div>			
		</div>
	<?php endforeach; ?>
</div>
