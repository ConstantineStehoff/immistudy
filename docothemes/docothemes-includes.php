<?php
$immistudy_includes = apply_filters('immistudy_theme_includes',
	array(	'docothemes/docothemes-utils.php',
			'docothemes/immistudy/immistudy-functions.php'
	)
);

foreach ($immistudy_includes as $include) {
	locate_template($include, true);
}
?>