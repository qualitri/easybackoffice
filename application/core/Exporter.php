<?php

class Exporter extends CI_Model
{
    protected $export_dir_path;
    protected $export_dir_name;

    protected $compress_method;
    protected $compress_methods;

    public function __construct()
    {
        $this->load->library('compressor');
        $this->export_dir_path = '';
        $this->compress_method = Compressor::ZIP;
        $this->compress_methods = array(Compressor::ZIP, Compressor::RAR, Compressor::TAR_GZ, Compressor::TAR_BZ);
    }

    public function generate_files($format, $internally = false)
    {
        $this->create_dir($internally);
        $this->process_format($format);
    }

    public function compress($compress_method)
    {
        $this->set_compress_method($compress_method);

        switch($compress_method)
        {
            case Compressor::ZIP: $this->compressor->zip(); return;
            case Compressor::RAR: $this->compressor->rar(); return;
            case Compressor::TAR_GZ: $this->compressor->targz(); return;
            case Compressor::TAR_BZ: $this->compressor->tarbz(); return;
            default: $this->compressor->zip(); return;
        }
    }

    public function set_compress_method($method = NULL)
    {
        if($method != NULL && in_array($method, $this->compress_methods))
            $this->compress_method = $method;
    }

    public function get_compress_method()
    {
        $this->compress_method;
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
