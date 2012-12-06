<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Admin_tracks extends Admin_Controller
{
	protected $section = 'tracks';

	public function __construct()
	{
		parent::__construct();

		$this->load->driver('Streams');
		$this->lang->load('discography');
	}

	public function index()
	{
		$params = array('stream' => 'discography_tracks', 'namespace' => 'discography_tracks', 'paginate' => 'yes', 'pag_segment' => 3, 'limit' => 20);

		@$this->data->tracks = $this->streams->entries->get_entries($params);

		$this->template->title(lang('disco:section:tracks'))
			->build('admin/index_tracks', $this->data);
	}

	public function create()
	{
        $extra = array(
            'return' => 'admin/discography/tracks',
            'success_message' => lang('disco:cont:tracks:create_success'),
            'failure_message' => lang('disco:cont:tracks:create_fail'),
            'title' => lang('disco:cont:tracks:create_title')
        );

        @$this->streams->cp->entry_form('discography_tracks', 'discography_tracks', 'new', null, true, $extra);
	}
	
	public function edit($id = 0)
	{
        $extra = array(
            'return' => 'admin/discography/tracks',
            'success_message' => lang('disco:cont:tracks:update_success'),
            'failure_message' => lang('disco:cont:tracks:update_fail'),
            'title' => lang('disco:cont:tracks:update_title')
        );

        @$this->streams->cp->entry_form('discography_tracks', 'discography_tracks', 'edit', $id, true, $extra);
	}
	
	public function delete($id = 0)
	{
		if ($this->streams->entries->delete_entry($id, 'discography_tracks', 'discography_tracks'))
		{
        	$this->session->set_flashdata('success', lang('disco:cont:tracks:delete_success'));
        	redirect('admin/discography/tracks');
        }
        else
        {
        	$this->session->set_flashdata('error', lang('disco:cont:tracks:delete_fail'));
        	redirect('admin/discography/tracks');
        }
	}
}
