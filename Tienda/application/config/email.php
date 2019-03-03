<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'ssl://smtp.gmail.com';
$config['smtp_port'] = 465;
$config['smtp_user'] = 'arq12daw@gmail.com';
$config['smtp_pass'] = 'marisma2019';
$config['smtp_timeout'] = '7';
$config['charset']    = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline']    = "\r\n";
$config['crlf'] = "\r\n";
$config['mailtype'] = 'html'; // or html
$config['validation'] = TRUE; // bool whether to validate email or not