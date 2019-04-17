<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Capital extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('gcharts');
    }

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

        $crud->set_relation('BCSubtypeID', 'stblbcsubtypes', 'BCSubtype');
        $crud->set_relation('BCSubSubtypeID', 'stblbcsubsubtypes', 'BCSubSubtype');


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
//subtypeId
        $subtypeId=$this->input->get_post('subtypeId', null);
        if ($subtypeId)
            $crud->where('BCSubtypeID',$subtypeId);
        $this->mViewData['subtypeId'] = $subtypeId;
//subsubtypeId
        $subsubtypeId=$this->input->get_post('subsubtypeId', null);
        if ($subsubtypeId)
            $crud->where('BCSubSubtypeID',$subsubtypeId);
        $this->mViewData['subsubtypeId'] = $subsubtypeId;

        $this->load->model('tblfacility_model', 'facility');
        $this->mViewData['facilityList'] = $this->facility->dropdown('ID','FacilityName');
        $this->load->model('stblurgency_model', 'urgency');
        $this->mViewData['urgencyList'] = $this->urgency->dropdown('ID','Urgency');
        $this->load->model('stblbuilding_Component_model', 'component');
        $this->mViewData['componentList'] = $this->component->dropdown('ID','BuildingComponents');
        $this->load->model('stblbcsubtype_model', 'subtype');
        $this->mViewData['subtypeList'] = $this->subtype->dropdown('ID','BCSubtype');
        $this->load->model('stblbcsubsubtype_model', 'subsubtype');
        $this->mViewData['subsubtypeList'] = $this->subsubtype->dropdown('ID','BCSubSubtype');

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

        $crud->add_action('Charts', '', 'admin/capital/charts', 'fa fa-bar-chart');

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

    public function charts0($capital_id)
    {
        $this->gcharts->load('ColumnChart');

        $this->load->model('tblannualcost_model', 'cost');
        $data = $this->cost->select('ACYear','ACAmount')
            ->where("CapitalNeedID",$capital_id)
            ->result();

        $this->gcharts->DataTable('Inventory')
            ->addColumn('string', 'Classroom', 'class')
            ->addColumn('number', 'Pencils1', 'pencils2')
            ->addColumn('number', 'Markers', 'markers')
            ->addColumn('number', 'Erasers', 'erasers')
            ->addColumn('number', 'Binders', 'binders')
            ->addRow(array(
                'Science Class',
                rand(50, 100),
                rand(50, 100),
                rand(50, 100),
                rand(50, 100)
            ));

        $this->gcharts->DataTable('Price')
            ->addColumn('string', 'Classroom', 'class')
            ->addColumn('number', 'Pencils', 'pencils')
            ->addColumn('number', 'Markers', 'markers')
            ->addColumn('number', 'Erasers', 'erasers')
            ->addColumn('number', 'Binders', 'binders')
            ->addRow(array(
                'Science Class',
                rand(50, 100),
                rand(50, 100),
                rand(50, 100),
                rand(50, 100)
            ));


        $config = array(
            'title' => 'Inventory2'
        );

        $this->gcharts->ColumnChart('Inventory')->setConfig($config);

        $config = array(
            'title' => 'Price'
        );

        $this->gcharts->ColumnChart('Price')->setConfig($config);
        // display view
//        $this->mViewData['crud_output'] = $crud_data->output;
        $this->render('gcharts/column_chart_basic');
    }

    public function charts($capital_id)
    {
        $this->gcharts->load('ColumnChart');

        $this->load->model('tblannualcost_model', 'cost');
        $price = $this->cost->select('ACYear, ACAmount')
            ->get_many_by("CapitalNeedID",$capital_id);

        $this->load->model('tblcapitalneed_model', 'capital');
        $etc= $this->capital->select('bMEP, aCoreShell,dSitesUtilities,cOtherSystems')
            ->get_by("ID",$capital_id);


        $this->gcharts->DataTable('Finances')
            ->addColumn('date', 'Year')
            ->addColumn('number', 'Cost');

        $this->gcharts->DataTable('Etc')
            ->addColumn('string', 'Type')
            ->addColumn('number', 'Cost');


        $this->gcharts->DataTable('Etc')->addRow(array('MEP',empty($etc->bMEP)?null:$etc->bMEP));
        $this->gcharts->DataTable('Etc')->addRow(array('Core & Shell',empty($etc->aCoreShell)?null:$etc->aCoreShell));
        $this->gcharts->DataTable('Etc')->addRow(array('Sites & Utilities',empty($etc->dSitesUtilities)?null:$etc->dSitesUtilities));
        $this->gcharts->DataTable('Etc')->addRow(array('Devices',empty($etc->cOtherSystems)?null:$etc->cOtherSystems));

        foreach ($price as $row)
        {
            $data = array(
                new jsDate($row->ACYear), //Year
                $row->ACAmount
            );

            $this->gcharts->DataTable('Finances')->addRow($data);
        }

        //Either Chain functions together to setup configuration objects
        $titleStyle = $this->gcharts->textStyle()
            ->color('#55BB9A')
            ->fontName('Georgia')
            ->fontSize(22);

        $legendStyle = $this->gcharts->textStyle()
            ->color('#F3BB00')
            ->fontName('Arial')
            ->fontSize(16);

        //Or pass an array with configuration options
        $legend = new legend(array(
            'position' => 'right',
            'alignment' => 'start',
            'textStyle' => $legendStyle
        ));

        $tooltipStyle = new textStyle(array(
            'color' => '#000000',
            'fontName' => 'Courier New',
            'fontSize' => 10
        ));

        $tooltip = new tooltip(array(
            'showColorCode' => TRUE,
            'textStyle' => $tooltipStyle
        ));

        $config = array(
            'axisTitlesPosition' => 'out',
            'backgroundColor' => new backgroundColor(array(
                'stroke' => '#CDCDCD',
                'strokeWidth' => 4,
                'fill' => '#EEFFCC'
            )),
            'barGroupWidth' => '20%',
            'chartArea' => new chartArea(array(
                'left' => 80,
                'top' => 80,
                'width' => '80%',
                'height' => '60%'
            )),
            'titleTextStyle' => $titleStyle,
            'legend' => $legend,
            'tooltip' => $tooltip,
            'title' => 'Capital Need Finances',
            'titlePosition' => 'out',
            'width' => 500,
            'height' => 450,
            'colors' => array('#00A100', '#FF0000', '#00FF00'),
            'hAxis' => new hAxis(array(
                'baselineColor' => '#BB99BB',
                'gridlines' => array(
                    'color' => '#ABCDEF',
                    'count' => 1
                ),
                'textPosition' => 'out',
                'textStyle' => new textStyle(array(
                    'color' => '#C42B5F',
                    'fontName' => 'Tahoma',
                    'fontSize' => 14
                )),
                'slantedText' => TRUE,
                'slantedTextAngle' => 70,
//                'title' => 'Years',
                'titleTextStyle' => new textStyle(array(
                    'color' => '#BB33CC',
                    'fontName' => 'Impact',
                    'fontSize' => 18
                )),
                'maxAlternation' => 2,
                'maxTextLines' => 10,
                'showTextEvery' => 1
            )),
            'vAxis' => new vAxis(array(
                'baseline' => 1,
                'baselineColor' => '#5F0BB1',
                'format' => '$ ##,###',
                'textPosition' => 'out',
                'textStyle' => new textStyle(array(
                    'color' => '#DDAA88',
                    'fontName' => 'Verdana',
                    'fontSize' => 10
                )),
                'title' => 'Dollars',
                'titleTextStyle' => new textStyle(array(
                    'color' => 'blue',
                    'fontName' => 'Verdana',
                    'fontSize' => 14
                )),
            ))
        );

        $this->gcharts->ColumnChart('Finances')->setConfig($config);
        $this->gcharts->ColumnChart('Etc')->setConfig($config);
        $this->render('gcharts/column_chart_basic');
    }

}
