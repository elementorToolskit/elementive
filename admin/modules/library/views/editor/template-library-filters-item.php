<?php
/**
 * Template Library Header Template
 */
?>
<label class="elementive-template-library-filter-label">
	<input type="radio" value="{{ slug }}" <# if ( '' === slug ) { #> checked<# } #> name="elementive-library-filter">
	<span>{{ title }}</span>
</label>