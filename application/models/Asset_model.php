<?php
defined('BASEPATH') or exit('No direct script access allowed');

// asset_model.php Chris Dart Mar 9, 2015 3:26:08 PM chrisdart@cerebratorium.com
class Asset_model extends MY_Model
{
    var $vendor_id;
    var $po;
    var $product;
    var $name;
    var $version;
    var $type;
    var $serial_number;
    var $status;
    var $source;
    var $year_acquired;
    var $year_removed;
    var $rec_modifier;
    var $rec_modified;

    function prepare_variables ()
    {
        $variables = array(
                "vendor_id",
                "po",
                "product",
                "name",
                "version",
                "type",
                "serial_number",
                "status",
                "source",
                "year_acquired",
                "year_removed"
        );

        foreach ($variables as $variable) {
            if ($value = $this->input->post($variable)) {
                $this->$variable = $value;
            }
        }

        $this->rec_modifier = $this->ion_auth->get_user_id();
    }

    function get ($id)
    {
        $this->db->from("asset");
        $this->db->where("asset.id", $id);
        $this->db->join("vendor", "vendor.id=asset.vendor_id");
        $this->db->select("asset.*");
        $this->db->select(
                "vendor.name vendor, vendor.type vendor_type,vendor.contact,vendor.address,vendor.locality,vendor.url,vendor.phone,vendor.fax,vendor.email,vendor.customer_id");
        $result = $this->db->get()->row();
        return $result;
    }

    function get_for_vendor ($vendor_id)
    {
        $this->db->from("asset");
        $this->db->where("vendor_id", $vendor_id);
        $this->db->order_by("asset.name");
        $result = $this->db->get()->result();
        return $result;
    }

    function get_distinct ($field)
    {
        return $this->_get_distinct("asset", $field);
    }

    function insert(){
        $this->prepare_variables();
        return $this->_insert("asset");
    }
    
    function update($id){
    	$this->prepare_variables();
    	return $this->_update("asset", $id);
    }
    
    function search($where = array()){
    	$this->db->from('asset');
    	//$field_list = $this->db->list_fields('asset');
    	if(!empty($where)){
    		if(is_array($where)){
    			$keys = array_keys($where);
    			$values = array_values($where);
    			foreach($where as $key=>$value){
    			//for($i = 0; $i < count($where); $i++){
//     				$this_key = $keys[$i];
//     				$this_value = $values[$i];
    				//if(in_array($this_key,$field_list) && !empty($this_value)){
    					switch($key){
    						case "name":
    						case "serial_number":
    						case "product":
    							$this->db->like("asset." . $key,"$value");
    							break;
    						default:
    							$this->db->where("asset." . $key, $value);
    							break;
    
    					}
    				//}
    			}
    		}
    	}
    
    
    	$this->db->order_by('asset.type', 'asc');
    	$this->db->order_by('asset.status', 'asc');
    	$this->db->order_by('asset.product', 'asc');
    	$this->db->order_by('asset.version', 'asc');
    	$this->db->order_by('asset.name', 'asc');
    	$this->db->join("vendor","asset.vendor_id=vendor.id");
    	$this->db->select("vendor.name as vendor, asset.*");
    	$result = $this->db->get()->result();
    	return $result;
    }
    
}