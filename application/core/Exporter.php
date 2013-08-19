<?php

class Exporter extends CI_Model
{
    protected $export_dir_path;
    protected $export_dir_name;
    protected $compress_method;
    protected $compress_methods;

    const ZIP = '.zip';
    const RAR = '.rar';
    const TAR_GZ = '.tar.gz';
    const TAR_BZ = '.tar.bz2';

    public function __construct()
    {
        $this->export_dir_path = str_replace('application', 'exportables', APPPATH);
        $this->compress_method = NULL;
        $this->compress_methods = array(self::ZIP, self::RAR, self::TAR_GZ, self::TAR_BZ);
    }

    public function generate_files($format)
    {
        $this->create_dir();
        $this->process_format($format);
    }

    public function compress()
    {

    }

    public function set_compress_method($method)
    {
        $this->compress_method = $method;
    }

    public function get_compress_method()
    {
        return $this->compress_method != NULL && in_array($this->compress_method, $this->compress_methods) ?
            $this->compress_method : self::TAR_GZ;
    }

    public function get_export_dir_path()
    {
        return $this->export_dir_path;
    }

    public function get_compressed_file_path()
    {
        return $this->get_export_dir_path().$this->get_compress_method();
    }

    public function get_compressed_file_name()
    {
        return $this->export_dir_name.$this->get_compress_method();
    }
}
