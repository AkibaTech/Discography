<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin_albums extends Admin_Controller
{
	protected $section = 'albums';

	public function __construct()
	{
		parent::__construct();

		$this->load->driver('Streams');
		$this->lang->load('discography');
	}

	public function index()
	{
		$params = array('stream' => 'discography_albums', 'namespace' => 'discography_albums', 'paginate' => 'yes', 'pag_segment' => 3, 'limit' => 20);

		@$this->data->albums = $this->streams->entries->get_entries($params);

		$this->template->title(lang('disco:section:albums'))
			->build('admin/index_albums', $this->data);
	}

	public function create()
	{
        $extra = array(
            'return' => 'admin/discography/albums',
            'success_message' => lang('disco:cont:albums:create_success'),
            'failure_message' => lang('disco:cont:albums:create_fail'),
            'title' => lang('disco:cont:albums:create_title')
        );

        @$this->streams->cp->entry_form('discography_albums', 'discography_albums', 'new', null, true, $extra);
	}
	
	public function edit($id = 0)
	{
        $extra = array(
            'return' => 'admin/discography/albums',
            'success_message' => lang('disco:cont:albums:update_success'),
            'failure_message' => lang('disco:cont:albums:update_fail'),
            'title' => lang('disco:cont:albums:update_title')
        );

        @$this->streams->cp->entry_form('discography_albums', 'discography_albums', 'edit', $id, true, $extra);
	}
	
	public function delete($id = 0)
	{
		if ($this->streams->entries->delete_entry($id, 'discography_albums', 'discography_albums'))
		{
        	$this->session->set_flashdata('success', lang('disco:cont:albums:delete_success'));
        	redirect('admin/discography/albums');
        }
        else
        {
        	$this->session->set_flashdata('error', lang('disco:cont:albums:delete_fail'));
        	redirect('admin/discography/albums');
        }
	}
}
