<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Material extends CI_Model
{

    public function __construct()
    {
        $this->uniq_id = uniqid();
        $this->date    = date('Y-m-d H:i:s');
    }

    public function store()
    {
        //die(print_r($_POST));
        $data = array(
            'material_id'  => !empty($_POST['material_id']) ? $_POST['material_id'] : null,
            'book_name'    => !empty($_POST['book_name']) ? $_POST['book_name'] : null,
            'book_price'   => !empty($_POST['book_price']) ? $_POST['book_price'] : null,
            //'book_version' => !empty($_POST['book_version']) ? $_POST['book_version'] : null,
            'subject'      => !empty($_POST['subject']) ? json_encode($_POST['subject']) : null,
            'created_at'   => $this->date,
            'updated_at'   => $this->date,
        );

        $this->db->trans_start();
        $this->db->insert(DB_MATERIAL, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/material/create');
        } else {
            $this->session->set_flashdata('success', MATERIAL . ' ' . MSG_CREATED);
            return redirect('admin/material');
        }
    }

    public function update($id)
    {
        $material_id = !empty($_POST['material_id']) ? $_POST['material_id'] : null;
        $query       = $this->db->get_where(DB_MATERIAL, ['id !=' => $id, 'material_id' => $material_id]);
        if ($query->num_rows() > 0) {

            $this->session->set_flashdata('error', 'Material ID already exists within system.');
            return false;
        }
        $data = array(
            'material_id'  => $material_id,
            'book_name'    => !empty($_POST['book_name']) ? $_POST['book_name'] : null,
            'book_price'   => !empty($_POST['book_price']) ? $_POST['book_price'] : null,
            //'book_version' => !empty($_POST['book_version']) ? $_POST['book_version'] : null,
            'subject'      => !empty($_POST['subject']) ? json_encode($_POST['subject']) : null,
            'updated_at'   => $this->date,
        );

        $this->db->trans_start();
        $this->db->where('id', $id);
        $this->db->update(DB_MATERIAL, $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/material/update/' . $id);
        } else {
            $this->session->set_flashdata('success', MATERIAL . ' ' . MSG_UPDATED);
            return redirect('admin/material');
        }
    }

    public function delete($id)
    {
        $this->db->trans_start();
        $this->db->where('material_id', $id);
        $this->db->update(DB_MATERIAL, ['is_archive' => 1, 'archive_at' => $this->date]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/material');
        } else {
            $this->session->set_flashdata('success', MATERIAL . ' ' . MSG_ARCHIVED);
            return redirect('admin/material');
        }
    }

    public function moveto_active_list($id)
    {
        $this->db->trans_start();
        $this->db->where('material_id', $id);
        $this->db->update(DB_MATERIAL, ['is_archive' => 0, 'updated_at' => $this->date]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->session->set_flashdata('error', MSG_ERROR);
            return redirect('admin/material/archived');
        } else {
            $this->session->set_flashdata('success', MATERIAL . ' ' . MSG_MOVED);
            return redirect('admin/material');
        }
    }

    public function delete_archive($material_id)
    {
        $this->db->delete(DB_MATERIAL, ['material_id' => $material_id]);
        $this->session->set_flashdata('success', DB_MATERIAL . ' ' . MSG_DELETED);
        return redirect('admin/material/archived');
    }

    public function archive()
    {
        $material_id = isset($_POST['material_id']) ? $_POST['material_id'] : '';
        if ($material_id) {
            $this->db->trans_start();
            foreach ($material_id as $id) {

                $this->db->where('id', $id);
                $this->db->update(DB_MATERIAL, ['is_archive' => 1, 'archive_at' => $this->date]);
            }
            $this->db->trans_complete();

            if ($this->db->trans_status() === false) {
                $this->session->set_flashdata('error', MSG_ERROR);
                return redirect('admin/material');
            } else {
                $this->session->set_flashdata('success', MATERIAL . ' ' . MSG_ARCHIVED);
                return redirect('admin/material');
            }
        }
        $this->session->set_flashdata('error', MSG_ERROR);
        return false;
    }
}
