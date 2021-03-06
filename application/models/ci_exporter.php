<?php

class CI_Exporter extends Exporter
{
    private $entity_file;
    private $model_file;
    private $controller_file;
    private $views_files;
    private $app_path;

    function __construct()
    {
        parent::__construct();
        $this->entity_file = NULL;
        $this->model_file = NULL;
        $this->controller_file = NULL;
        $this->views_files = NULL;
    }

    protected function create_dir($internally = false)
    {
        if($internally)
        {
            $this->export_dir_path = substr(APPPATH, -12, -1);
            $this->app_path = substr(APPPATH, 0, -1);
        }
        else
        {
            $this->export_dir_name = 'CI_Export_'.time();
            $this->export_dir_path = str_replace('application', 'exportables', APPPATH).$this->export_dir_name;
            $this->app_path = $this->export_dir_path.'/application';

            mkdir($this->app_path);
        }

        mkdir($this->app_path.'/core');
        mkdir($this->app_path.'/entity');
        mkdir($this->app_path.'/models/admin', 0777, TRUE);
        mkdir($this->app_path.'/controllers/admin', 0777, TRUE);
        mkdir($this->app_path.'/views/admin/common', 0777, TRUE);
    }

    private function get_app_path()
    {
        return $this->app_path;
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
        $this->create_table_query($fields, $entity);
    }

    private function create_core()
    {
        copy(APPPATH.'templates/core/Base_Model.php', $this->get_app_path().'/core/Base_Model.php');
        //copy(APPPATH.'templates/core/Base_Controller_exp.php', $this->get_export_dir_path().'/core/Base_Controller_exp.php');
        copy(APPPATH.'templates/core/Backoffice_Controller.php', $this->get_app_path().'/core/Backoffice_Controller.php');

        copy(APPPATH.'templates/view/common/header_view.php', $this->get_app_path().'/views/admin/common/header_view.php');
        copy(APPPATH.'templates/view/common/footer_view.php', $this->get_app_path().'/views/admin/common/footer_view.php');
        copy(APPPATH.'templates/view/common/success_message.php', $this->get_app_path().'/views/admin/common/success_message.php');
        copy(APPPATH.'templates/view/common/confirmation_dialog.php', $this->get_app_path().'/views/admin/common/confirmation_dialog.php');
        copy(APPPATH.'templates/view/common/error_message.php', $this->get_app_path().'/views/admin/common/error_message.php');

        copy(APPPATH.'templates/view/login_form.php', $this->get_app_path().'/views/admin/login_form.php');

        copy(APPPATH.'templates/controller/auth_admin.php', $this->get_app_path().'/controllers/admin/auth_admin.php');
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
        $upper_name = joined_ucwords($entity['name']);
        $underlined_lower = underlined_to_lower($entity['name']);
        $this->string_builder->append("\n");
        $this->string_builder->append("\tpublic function setId$upper_name($".'id_'.$underlined_lower.")");
        $this->string_builder->append("\n\t{\n");
        $this->string_builder->append("\t\t".'$this->id_'.$underlined_lower.' = $id_'.$underlined_lower.';');
        $this->string_builder->append("\n\t}\n");

        $this->string_builder->append("\n");
        $this->string_builder->append("\tpublic function getId$upper_name()");
        $this->string_builder->append("\n\t{\n");
        $this->string_builder->append("\t\t".'return $this->id_'.$underlined_lower.';');
        $this->string_builder->append("\n\t}\n");
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
        file_put_contents($this->get_app_path().'/entity/'.joined_ucwords($entity['name']).'.php', $this->string_builder->get_string());

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
        file_put_contents($this->get_app_path().'/models/admin/'.$entity_name_lower.'_model.php', $output);

    }

    private function create_controller($fields, $entity)
    {
        $template = file_get_contents(APPPATH.'templates/controller/template_admin.tpl');

        $class_name = underlined_ucfirst($entity['name']);
        $entity_name = joined_ucwords($entity['name']);
        $entity_name_lower = underlined_to_lower($entity['name']);
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
        file_put_contents($this->get_app_path().'/controllers/admin/'.$entity_name_lower.'_admin.php', $output);

    }

    private function create_views($fields, $entity)
    {
        $this->load->library('string_builder');
        $entity_fields = '';
        $empty_fields = '';
        
        foreach ($fields as $key => $field) {
            
            $field_name = $field['name'];
            $field_id = $field['id'];
            $field_type = $field['type'];
            $field_name_upper = joined_ucwords($field['name']);

            if ($field['type'] == 'password' || $field['type'] == 'checkbox' || $field['type'] == 'text') {

                /*$this->string_builder->append("\t<div class='control-group'> \n");
                $this->string_builder->append("\t\t<label class='control-label'>".$field['name']."</label>\n");
                $this->string_builder->append("\t\t<div class='controls'> \n");
                $this->string_builder->append("\t\t\t<input type='".$field['type']."' value='<?php echo \$entity->get".joined_ucwords($field['name'])."(); ?>' placeholder='Insert Data' class='input-xlarge' name='".$field['name']."' id='".$field['id']."'>\n");
                $this->string_builder->append("\t\t</div> \n");
                $this->string_builder->append("\t</div> \n");*/

                $this->string_builder->flush_string();

                $template_text = file_get_contents(APPPATH.'templates/view/template_text.tpl');
                
                $from = array('{#field_name#}', '{#field_name_upper#}', '{#field_id#}');
                $to = array($field_name, $field_name_upper, $field_id);

                $entity_fields .= str_replace($from, $to, $template_text);
            }
            else
            {    
                switch ($field['type']) {
                    case "radio":

                    $this->string_builder->flush_string();

                        foreach ($field['options'] as $key => $value) {
                            $this->string_builder->append("\t\t\t<label class='".$field['type']."'>\n");
                            $this->string_builder->append("\t\t\t\t<input type='".$field['type']."' placeholder='Insert Data' <?php if(in_array('".$key."', explode(',', $entity->get".joined_ucwords($field['name'])."())) echo 'checked';} ?> value='".$key."' class='input-xlarge' name='".$field['name']."' id='".$field['id']."'>\n");
                            $this->string_builder->append("\t\t\t\t".$value."\n");
                            $this->string_builder->append("\t\t</label>\n"); 
                        }
                        $template_radio = file_get_contents(APPPATH.'templates/view/template_radio.tpl');

                        $radio_options = $this->string_builder->get_string();
                        
                        $from = array('{#field_name#}', '{#radio_options#}');
                        $to = array($field_name, $radio_options);

                        $entity_fields .= str_replace($from, $to, $template_radio);
                        break;
                    case "checkbox_group":

                    $this->string_builder->flush_string();

                        foreach ($field['options'] as $key => $value) {
                            $this->string_builder->append("\t\t\t<label class='".$field['type']."'>\n");
                            $this->string_builder->append("\t\t\t\t<input type='checkbox' placeholder='Insert Data' <?php if(in_array('".$key."', explode(',', $entity->get".joined_ucwords($field['name'])."())) echo 'checked';} ?> value='".$value."' class='input-xlarge' name='".$field['name']."[]"."' id='".$field['id']."'>\n");
                            $this->string_builder->append("\t\t\t\t".$value."\n");
                            $this->string_builder->append("\t\t\t</label>\n");
                        }
                        $template_checkboxgroup = file_get_contents(APPPATH.'templates/view/template_checkboxgroup.tpl');

                        $checkbox_options = $this->string_builder->get_string();
                        
                        $from = array('{#field_name#}', '{#checkbox_options#}');
                        $to = array($field_name, $checkbox_options);

                        $entity_fields .= str_replace($from, $to, $template_checkboxgroup);
                        break;
                    case "textarea": 

                    $this->string_builder->flush_string();

                        /*$this->string_builder->append("\t\t\t<textarea placeholder='Insert Data' class='input-xlarge' name='".$field['name']."' id='".$field['id']."'>\n");                        
                        $this->string_builder->append("\t\t\t<?php echo \$entity->get".joined_ucwords($field['name'])."() ?>\n");
                        $this->string_builder->append("\t\t\t</textarea> \n");*/

                        $template_textarea = file_get_contents(APPPATH.'templates/view/template_textarea.tpl');
                        
                        $from = array('{#field_name#}', '{#field_id#}');
                        $to = array($field_name, $field_id);

                        $entity_fields .= str_replace($from, $to, $template_textarea);
                        break;
                    case "select":

                    $this->string_builder->flush_string();

                        foreach ($field['options'] as $key => $value) {
                            $this->string_builder->append("\t\t\t\t<option value='".$key."'>\n");
                            $this->string_builder->append("\t\t\t\t\t<?php if(\$entity->get".($field['name'])."() == \$entity->get".($field['key'])."()) echo 'selected' ?>");
                            $this->string_builder->append(.$value."</option>");
                        }

                        $template_checkboxgroup = file_get_contents(APPPATH.'templates/view/template_select.tpl');

                        $select_options = $this->string_builder->get_string();
                        
                        $from = array('{#field_name#}', '{#field_id#}', '{#select_options#}');
                        $to = array($field_name, $field_id, $select_options);

                        $entity_fields .= str_replace($from, $to, $template_select);
                        break;
                }
            }         
        }
        $this->string_builder->append("\t<?php else: ?>\n");
        foreach ($fields as $key => $field) {
            
            if ($field['type'] == 'password' || $field['type'] == 'checkbox' || $field['type'] == 'text') {

                $this->string_builder->append("\t<div class='control-group <?php if(form_error('topic')) echo 'error' ?>'> \n");
                $this->string_builder->append("\t\t<label class='control-label'>".$field['name']."</label>\n");
                $this->string_builder->append("\t\t<div class='controls'> \n");
                $this->string_builder->append("\t\t\t<input type='".$field['type']."' value='<?php echo set_value('".joined_ucwords($field['name'])."'); ?>' placeholder='Insert Data' class='input-xlarge' name='".$field['name']."' id='".$field['id']."'>\n");
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
                            $this->string_builder->append("\t\t\t\t<input type='".$field['type']."' placeholder='Insert Data' <?php foreach (\$field['options'] as \$key => \$value) { if(\$entity[\$name]->".joined_ucwords($field['name'])."() == '".$key."') echo 'checked'} ?> value='".$key."' class='input-xlarge' name='".$field['name']."' id='".$field['id']."'>\n");
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
                            $this->string_builder->append("\t\t\t\t<input type='checkbox' placeholder='Insert Data' <?php foreach (\$field['options'] as \$key => \$value) { if(\$entity[\$name]->".joined_ucwords($field['name'])."() == '".$key."') echo 'checked'} ?> value='".$value."' class='input-xlarge' name='".$field['name']."[]"."' id='".$field['id']."'>\n");
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
                        $this->string_builder->append("\t\t\t<textarea placeholder='Insert Data' class='input-xlarge' name='".$field['name']."' id='".$field['id']."'>\n");                        
                        $this->string_builder->append("\t\t\t<?php echo set_value('".joined_ucwords($field['name'])."') ?>\n");
                        $this->string_builder->append("\t\t\t</textarea> \n");
                        $this->string_builder->append("\t\t</div> \n");
                        $this->string_builder->append("\t</div> \n");
                        break;
                    case "select":
                        $this->string_builder->append("\t<div class='control-group'> \n");
                        $this->string_builder->append("\t\t<label class='control-label'>".$field['name']."</label>\n");
                        $this->string_builder->append("\t\t<div class='controls'> \n");
                        $this->string_builder->append("\t\t\t<select class='input-xlarge' name='".$field['name']."' id='".$field['id']."'>\n");
                        foreach ($field['options'] as $key => $value) {
                            $this->string_builder->append("\t\t\t\t<?php foreach(\$field['options'] as \$key => \$value): ?>\n");
                            $this->string_builder->append("\t\t\t\t<option value='".$key."'>\n");
                            $this->string_builder->append("\t\t\t\t\t<?php if(set_value('".joined_ucwords($field['name'])."') == set_value('".$field['key']."')) echo 'selected' ?>");
                            $this->string_builder->append("\t\t\t\t\t".$value."</option>");
                            $this->string_builder->append("\t\t\t\t<?php endforeach; ?>");
                        }
                        $this->string_builder->append("\t\t\t</select> \n");
                        $this->string_builder->append("\t\t</div> \n");
                        $this->string_builder->append("\t</div> \n");
                        break;
                }
            }         
        }
        $this->string_builder->append("<?php endif; ?>\n");
        $this->string_builder->append("<div class='control-group'>\n");
        $this->string_builder->append("<div class='controls'>\n");
        $this->string_builder->append("<button type='submit' class='btn btn-primary'>\n");
        $this->string_builder->append("<?php echo \$form_action == 'save' ? \$this->lang->line('create') : \$this->lang->line('update') ?>\n");
        $this->string_builder->append("</button>\n");
        $this->string_builder->append("<a class='btn' href='<?php echo \$base_url.'' ?>'>cancel</a>\n");
        $this->string_builder->append("</div>\n");
        $this->string_builder->append("</div>\n");





        $this->string_builder->append("</form> \n");

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
        file_put_contents($this->get_app_path().'/views/admin/'.underlined_to_lower($entity['name']).'_form.php', $this->string_builder->get_string());
        file_put_contents($this->get_app_path().'/views/admin/'.underlined_to_lower($entity['name']).'_list.php', $list_output);

    }

    private function create_table_query($fields, $entity)
    {
        
    }

}
