<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GroceryCrud\Core\GroceryCrud;
use Modules\Project\Entities\Project;
use Modules\Project\Entities\ProjectStatus;

class ProjectController extends Controller
{
    private function _getDatabaseConnection() {
        $databaseConnection = config('database.default');
        $databaseConfig = config('database.connections.' . $databaseConnection);


        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => $databaseConfig['database'],
                'username' => $databaseConfig['username'],
                'password' => $databaseConfig['password'],
                'charset' => 'utf8'
            ]
        ];
    }

    private function _getGroceryCrudEnterprise() {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);

        return $crud;
    }

    private function _show_output($output, $title = '') {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                  ->header('Content-Type', 'application/json')
                  ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('grocery', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files,
            'title' => $title
        ]);
    }

    public function status()
    {
        $title = "Project Status";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('project_statuses');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Status', 'Statuses');
        $crud->columns(['name', 'updated_at']);
        $crud->requiredFields(['name']);
        $crud->fields(['name']);
        $crud->callbackAfterInsert(function ($s) {
            $status = ProjectStatus::find($s->insertId);
            $status->created_at = now();
            $status->save();
            $status->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $status = ProjectStatus::find($s->primaryKeyValue);
            $status->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function category()
    {
        $title = "Project Category";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('project_categories');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Category', 'Categories');
        $crud->columns(['name', 'updated_at']);
        $crud->setFieldUpload('image', 'storage', '../storage');
        $crud->requiredFields(['name', 'image']);
        $crud->fields(['name', 'image']);
        $crud->callbackAfterInsert(function ($s) {
            $status = ProjectStatus::find($s->insertId);
            $status->created_at = now();
            $status->save();
            $status->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $status = ProjectStatus::find($s->primaryKeyValue);
            $status->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }

    public function index()
    {
        $title = "Projects";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('projects');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Project', 'Projects');
        $crud->columns(['name', 'description', 'price', 'stock', 'project_status_id',
        'project_category_id', 'updated_at']);
        $crud->requiredFields(['name', 'description', 'price', 'periode', 'profit', 'stock', 'image', 'project_status_id',
        'project_category_id', 'status_id']);
        $crud->fields(['name', 'description', 'price', 'periode', 'profit', 'stock', 'image', 'project_status_id',
        'project_category_id', 'status_id']);
        $crud->setTexteditor(['description']);
        $crud->setFieldUpload('image', 'storage', 'storage');
        $crud->setRelation('status_id', 'statuses', 'name');
        $crud->setRelation('project_status_id', 'project_statuses', 'name');
        $crud->setRelation('project_category_id', 'project_categories', 'name');
        $crud->callbackColumn('price', function ($value, $row) {
            return "Rp." . number_format($value, 0, ',', '.');
        });
        $crud->displayAs([
            'project_status_id' => 'Status',
            'project_category_id' => 'Category',
            'status_id' => 'Status'
        ]);
        $crud->callbackAfterInsert(function ($s) {
            $status = Project::find($s->insertId);
            $status->created_at = now();
            $status->save();
            $status->touch();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $status = Project::find($s->primaryKeyValue);
            $status->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
