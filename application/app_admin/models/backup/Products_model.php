<?php class Products_model extends CI_Model {

	function count_products_filter($FlterData) {				  
				   $this->db->select('count(p.id) as `TotalNum`')
                         ->from(TBL_PRODUCTS . ' as `p`')
						 ->join(TBL_CATEGORIES . ' as `tc`' , 'p.cat_id = tc.cat_id','left');
						 
				 if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){							
							if( $key == 'product_name' ){
								$this->db->like('p.'.$key , $value);
							}
							if( $key == 'cat_id' ){
								$this->db->where('p.'.$key , $value);
							}
							if( $key == 'status' ){
								$this->db->where('p.'.$key , $value);
							}
						}
					}
				  }
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
             return $val;
          }
		  
	function get_products_filter($total_row_display , $limit_from, $FlterData) {
                 $this->db->select('p.*,tc.cat_name,tc.parent_id')
                         ->from(TBL_PRODUCTS . ' as `p`')
						 ->join(TBL_CATEGORIES . ' as `tc`' , 'p.cat_id = tc.cat_id','left');
						 
				
				 if( count($FlterData) > 0 ){					 
					foreach($FlterData as $key=>$value){				
						if( $value!=''){
							if( $key == 'product_name' )
							{
								$this->db->like('p.'.$key , $value);
							}
							if( $key == 'cat_id' )
							{
								$this->db->where('p.'.$key , $value);
							}
							
							if( $key == 'brands_id' )
							{
								$this->db->where('p.'.$key , $value);
							}
							if( $key == 'status' )
							{
								$this->db->where('p.'.$key , $value);
							}
							
						}
					}
				  }
                  $this->db->order_by('p.sort_order' , 'asc');
                  $this->db->limit($total_row_display , $limit_from);
                  $query = $this->db->get();
                  return $query;
         }
		 
	function get_additional_images_file($products_id) {
			  $this->db->select('*')
					  ->from(TBL_PRODUCTS_IMAGES)
					  ->where('products_id' , $products_id);
			  $query = $this->db->get();
			  return $query;
	  }
	function get_glossary() {
                  $this->db->select('*')
                          ->from(TBL_GLOSSARY);
                   $this->db->order_by('sort_order' , 'ASC');

                  $query = $this->db->get()->result_array();
                  return $query;
     }
	function get_product_options() {
                  $this->db->select('*')
                          ->from(TBL_PRODUCTS_OPTIONS);
                   $this->db->order_by('products_options_id' , 'ASC');

                  $query = $this->db->get()->result_array();
                  return $query;
    }
	function count_products() {
                  $this->db->select('count(cp.id) as `TotalNum`')
                          ->from(TBL_PRODUCTS . ' as `cp`');
                  $query = $this->db->get()->result_array();
                  if(isset($query[0]['TotalNum'])){
					  $val = $query[0]['TotalNum'];
				  }else{
					  $val = 0;
				  }
                  return $val;
     }
	 function get_products($total_row_display , $limit_from) {
                 $this->db->select('p.*,tc.cat_name,tc.parent_id')
                         ->from(TBL_PRODUCTS . ' as `p`')
						 ->join(TBL_CATEGORIES . ' as `tc`' , 'p.cat_id = tc.cat_id','left');
						

                  $this->db->limit($total_row_display , $limit_from);
                   $this->db->order_by('p.sort_order' , 'ASC');
                  $query = $this->db->get();
                  return $query;
      }
	 function get_products_details($id) {
                  $this->db->select('*')
                          ->from(TBL_PRODUCTS)
                          ->where('id' , $id);
                  return $this->db->get();
          }
		function update_page_cms($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(TBL_PRODUCTS , $data);
          }
		 function add_products_attributes($data){
              $this->db->insert(TBL_PRODUCTS_ATTRIBUTES , $data);
		  }
		  function add_glossary_products($data){
              $this->db->insert(TBL_GLOSSARY_PRODUCTS , $data);
		  }
		  function del_products_attributes($products_id){
			  $this->db->where('products_id' , $products_id);
              $this->db->delete(TBL_PRODUCTS_ATTRIBUTES);
		  }
		   function del_glossary_products($products_id){
			  $this->db->where('products_id' , $products_id);
              $this->db->delete(TBL_GLOSSARY_PRODUCTS);
		  }
		  function add_products($data){
              $this->db->insert(TBL_PRODUCTS , $data);
			  return $this->db->insert_id();
		  }
		   function del_products($id){
			  $this->db->where('id' , $id);
              $this->db->delete(TBL_PRODUCTS);
		  }
		 function add_additional_images_file($data){
              $this->db->insert(TBL_PRODUCTS_IMAGES , $data);
			  
		  }
          function get_delete_products_file($id) {
                  $this->db->select('*')
                          ->from(TBL_PRODUCTS_IMAGES)
                          ->where('id' , $id);
                  $query = $this->db->get();
                  return $query;
          }   
		  function delete_products_file($id){
		  			$this->db->where('id' , $id)
                          ->delete(TBL_PRODUCTS_IMAGES);
		  }
		/*  Newly added  on 09 Feb 2015    ***/
		  
		  function get_products_fulldetails($id=0) {
			  $this->db->select('p.*,c.cat_name,b.brands_name')
					  ->from(TBL_PRODUCTS. ' as `p`')
					  ->join(TBL_CATEGORIES.' `c`','c.cat_id=p.cat_id')
					  ->join(TBL_PRODUCTS_BRANDS.' `b`','b.id=p.brands_id');
			  if(!empty($id)) $this->db->where('p.id' , $id);
			  return $this->db->get()->result_array();
          }
		  function populate_cat() {
			  
				$this->db->select('cat_name,cat_id')
                          ->from(TBL_CATEGORIES);
                $cats = $this->db->get()->result_array();
				$cats_arr=array();
				if(!empty($cats))
				{
					foreach($cats as $cat)
					{
						$cats_arr[$cat['cat_id']] = $cat['cat_name'];
					}
				}
				return $cats_arr;
          }
		  
		  function populate_products() {
			  
				$this->db->select('product_name,id')
                          ->from(TBL_PRODUCTS);
                $products = $this->db->get()->result_array();
				$products_arr=array();
				if(!empty($products))
				{
					foreach($products as $product)
					{
						$products_arr[$product['id']] = $product['product_name'];
					}
				}
				return $products_arr;
          }
		  
		  function populate_brands() {
			  
				$this->db->select('brands_name,id')
                          ->from(TBL_PRODUCTS_BRANDS);
                $brands = $this->db->get()->result_array();
				$brands_arr=array();
				if(!empty($brands))
				{
					foreach($brands as $brand)
					{
						$brands_arr[$brand['id']] = $brand['brands_name'];
					}
				}
				return $brands_arr;
          }
		  
		  
		  function get_additional_pdf_file($products_id) {
			  $this->db->select('*')
					  ->from(TBL_PRODUCTS_PDF)
					  ->where('products_id' , $products_id);
			  $query = $this->db->get();
			  return $query;
	     }
		 function get_product_pdf($id)
		 {
			
			$this->db->select('*')
					  ->from(TBL_PRODUCTS_PDF)
					  ->where('id' , $id);
			  $query = $this->db->get()->row_array();
			  return $query;
			
			 
		 }

  }