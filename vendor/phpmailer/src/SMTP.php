<?php

namespace PHPMailer\PHPMailer;

class SMTP
{
    const VERSION = '6.8.0';
    const CRLF = "\r\n";
    const DEFAULT_SMTP_PORT = 25;
    const MAX_LINE_LENGTH = 998;
    const DEBUG_OFF = 0;
    const DEBUG_CLIENT = 1;
    const DEBUG_SERVER = 2;
    const DEBUG_CONNECTION = 3;
    const DEBUG_LOWLEVEL = 4;

    public $do_debug = self::DEBUG_OFF;
    public $Debugoutput = 'echo';
    public $do_verp = false;
    public $Timeout = 300;
    public $Timelimit = 300;
    public $Host = 'localhost';
    public $Port = self::DEFAULT_SMTP_PORT;
    public $Helo = '';
    public $hello_host = '';
    protected $smtp_conn;
    protected $error = [];
    protected $last_reply = '';
    protected $hello_string = '';

    public function connect($host, $port = null, $timeout = 30, $options = [])
    {
        $this->Host = $host;
        if (null === $port) {
            $port = self::DEFAULT_SMTP_PORT;
        }
        $this->Port = (int) $port;
        $this->Timeout = (int) $timeout;
        $this->smtp_conn = fsockopen(
            $this->Host,
            $this->Port,
            $errno,
            $errstr,
            $this->Timeout
        );
        if (empty($this->smtp_conn)) {
            $this->error = [
                'error' => 'Failed to connect to server',
                'errno' => $errno,
                'errstr' => $errstr,
            ];
            return false;
        }
        return true;
    }

    public function startTLS()
    {
        return stream_socket_enable_crypto(
            $this->smtp_conn,
            true,
            STREAM_CRYPTO_METHOD_TLS_CLIENT
        );
    }

    public function authenticate($username, $password)
    {
        $this->sendCommand('AUTH LOGIN');
        $this->sendCommand(base64_encode($username));
        return $this->sendCommand(base64_encode($password));
    }

    public function sendCommand($command)
    {
        if (!is_resource($this->smtp_conn)) {
            $this->error = ['error' => 'No connection established'];
            return false;
        }
        fputs($this->smtp_conn, $command . self::CRLF);
        return $this->getResponse();
    }

    protected function getResponse()
    {
        $response = '';
        $endtime = time() + $this->Timeout;
        while (is_resource($this->smtp_conn) && !feof($this->smtp_conn)) {
            $line = @fgets($this->smtp_conn, 515);
            $response .= $line;
            if (!empty($line) && $line[3] === ' ') {
                break;
            }
            if (time() > $endtime) {
                break;
            }
        }
        return !empty($response);
    }

    public function close()
    {
        if (is_resource($this->smtp_conn)) {
            fclose($this->smtp_conn);
        }
        $this->smtp_conn = null;
        $this->error = [];
        $this->last_reply = '';
    }
}