<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Class CustomerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustomerCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Customer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/customer');
        CRUD::setEntityNameStrings(trans('customer.customer'), trans('customer.customers'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'user.name', 'label'  => trans('customer.name')]);
        CRUD::addColumn(['name' => 'phone', 'label'  => trans('customer.phone')]);
        CRUD::addColumn(['name' => 'user.email', 'label'  => trans('customer.email')]);
        CRUD::addColumn(['name' => 'block', 'label'  => trans('customer.block')]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CustomerRequest::class);

        CRUD::addField(['name' => 'name', 'label'  => trans('customer.name')]);
        CRUD::addField(['name' => 'phone', 'label'  => trans('customer.phone')]);
        CRUD::addField(['name' => 'email', 'label'  => trans('customer.email')]);
        CRUD::addField(['name' => 'password','type'=>'password', 'label'  => 'Password']);
        CRUD::addField(['name' => 'block', 'label'  => trans('customer.block')]);
    }
    public function store(CustomerRequest $request)
    {


        $request = $this->crud->validateRequest();
        $this->crud->registerFieldEvents();
        try {
            DB::beginTransaction();
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' =>  Hash::make($request->password)
            ]);
            $item = $this->crud->create(['user_id' => $user->id,'block'=>$request->block, 'phone' => $request->phone, 'password' => Hash::make($request->password)]);
            $this->data['entry'] = $this->crud->entry = $item;

            $this->crud->setSaveAction();

            DB::commit();
            \Alert::success(trans('backpack::crud.insert_success'))->flash();
            return redirect('admin/customer');

        } catch (\Exception $exp) {
            DB::rollBack();
        }
    }
    protected function setupShowOperation()
    {
        CRUD::addColumn(['name' => 'user.name', 'label'  => trans('customer.name')]);
        CRUD::addColumn(['name' => 'phone', 'label'  => trans('customer.phone')]);
        CRUD::addColumn(['name' => 'user.email', 'label'  => trans('customer.email')]);
        CRUD::addColumn(['name' => 'block', 'label'  => trans('customer.block')]);
    }
    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */

    public function update()
    {

        $request = $this->crud->validateRequest();
        $this->crud->registerFieldEvents();
        $user = $this->crud->getCurrentEntry()->user;
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' =>  Hash::make($request->password)
        ]);

        // update the row in the db
        $item = $this->crud->update(
            $request->get($this->crud->model->getKeyName()),
            ['block'=>$request->block , 'phone' => $request->phone,'password' => Hash::make($request->password)]
        );
        $this->data['entry'] = $this->crud->entry = $item;

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $user = $this->crud->getCurrentEntry()->user;
        $this->crud->addField(['name' => 'name','type' => 'text','label' => trans('customer.name'),'default' => $user->name]);
        $this->crud->addField(['name' => 'email','type' => 'email','label' => trans('customer.email'),'default' => $user->email]);
        $this->crud->addField(['name' => 'password','label' => 'Password','type' => 'password','default' => $user->password]);
    }
}
