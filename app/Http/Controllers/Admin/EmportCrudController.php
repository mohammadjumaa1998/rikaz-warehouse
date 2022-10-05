<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EmportRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class EmportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class EmportCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Emport::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/emport');
        CRUD::setEntityNameStrings(trans('emport.emport'), trans('emport.emports'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {


        CRUD::addColumn([
            // any type of relationship
            'name'         => 'item_id', // name of relationship method in the model
            'type'         => 'select',
            'label'        => trans('emport.item'), // Table column heading
            // OPTIONAL
            'entity'    => 'item', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => App\Models\Item::class, // foreign key model    
        ]);

        CRUD::addColumn([
            // any type of relationship
            'name'         => 'supplier_id', // name of relationship method in the model
            'type'         => 'select',
            'label'        => trans('emport.supplier'), // Table column heading
            // OPTIONAL
            'entity'    => 'supplier', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => App\Models\Supplier::class, // foreign key model    
        ]);
        CRUD::addColumn(['name' => 'qty','type'=>'number','label'  => trans('emport.qty')]);
        CRUD::addColumn(['name' => 'date','type'=>'date','label'  => trans('emport.date')]);

    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(EmportRequest::class);

        $this->crud->addField([
            'label'     => trans('emport.supplier'),
            'type'      => 'select',
            'name'      => 'supplier_id', // the method that defines the relationship in your Model
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->where('block', 0)->get();
            }),

        ]);
        $this->crud->addField([
            'label'     => trans('emport.item'),
            'type'      => 'select',
            'name'      => 'item_id', // the method that defines the relationship in your Model
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->where('active', 1)->get();
            }),
        ]);
        CRUD::addField(['name' => 'qty','label'  => trans('emport.qty')]);

        $this->crud->addField([
            // Date
            'name'  => 'date',
            'label' => trans('emport.date'),
            'type'  => 'date'

        ]);

    }
    protected function setupShowOperation()
    {


        CRUD::addColumn([
            // any type of relationship
            'name'         => 'item_id', // name of relationship method in the model
            'type'         => 'select',
            'label'        => trans('emport.item'), // Table column heading
            // OPTIONAL
            'entity'    => 'item', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => App\Models\Item::class, // foreign key model    
        ]);

        CRUD::addColumn([
            // any type of relationship
            'name'         => 'supplier_id', // name of relationship method in the model
            'type'         => 'select',
            'label'        => trans('emport.supplier'), // Table column heading
            // OPTIONAL
            'entity'    => 'supplier', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => App\Models\Supplier::class, // foreign key model    
        ]);
        CRUD::addColumn(['name' => 'qty','type'=>'number','label'  => trans('emport.qty')]);
        CRUD::addColumn(['name' => 'date','type'=>'date','label'  => trans('emport.date')]);


    }
    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
