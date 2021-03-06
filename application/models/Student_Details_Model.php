<?php 

/**
* 
*/
class Student_Details_Model extends CI_Model
{
	protected $table = 'student';
	protected $fields = [
				'student.id',
				'student.name',
				'student.address',
				'student.phone',
				'student.gender',
				'courses.name as course_name',
				// 'departments.name as department_name'	
			];
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['url', 'form']);
		$this->load->database();
	}

    public function view_all_limit($limit)
    {
        $this->db->select($this->fields);
        $this->db->join('courses', 'courses.id = student.course_id');
        // $this->db->join('departments', 'departments.id = students.department_id');
        $this->db->limit($limit);
        $result = $this->db->get($this->table);
        if($result->num_rows() >= 1)
        {
            return $result->result();

        }
        else
        {
            return FALSE;
        }
    }

		public function view_all()
	{
		$this->db->select($this->fields);
		$this->db->join('courses', 'courses.id = student.course_id');
		// $this->db->join('departments', 'departments.id = students.department_id');
		$result = $this->db->get($this->table);
		if($result->num_rows() >= 1)
		{
			return $result->result();
			
		}
		else
		{
			return FALSE;
		}
	}


	public function view_where($where)
	{
		$this->db->select($this->fields);
		$this->db->join('courses', 'courses.id = student.course_id');
		
		$this->db->where($where);
		$result = $this->db->get($this->table);
		if($result->num_rows() >= 1)
		{
			return $result->result();
			
		}
		else
		{
			return FALSE;
		}
	}

	public function add($data)
	{
		if($this->db->insert($this->table,$data))
			 {

				return $this->db->insert_id();
			 	
			 }
	}

	public function edit($where, $data)
	{
		$this->db->where($where);
		$update=$this->db->update($this->table, $data);
		if($update)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}


	public function delete($id)
	 {
	    $this->db->where('id',$id);
		if($this->db->delete($this->table) === TRUE)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
    }
}

 ?>