<?php

// No direct access to this file
if(!defined('ABSPATH')) {
	exit;
}
?>

<?php if(isset($_GET['settings-updated'])) : ?>

	<?php if(get_option('hotjar_site_id') == '') : ?>
		<div id="message" class="notice notice-warning is-dismissible">
			<p><?=__('Hotjar script is now disabled.', 'custom-hotjar')?></p>
		</div>
	<?php else : ?>
		<div id="message" class="notice notice-success is-dismissible">
            <p><?=__('Hotjar script is now enabled.', 'custom-hotjar')?></p>
		</div>
	<?php endif; ?>

<?php endif; ?>

<div class="wrap">
	<h1>Hotjar Tracking Code</h1>
	<div class="card">
		<p><?=sprintf(__('Input Hotjar ID below to connect Hotjar and %s.', 'custom-hotjar'), get_option( 'blogname'))?></p>
		<p><?=sprintf(wp_kses(__('Visit <a href="%s" target="_blank">Hotjar site list</a> to find website unique Hotjar ID.', 'custom-hotjar'), ['a' => ['href' => [], 'target' => '_blank']]), esc_url('https://insights.hotjar.com/site/list'))?></p>

		<form method="post" action="options.php">
			<?=settings_fields( 'custom-hotjar' )?>
			<?=do_settings_sections('custom-hotjar')?>

			<div>
				<table class="form-table">
					<tbody>
						<tr>
							<th scope="row">
								<label for="hotjar_site_id"><?=__('Hotjar ID', 'custom-hotjar')?></label>
							</th>
							<td>
								<input type="number" name="hotjar_site_id" id="hotjar_site_id" value="<?=esc_attr(get_option('hotjar_site_id'))?>">
							</td>
						</tr>
					</tbody>
				</table>
				<p class="description"><?=__('Leave the input blank to disable Hotjar tracking.', 'custom-hotjar')?></p>
			</div>

			<?=submit_button()?>

		</form>
	</div>
</div>