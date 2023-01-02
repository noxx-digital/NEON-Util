<?php

namespace Neon\Util;

/**
 * @param $var
 */
function dump( $var ): void
{
    ob_end_clean();
    echo "<pre>";
    var_dump( $var );
    echo "</pre>";
    ob_start("ob_callback");
}

/**
 * @param int $num_ch
 * @param string $charset
 *
 * @return string
 */
function rand_str( int $num_ch=0, string $charset="abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ1234567890" ): string
{
    if( !$num_ch ) return '';
    $char_arr = str_split( $charset, 1 );
    $rand_str = "";
    for( $i = 0; $i < $num_ch; $i++ )
        $rand_str .= $char_arr[rand( 0, $num_ch - 1 )];
    return $rand_str;
}


/**
 * get files in dir
 *
 * @param $path
 *
 * @return mixed
 */
function get_files_in_dir( $path ): array
{
    $files[$path] = scandir( $path );

    array_shift( $files[$path] );
    array_shift( $files[$path] );

    foreach( $files as $path => &$arr )
    {
        foreach( $files[$path] as $key => $file )
        {
            if ( is_dir( "$path/$file" ) )
            {
                $files["$path/$file"] = scandir( "$path/$file" );
                array_shift( $files["$path/$file"] );
                array_shift( $files["$path/$file"] );
            }
        }
    }
    return $files;
}

/**
 * @param string $path
 * @return bool
 */
function is_valid_filename( string $path ): bool
{
    // if( !preg_match('/^[\/\w\-. ]+$/', $user_id )) => if( !preg_match('#^[/\w\-. ]+$#', $user_id ))
    # check what happens if string empty
    return preg_match('#^[/\w\-. ]+$#', $path );
}



