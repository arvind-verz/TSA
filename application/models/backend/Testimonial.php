<?php class Testimonial extends CI_Model {

		 
		   function get_testimonial_filter() {
                  $this->db->select('*')
                          ->from(DB_TESTIMONIAL);
				  
                   $this->db->order_by('sort_order' , 'ASC');
                  $query = $this->db->get();
                  return $query;
          }
		  
		   function get_testimonial() {
                  $this->db->select('*')
                          ->from(DB_TESTIMONIAL);

                   $this->db->order_by('sort_order' , 'ASC');
                  $query = $this->db->get();
                  return $query;
          }
		

          function get_testimonial_details($id) {
                  $this->db->select('*')
                          ->from(DB_TESTIMONIAL)
                          ->where('id' , $id);

                  return $this->db->get();
          }
		function update_page_cms($data , $id) {
			  		
				  $this->db->where('id' , $id);
                  $this->db->update(DB_TESTIMONIAL , $data);
          }

         
		  function add_testimonial($data){
              $this->db->insert(DB_TESTIMONIAL , $data);
		  }
		   function del_testimonial($id){
			  $this->db->where('id' , $id);
              $this->db->delete(DB_TESTIMONIAL);
		  }
		 
          

  }