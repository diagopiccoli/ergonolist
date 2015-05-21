<?php

	function autoload($arrLoad)
	{
		foreach($arrLoad as $load) {
			require($load);			
		}
	}
	
?>