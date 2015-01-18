<?php 

require_once '../config/constants.php';

//load system files
function autoload( $classname )
	{
		$classname = strtolower( $classname );

		$filename	=	$classname . '.php';
		$path		=	false;

		if ( file_exists( SYS_FOLDER . $filename ) )
		{
			$path 	=	SYS_FOLDER . $filename;
		}

		 include_once( $path );
	}

	spl_autoload_register( "autoload" );

 ?>