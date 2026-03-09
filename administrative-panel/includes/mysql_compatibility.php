<?php
/**
 * mysqli to MySQLi Compatibility Layer for PHP 7+
 * This file provides backward compatibility for old mysqli_* functions
 * by wrapping them with mysqli_* equivalents
 */

// Only define these functions if they don't already exist (PHP 7+ has removed them)
if (!function_exists('mysqli_query')) {
    
    // Global default connection
    $GLOBALS['mysqli_default_connection'] = null;
    
    /**
     * Wrapper for mysqli_query
     */
    function mysqli_query($query, $link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) {
            trigger_error('No mysqli connection found', E_USER_WARNING);
            return false;
        }
        return mysqli_query($link, $query);
    }
    
    /**
     * Wrapper for mysqli_fetch_array
     */
    function mysqli_fetch_array($result, $result_type = MYSQLI_BOTH) {
        if (!$result) return false;
        return mysqli_fetch_array($result, $result_type);
    }
    
    /**
     * Wrapper for mysqli_fetch_assoc
     */
    function mysqli_fetch_assoc($result) {
        if (!$result) return false;
        return mysqli_fetch_assoc($result);
    }
    
    /**
     * Wrapper for mysqli_fetch_row
     */
    function mysqli_fetch_row($result) {
        if (!$result) return false;
        return mysqli_fetch_row($result);
    }
    
    /**
     * Wrapper for mysqli_num_rows
     */
    function mysqli_num_rows($result) {
        if (!$result) return 0;
        return mysqli_num_rows($result);
    }
    
    /**
     * Wrapper for mysqli_affected_rows
     */
    function mysqli_affected_rows($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return 0;
        return mysqli_affected_rows($link);
    }
    
    /**
     * Wrapper for mysqli_insert_id
     */
    function mysqli_insert_id($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return 0;
        return mysqli_insert_id($link);
    }
    
    /**
     * Wrapper for mysqli_error
     */
    function mysqli_error($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return '';
        return mysqli_error($link);
    }
    
    /**
     * Wrapper for mysqli_errno
     */
    function mysqli_errno($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return 0;
        return mysqli_errno($link);
    }
    
    /**
     * Wrapper for mysqli_real_escape_string
     */
    function mysqli_real_escape_string($string, $link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) {
            // Fallback to basic escaping if no connection
            return addslashes($string);
        }
        return mysqli_real_escape_string($link, $string);
    }
    
    /**
     * Wrapper for mysqli_escape_string (alias of mysqli_real_escape_string)
     */
    function mysqli_escape_string($string, $link = null) {
        return mysqli_real_escape_string($string, $link);
    }
    
    /**
     * Wrapper for mysqli_free_result
     */
    function mysqli_free_result($result) {
        if (!$result) return false;
        return mysqli_free_result($result);
    }
    
    /**
     * Wrapper for mysqli_close
     */
    function mysqli_close($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return false;
        return mysqli_close($link);
    }
    
    /**
     * Wrapper for mysqli_data_seek
     */
    function mysqli_data_seek($result, $row_number) {
        if (!$result) return false;
        return mysqli_data_seek($result, $row_number);
    }
    
    /**
     * Wrapper for mysqli_fetch_field
     */
    function mysqli_fetch_field($result, $field_offset = 0) {
        if (!$result) return false;
        mysqli_field_seek($result, $field_offset);
        return mysqli_fetch_field($result);
    }
    
    /**
     * Wrapper for mysqli_num_fields
     */
    function mysqli_num_fields($result) {
        if (!$result) return 0;
        return mysqli_num_fields($result);
    }
    
    /**
     * Wrapper for mysqli_field_name (using mysqli_fetch_field_direct)
     */
    function mysqli_field_name($result, $field_offset) {
        if (!$result) return false;
        $field_info = mysqli_fetch_field_direct($result, $field_offset);
        return $field_info ? $field_info->name : false;
    }
    
    /**
     * Wrapper for mysqli_field_type (using mysqli_fetch_field_direct)
     */
    function mysqli_field_type($result, $field_offset) {
        if (!$result) return false;
        $field_info = mysqli_fetch_field_direct($result, $field_offset);
        if (!$field_info) return false;
        
        // Map mysqli type constants to old mysqli type names
        $type_map = array(
            MYSQLI_TYPE_DECIMAL     => 'real',
            MYSQLI_TYPE_TINY        => 'int',
            MYSQLI_TYPE_SHORT       => 'int',
            MYSQLI_TYPE_LONG        => 'int',
            MYSQLI_TYPE_FLOAT       => 'real',
            MYSQLI_TYPE_DOUBLE      => 'real',
            MYSQLI_TYPE_NULL        => 'null',
            MYSQLI_TYPE_TIMESTAMP   => 'timestamp',
            MYSQLI_TYPE_LONGLONG    => 'int',
            MYSQLI_TYPE_INT24       => 'int',
            MYSQLI_TYPE_DATE        => 'date',
            MYSQLI_TYPE_TIME        => 'time',
            MYSQLI_TYPE_DATETIME    => 'datetime',
            MYSQLI_TYPE_YEAR        => 'year',
            MYSQLI_TYPE_NEWDATE     => 'date',
            MYSQLI_TYPE_VARCHAR     => 'string',
            MYSQLI_TYPE_BIT         => 'int',
            MYSQLI_TYPE_NEWDECIMAL  => 'real',
            MYSQLI_TYPE_ENUM        => 'string',
            MYSQLI_TYPE_SET         => 'string',
            MYSQLI_TYPE_TINY_BLOB   => 'blob',
            MYSQLI_TYPE_MEDIUM_BLOB => 'blob',
            MYSQLI_TYPE_LONG_BLOB   => 'blob',
            MYSQLI_TYPE_BLOB        => 'blob',
            MYSQLI_TYPE_VAR_STRING  => 'string',
            MYSQLI_TYPE_STRING      => 'string',
            MYSQLI_TYPE_GEOMETRY    => 'string'
        );
        
        return isset($type_map[$field_info->type]) ? $type_map[$field_info->type] : 'unknown';
    }
    
    /**
     * Wrapper for mysqli_get_client_info
     */
    function mysqli_get_client_info() {
        return mysqli_get_client_info();
    }
    
    /**
     * Wrapper for mysqli_get_host_info
     */
    function mysqli_get_host_info($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return '';
        return mysqli_get_host_info($link);
    }
    
    /**
     * Wrapper for mysqli_get_proto_info
     */
    function mysqli_get_proto_info($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return 0;
        return mysqli_get_proto_info($link);
    }
    
    /**
     * Wrapper for mysqli_get_server_info
     */
    function mysqli_get_server_info($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return '';
        return mysqli_get_server_info($link);
    }
    
    /**
     * Wrapper for mysqli_info
     */
    function mysqli_info($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return '';
        return mysqli_info($link);
    }
    
    /**
     * Wrapper for mysqli_stat
     */
    function mysqli_stat($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return '';
        return mysqli_stat($link);
    }
    
    /**
     * Wrapper for mysqli_thread_id
     */
    function mysqli_thread_id($link = null) {
        if ($link === null) {
            $link = $GLOBALS['mysqli_default_connection'];
        }
        if (!$link) return 0;
        return mysqli_thread_id($link);
    }
    
    /**
     * Set default mysqli connection
     */
    function mysqli_set_default_connection($link) {
        $GLOBALS['mysqli_default_connection'] = $link;
    }
}

// Set the default connection to conn1 if it exists
if (isset($conn1)) {
    mysqli_set_default_connection($conn1);
}
?>
