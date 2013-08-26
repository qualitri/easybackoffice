<?php

class CI_Exporter extends Exporter
{
    private $entity_file;
    private $model_file;
    private $controller_file;
    private $views_files;

    function __construct()
    {
        parent::__construct();
        $this->entity_file = NULL;
        $this->model_file = NULL;
        $this->controller_file = NULL;
        $this->views_files = NULL;
    }

    protected function create_dir()
    {
        $this->export_dir_name = 'CI_Export_'.time();
        $this->export_dir_path = $this->export_dir_path.$this->export_dir_name;
        mkdir($this->export_dir_path);
        mkdir($this->export_dir_path.'/core');
        mkdir($this->export_dir_path.'/entity');
        mkdir($this->export_dir_path.'/models');
        mkdir($this->export_dir_path.'/controllers');
        mkdir($this->export_dir_path.'/views');

        mkdir('application/models/entity');
        mkdir('application/controllers/admin');
        mkdir('application/views/admin');
    }

    protected function process_format($format)
    {
        $fields = $format['fields'];
        $entity = $format['entity'];

        $this->create_core();
        $this->create_entity($fields, $entity);
        $this->create_model($fields, $entity);
        $this->create_controller($fields, $entity);
        $this->create_views($fields, $entity);
    }

    private function create_core()
    {
        /*copy(APPPATH.'templates/core/Base_Model.php', $this->get_export_dir_path().'/core/Base_Model.php');
        copy(APPPATH.'templates/core/Base_Controller_exp.php', $this->get_export_dir_path().'/core/Base_Controller_exp.php');
        copy(APPPATH.'templates/core/Backoffice_Controller.php', $this->get_export_dir_path().'/core/Backoffice_Controller.php');*/
        copy(APPPATH.'templates/core/Base_Model.php', 'application/core/Base_Model.php');
        copy(APPPATH.'templates/core/Base_Controller_exp.php', 'application/core/Base_Controller_exp.php');
        copy(APPPATH.'templates/core/Backoffice_Controller.php', 'application/core/Backoffice_Controller.php');
    }

    private function create_entity($fields, $entity)
    {
        $this->load->library('string_builder');

        $this->string_builder->append("<?php\n\n");

        //Class declaration
        $this->string_builder->append('class '.joined_ucwords($entity['name']));
        $this->string_builder->append("\n{\n");

        //Entity properties
        $this->string_builder->append("\tvar $".'id_'.joined_to_lower($entity['name']).";\n");
        foreach($fields as $field)
        {
            $this->string_builder->append("\tvar $".underlined_to_lower($field['name']).";\n");
        }

        //Setters and Getters
        foreach($fields as $field)
        {
            $upper_name = joined_ucwords($field['name']);
            $underlined_lower = underlined_to_lower($field['name']);
            $this->string_builder->append("\n");
            $this->string_builder->append("\tpublic function set$upper_name($".$underlined_lower.")");
            $this->string_builder->append("\n\t{\n");
            $this->string_builder->append("\t\t".'$this->'.$underlined_lower.' = $'.$underlined_lower.';');
            $this->string_builder->append("\n\t}\n");

            $this->string_builder->append("\n");
            $this->string_builder->append("\tpublic function get$upper_name()");
            $this->string_builder->append("\n\t{\n");
            $this->string_builder->append("\t\t".'return $this->'.$underlined_lower.';');
            $this->string_builder->append("\n\t}\n");
        }

        //Class closing
        $this->string_builder->append("\n}");

        //Entity File Creation
        /*file_put_contents($this->get_export_dir_path().'/entity/'.joined_ucwords($entity['name']).'.php', $this->string_builder->get_string());*/
        file_put_contents('models/entity/'.joined_ucwords($entity['name']).'.php', $this->string_builder->get_string());

    }

    private function create_model($fields, $entity)
    {
        $template = file_get_contents(APPPATH.'templates/model/template_model.tpl');

        $class_name = underlined_ucfirst($entity['name']);
        $entity_name = joined_ucwords($entity['name']);
        $entity_prefix = $entity['prefix'];
        $entity_name_lower = underlined_to_lower($entity['name']);

        $entity_params = array();
        $set_properties = array();
        foreach($fields as $field)
        {
            $field_lower = underlined_to_lower($field['name']);
            $entity_params[] = '$'.$field_lower.' = null';
            $set_properties[] = '$'.$entity_name_lower.'->set'.joined_ucwords($field['name']).'($'.$field_lower.');';
        }
        $entity_params = implode("\n\t\t,", $entity_params);
        $set_properties = implode("\n\t\t", $set_properties);

        $from = array('{#class_name#}', '{#entity_name#}', '{#entity_name_lower#}', '{#entity_prefix#}', '{#entity_params#}',
            '{#set_properties#}');
        $to = array($class_name, $entity_name, $entity_name_lower, $entity_prefix, $entity_params, $set_properties);

        $output = str_replace($from, $to, $template);

        //Model File Creation
        /*file_put_contents($this->get_export_dir_path().'/models/'.$entity_name_lower.'_model.php', $output);*/
        file_put_contents('application/models/'.$entity_name_lower.'_model.php', $output);

    }

    private function create_controller($fields, $entity)
    {
        $template = file_get_contents(APPPATH.'templates/controller/template_admin.tpl');

        $class_name = underlined_ucfirst($entity['name']);
        $entity_name = joined_ucwords($entity['name']);
        $entity_name_lower = underlined_to_lower($entity_name);
        $active = $entity_name_lower;
        $model_name = $entity_name_lower;
        $view_list_name = $entity_name_lower.'_list';
        $view_form_name = $entity_name_lower.'_form';

        $post_fields = array();
        $rules = array();
        foreach($fields as $field)
        {
            $post_fields[] = '$this->input->post(\''.$field['name'].'\')';

            $field_rules = array();
            if($field['required'])
                $field_rules[] = 'required';

            if($field['type'] == 'text' || $field['type'] == 'txtar')
            {
                array_unshift($field_rules, 'trim');
                array_push($field_rules, 'xss_clean');
            }
            $field_rules = implode('|', $field_rules);

            $rules[] = 'array(\'field\' => \''.$field['name'].'\', \'label\' => \''.$field['label'].'\', \'rules\' => \''.$field_rules.'\')';
        }
        $post_fields = implode("\n\t\t,", $post_fields);
        $rules = implode("\n\t\t,", $rules);

        $from = array('{#class_name#}', '{#entity_name#}', '{#entity_name_lower#}', '{#active#}', '{#model_name#}',
            '{#post_fields#}', '{#rules#}', '{#view_list_name#}', '{#view_form_name#}');
        $to = array($class_name, $entity_name, $entity_name_lower, $active, $model_name, $post_fields, $rules,
            $view_list_name, $view_form_name);

        $output = str_replace($from, $to, $template);

        //Controller File Creation
        /*file_put_contents($this->get_export_dir_path().'/controllers/'.$entity_name_lower.'_admin.php', $output);*/
        file_put_contents('application/controllers/admin/'.$entity_name_lower.'_admin.php', $output);

    }

    private function create_views($fields, $entity)
    {
        $this->load->library('string_builder');

        $this->string_builder->flush_string();
        
        $this->string_builder->append("<!DOCTYPE html>");
        $this->string_builder->append("<html lang='en'>");
        $this->string_builder->append("<head>");
        $this->string_builder->append("\t<meta charset='utf-8'>");
        $this->string_builder->append("\t<title>Bienvenido a Qualitri Form</title>");

        $this->string_builder->append("\t<link href='<?php echo \$css_path ?>/bootstrap.min.css' rel='stylesheet' media='screen'>");
        $this->string_builder->append("\t<link href='<?php echo \$css_path ?>/bootstrap-responsive.min.css' rel='stylesheet'>");
        $this->string_builder->append("\t<script src='<?php echo \$js_path ?>/vendor/bootstrap.min.js'></script>");

        $this->string_builder->append("</head>");

        $this->string_builder->append("<body>");

        $this->string_builder->append("<form class='form-horizontal' method='post' action='' id='".$entity['name']."'> \n");
        $this->string_builder->append("\t<legend><?php echo \$this->lang->line('presentation_form') ?></legend>\n");
        $this->string_builder->append("\t<?php if(isset(\$entity)): ?>\n");
        foreach ($fields as $key => $field) {
            
            if ($field['type'] == 'password' || $field['type'] == 'checkbox' || $field['type'] == 'text') {

                $this->string_builder->append("\t<div class='control-group'> \n");
                $this->string_builder->append("\t\t<label class='control-label'>".$field['name']."</label>\n");
                $this->string_builder->append("\t\t<div class='controls'> \n");
                $this->string_builder->append("\t\t\t<input type='".$field['type']."' placeholder='Insert Data' class='input-xlarge' name='".$field['name']."' id='".$field['id']."_".$field['name']."'>\n");
                $this->string_builder->append("\t\t</div> \n");
                $this->string_builder->append("\t</div> \n");
        }
            else
            {    
                switch ($field['type']) {
                    case "radio":
                        $this->string_builder->append("\t<div class='control-group'> \n");
                        $this->string_builder->append("\t\t<label class='control-label'>".$field['name']."</label>\n");
                        $this->string_builder->append("\t\t<div class='controls'> \n");
                        foreach ($field['options'] as $key => $value) {
                            $this->string_builder->append("\t\t\t<label class='".$field['type']."'>\n");
                            $this->string_builder->append("\t\t\t\t<input type='".$field['type']."' placeholder='Insert Data' value='".$key."' class='input-xlarge' name='".$field['name']."' id='".$field['id']."_".$field['name']."'>\n");
                            $this->string_builder->append("\t\t\t\t".$value."\n");
                            $this->string_builder->append("\t\t</label>\n");
                        }
                        $this->string_builder->append("\t\t</div> \n");
                        $this->string_builder->append("\t</div> \n");
                        break;
                    case "checkbox_group":
                        $this->string_builder->append("\t<div class='control-group'> \n");
                        $this->string_builder->append("\t\t<label class='control-label'>".$field['name']."</label>\n");
                        $this->string_builder->append("\t\t<div class='controls'> \n");
                        foreach ($field['options'] as $key => $value) {
                            $this->string_builder->append("\t\t\t<label class='".$field['type']."'>\n");
                            $this->string_builder->append("\t\t\t\t<input type='checkbox' placeholder='Insert Data' value='".$value."' class='input-xlarge' name='".$field['name']."[]"."' id='".$field['id']."_".$field['name']."'>\n");
                            $this->string_builder->append("\t\t\t\t".$value."\n");
                            $this->string_builder->append("\t\t\t</label>\n");
                        }
                        $this->string_builder->append("\t\t</div> \n");
                        $this->string_builder->append("\t</div> \n");
                        break;
                    case "textarea":
                        $this->string_builder->append("\t<div class='control-group'> \n");
                        $this->string_builder->append("\t\t<label class='control-label'>".$field['name']."</label>\n");
                        $this->string_builder->append("\t\t<div class='controls'> \n");
                        $this->string_builder->append("\t\t\t<textarea placeholder='Insert Data' class='input-xlarge' name='".$field['name']."' id='".$field['id']."_".$field['name']."'>\n");
                        $this->string_builder->append("\t\t\t</textarea> \n");
                        $this->string_builder->append("\t\t</div> \n");
                        $this->string_builder->append("\t</div> \n");
                        break;
                    case "select":
                        $this->string_builder->append("\t<div class='control-group'> \n");
                        $this->string_builder->append("\t\t<label class='control-label'>".$field['name']."</label>\n");
                        $this->string_builder->append("\t\t<div class='controls'> \n");
                        $this->string_builder->append("\t\t\t<select class='input-xlarge' name='".$field['name']."' id='".$field['id']."_".$field['name']."'>\n");
                        foreach ($field['options'] as $key => $value) {

                            $this->string_builder->append("\t\t\t\t<option value='".$key."'>".$value."</option> \n");
                        }
                        $this->string_builder->append("\t\t\t</select> \n");
                        $this->string_builder->append("\t\t</div> \n");
                        $this->string_builder->append("\t</div> \n");
                        break;
                }
            }         
        }
        $this->string_builder->append("\t<div class='control-group'>\n");
        $this->string_builder->append("\t\t<div class='controls'>\n");
        $this->string_builder->append("\t\t\t<button type='submit' class='btn btn-primary'>\n");
        $this->string_builder->append("<?php echo \$form_action == 'save' ? \$this->lang->line('create') : \$this->lang->line('update') ?>\n");
        $this->string_builder->append("\t\t\t</button>\n");
        $this->string_builder->append("\t\t\t<a class='btn' href='<?php echo \$base_url.'admin/presentation' ?>'><?php echo \$this->lang->line('cancel') ?></a>\n");
        $this->string_builder->append("\t\t</div>\n");
        $this->string_builder->append("\t</div>\n");

        $this->string_builder->append("</form> \n");
        $this->string_builder->append("</body>");
        $this->string_builder->append("</html>");

        //View List
        $template_list = file_get_contents(APPPATH.'templates/view/template_list.tpl');

        $title = '';
        $subtitle = '';
        $entity_name = joined_ucwords($entity['name']);
        $entity_name_lower = underlined_to_lower($entity_name);
        $id_name = 'ID '.$entity_name;
        $field_rep = spaced_ucwords($fields[0]['name']);
        $field_rep_name = joined_ucwords($fields[0]['name']);

        $from = array('{#title#}', '{#subtitle#}', '{#entity_name#}', '{#entity_name_lower#}', '{#id_name#}',
            '{#field_rep#}', '{#field_rep_name#}');
        $to = array($title, $subtitle, $entity_name, $entity_name_lower, $id_name, $field_rep, $field_rep_name);

        $list_output = str_replace($from, $to, $template_list);

        //View File Creation
        /*file_put_contents($this->get_export_dir_path().'/views/'.underlined_to_lower($entity['name']).'_form.php', $this->string_builder->get_string());
        file_put_contents($this->get_export_dir_path().'/views/'.underlined_to_lower($entity['name']).'_list.php', $list_output);*/
        file_put_contents('application/views/admin/'.underlined_to_lower($entity['name']).'_form.php', $this->string_builder->get_string());
        file_put_contents('application/views/admin/'.underlined_to_lower($entity['name']).'_list.php', $list_output);

    }

}
