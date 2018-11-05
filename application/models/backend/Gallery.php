<?php class Gallery extends CI_Model {

		 
		   function get_gallery_filter() {
                  $this->db->select('*')
                          ->from(DB_GALLERY);
				  
                   $this->db->order_by('sort_order' , 'ASC');
                  $query = $this->db->get();
                  return $query;
          }
		  
		   function get_gallery() {
                  $this->db->select('*')
                          ->from(DB_GALLERY);

                   $this->db->order_by('sort_order' , 'ASC');
                  $query = $this->db->get();
                  return $query;
          }
		

          function get_gallery_details($id) {
                  $this->db->select('*')
                          ->from(DB_GALLERY)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		function update_page_cms($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(DB_GALLERY , $data);
          }

         
		  function add_gallery($data){
              $this->db->insert(DB_GALLERY , $data);
		  }
		   function del_gallery($id){
			  $this->db->where('id' , $id);
              $this->db->delete(DB_GALLERY);
		  }
		 
          

  }