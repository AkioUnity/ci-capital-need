<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capital extends Admin_Controller {

	public function index()
	{
		redirect('capital/entries');
	}

	public function entries()
	{
		$crud = $this->generate_crud('tblcapitalneeds');
        $crud->set_subject('Capital Need');
        //'Identifier',
		$crud->columns('FacilityID', 'CapitalNeedName', 'UrgencyID', 'BuildingComponentID', 'Accuracy','bMEP');
        $crud->display_as('FacilityID','Facility');
        $crud->display_as('CapitalNeedName','Capital Need');
        $crud->display_as('UrgencyID','Urgency');
        $crud->display_as('BuildingComponentID','Building Components');
        $crud->display_as('bMEP','Amount');

		$crud->set_field_upload('image_url', UPLOAD_CAPITAL_NEED);

        $crud->set_relation('FacilityID', 'tblfacilities', 'FacilityName');
        $crud->set_relation('UrgencyID', 'stblurgencies', 'Urgency');
        $crud->set_relation('BuildingComponentID', 'stblbuilding_components', 'BuildingComponents');
        $crud->set_relation('Accuracy', 'stblaccuracies', 'FullName');

        $crud->set_relation('BCSubtypeID', 'stblbcsubtype', 'BCSubtype');
        $crud->set_relation('BCSubSubtypeID', 'stblbcsubsubtype', 'BCSubSubtype');


        $facilityId=$this->input->get_post('facility', null);
        if ($facilityId){
            $crud->where('FacilityID',$facilityId);
        }
        $this->mViewData['facility'] = $facilityId;

        $urgencyId=$this->input->get_post('urgency', null);
        if ($urgencyId)
            $crud->where('UrgencyID',$urgencyId);
        $this->mViewData['urgency'] = $urgencyId;

        $componentId=$this->input->get_post('component', null);
        if ($componentId)
            $crud->where('BuildingComponentID',$componentId);
        $this->mViewData['component'] = $componentId;

        $this->load->model('tblfacility_model', 'facility');
        $this->mViewData['facilityList'] = $this->facility->dropdown('ID','FacilityName');
        $this->load->model('stblurgency_model', 'urgency');
        $this->mViewData['urgencyList'] = $this->urgency->dropdown('ID','Urgency');
        $this->load->model('stblbuilding_Component_model', 'component');
        $this->mViewData['componentList'] = $this->component->dropdown('ID','BuildingComponents');

//		$state = $crud->getState();
//		if ($state==='add')
//		{
//			$crud->field_type('author_id', 'hidden', $this->mUser->id);
//			$this->unset_crud_fields('status');
//		}
//		else
//		{
//			$crud->set_relation('author_id', 'admin_users', '{first_name} {last_name}');
//		}

		$this->mPageTitle = 'Capital Needs';
		$this->render_crud();
	}

	// Grocery CRUD - Blog Categories
	public function category()
	{
		$crud = $this->generate_crud('blog_categories');
		$crud->columns('title');
		$this->mPageTitle = 'Blog Categories';
		$this->mViewData['crud_note'] = modules::run('adminlte/widget/btn', 'Sort Order', 'blog/category_sortable');
		$this->render_crud();
	}
	
	// Sortable - Blog Categories
	public function category_sortable()
	{
		$this->load->library('sortable');
		$this->sortable->init('blog_category_model');
		$this->mViewData['content'] = $this->sortable->render('{title}', 'blog/category');
		$this->mPageTitle = 'Blog Categories';
		$this->render('general');
	}

    //'Urgency'	=> 'capital/urgency',
    public function urgency()
    {
        $crud = $this->generate_crud('stblurgencies');
        $this->mPageTitle = 'Urgency';
        $this->render_crud();
    }

//'Building Components'			=> 'capital/components',
    public function components()
    {
        $crud = $this->generate_crud('stblbuilding_components');
        $this->mPageTitle = 'Building Components';
        $this->render_crud();
    }

//'Accuracy'			=> 'capital/accuracy',
    public function accuracy()
    {
        $crud = $this->generate_crud('stblaccuracies');
        $this->mPageTitle = 'Accuracy';
        $this->render_crud();
    }

//'Facilities'			=> 'capital/facilities',
    public function facilities()
    {
        $crud = $this->generate_crud('tblfacilities');
        $crud->set_field_upload('image_url', UPLOAD_FACILITY);
        $this->mPageTitle = 'Facilities';
        $this->render_crud();
    }

}
