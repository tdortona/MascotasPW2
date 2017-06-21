<?php

$files = glob('imagenes/*');

foreach ($files as $file) 
{
	if (is_file($file))
	{
		unlink($file);
	}
}

echo 'listo!';

?>