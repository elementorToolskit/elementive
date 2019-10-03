<?php
/**
 * Template item
 */
?>
<# var activeTab = window.ElementiveLibreryData.tabs[ type ]; #>
<div class="elementor-template-library-template-body">
	<# if ( 'elementive-local' !== source ) { #>
	<div class="elementor-template-library-template-screenshot">
		<# if ( 'elementive-local' !== source ) { #>
		<div class="elementor-template-library-template-preview">
			<i class="fa fa-search-plus"></i>
		</div>
		<# } #>
		<img src="{{ thumbnail }}" alt="">
	</div>
	<# } #>
</div>
<div class="elementor-template-library-template-controls">
	<# if ( 'pro' != package ) { #>
		<button class="elementor-template-library-template-action elementive-template-library-template-insert elementor-button elementor-button-success">
			<i class="eicon-file-download"></i>
			<span class="elementor-button-title"><?php esc_html_e( 'Insert', 'elementive' ); ?></span>
		</button>
	<# } else { #>
		<a class="elementor-template-library-template-action elementor-button elementive-template-library-template-go-pro" href="https://go.wpmet.com/ekitpro" target="_blank">
			<i class="eicon-heart"></i><span class="elementor-button-title"><?php
				esc_html_e( 'Go Pro', 'elementive' );
			?></span>
		</a>
	<# } #>
</div>
<# if ( 'elementive-local' === source || true == activeTab.settings.show_title ) { #>
<div class="elementor-template-library-template-name">{{{ title }}}</div>
<# } else { #>
<div class="elementor-template-library-template-name-holder"></div>
<# } #>
<# if ( 'elementive-local' === source ) { #>
<div class="elementor-template-library-template-type">
	<?php esc_html_e( 'Type:', 'elementive' ); ?> {{{ typeLabel }}}
</div>
<# } #>