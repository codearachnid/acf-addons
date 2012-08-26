<?php

if(!class_exists('WP_List_Table'))
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');

if(!class_exists('ACF_Addons_List_Table')) {
	class ACF_Addons_List_Table extends WP_List_Table {

	    function __construct(){
	        global $status, $page;
	                
	        //Set parent defaults
	        parent::__construct( array(
	            'singular'  => 'movie',     //singular name of the listed records
	            'plural'    => 'movies',    //plural name of the listed records
	            'ajax'      => false        //does this table support ajax?
	        ) );
	        
	    }

	    function column_default($item, $column_name){
	        switch($column_name){
	        	case 'actions':
	        		return $item['status'] ? '<a addon="' . $item['ID'] . '" class="install disabled">Install</a> <a addon="' . $item['ID'] . '" class="uninstall">Uninstall</a>' : '<a addon="' . $item['ID'] . '" class="install">Install</a> <a addon="' . $item['ID'] . '" class="uninstall disabled">Uninstall</a>';
	        	case 'title':
	        		$title = isset($item['more_link']) && $item['more_link'] != '' ? '<a href="' . $item['more_link'] . '" target="_blank">' . $item[$column_name] . '</a>' : $item[$column_name];
	        		$title .= isset($item['version']) && $item['version'] != '' ? ' (v '.$item['version'] . ')' : '';
	        		return $title;
        		case 'author':
	        		return isset($item['more_author']) && $item['more_author'] != '' ? '<a href="' . $item['more_author'] . '" target="_blank">' . $item[$column_name] . '</a>' : $item[$column_name];
	            default:
		            return $item[$column_name];
	                // return print_r($item,true); //Show the whole array for troubleshooting purposes
	        }
	    }	    

	    function get_columns(){
	        $columns = array(
	            'actions'	=> 'Actions',
	            'title'     	=> 'Title',
	            // 'version' => 'Version',
	            'description'    => 'Description',
	            'author'  => 'Author'
	        );
	        return $columns;
	    }

	    function get_sortable_columns() {
	        $sortable_columns = array(
	            'title'     => array('title',true)     //true means its already sorted
	        );
	        return $sortable_columns;
	    }

	    function prepare_items( $data = null ) {

	        $columns = $this->get_columns();
	        $hidden = array();
	        $sortable = $this->get_sortable_columns();

	        $this->_column_headers = array($columns, $hidden, $sortable);

	        function usort_reorder($a,$b){
	            $orderby = (!empty($_REQUEST['orderby'])) ? $_REQUEST['orderby'] : 'title'; //If no sort, default to title
	            $order = (!empty($_REQUEST['order'])) ? $_REQUEST['order'] : 'asc'; //If no order, default to asc
	            $result = strcmp($a[$orderby], $b[$orderby]); //Determine sort order
	            return ($order==='asc') ? $result : -$result; //Send final sort direction to usort
	        }
	        usort($data, 'usort_reorder');

	        $per_page = ACF_Addons::instance()->per_page;
	        $current_page = $this->get_pagenum();
	        $total_items = count($data);

	        $data = array_slice($data,(($current_page-1)*$per_page),$per_page);
	        $this->items = $data;

	        $this->set_pagination_args( array(
	            'total_items' => $total_items,
	            'per_page'    => $per_page,
	            'total_pages' => ceil($total_items/$per_page)
	        ) );
	    }
	    
	}
}