<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExportRequest;
use App\Models\Item;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ExportCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ExportCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Export::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/export');
        CRUD::setEntityNameStrings(trans('export.export'), trans('export.exports'));

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
            'label'        => trans('export.item'), // Table column heading
            // OPTIONAL
            'entity'    => 'item', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => App\Models\Item::class, // foreign key model    
        ]);

        CRUD::addColumn([
            // any type of relationship
            'name'         => 'customer_id', // name of relationship method in the model
            'type'         => 'select',
            'label'        => trans('export.customer'), // Table column heading
            // OPTIONAL
            'entity'    => 'customer', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => App\Models\Customer::class, // foreign key model    
        ]);

        CRUD::addColumn(['name' => 'qty','type'=>'number','label'  => trans('export.qty')]);
        CRUD::addColumn(['name' => 'date','type'=>'date','label'  => trans('export.date')]);

    }
    protected function setupShowOperation()
    {


        CRUD::addColumn([
            // any type of relationship
            'name'         => 'item_id', // name of relationship method in the model
            'type'         => 'select',
            'label'        => trans('export.item'), // Table column heading
            // OPTIONAL
            'entity'    => 'item', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => App\Models\Item::class, // foreign key model    
        ]);

        CRUD::addColumn([
            // any type of relationship
            'name'         => 'customer_id', // name of relationship method in the model
            'type'         => 'select',
            'label'        => trans('export.customer'), // Table column heading
            // OPTIONAL
            'entity'    => 'customer', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => App\Models\Customer::class, // foreign key model    
        ]);
        CRUD::addColumn(['name' => 'qty','type'=>'number','label'  => trans('export.qty')]);
        CRUD::addColumn(['name' => 'date','type'=>'date','label'  => trans('export.date')]);


    }
    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ExportRequest::class);
   
        $this->crud->addField([
            'label'     => trans('export.customer'),
            'type'      => 'select',
            'name'      => 'customer_id', // the method that defines the relationship in your Model
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->where('block', 0)->get();
            }),
        ]);

        $this->crud->addField([
            'label'     => trans('export.item'),
            'type'      => 'select',
            'name'      => 'item_id', // the method that defines the relationship in your Model
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->where('active', 1)->get();
            }),
        ]);

        CRUD::addField(['name' => 'qty','label'  => trans('export.qty')]);

        $this->crud->addField([ // image
            // Date
            'name'  => 'date',
            'label' => trans('export.date'),
            'type'  => 'date'

        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
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
