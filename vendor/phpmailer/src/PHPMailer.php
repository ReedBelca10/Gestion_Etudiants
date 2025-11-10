<?php
namespace PHPMailer\PHPMailer;

class PHPMailer
{
    public $SMTPDebug = 0;
    protected $exceptions = true;
    protected $smtp = null;
    protected $debugOutput = 'echo';
    const CHARSET_ASCII = 'us-ascii';
    const CHARSET_ISO88591 = 'iso-8859-1';
    const CHARSET_UTF8 = 'utf-8';
    const CONTENT_TYPE_PLAINTEXT = 'text/plain';
    const CONTENT_TYPE_TEXT_CALENDAR = 'text/calendar';
    const CONTENT_TYPE_TEXT_HTML = 'text/html';
    const CONTENT_TYPE_MULTIPART_ALTERNATIVE = 'multipart/alternative';
    const CONTENT_TYPE_MULTIPART_MIXED = 'multipart/mixed';
    const CONTENT_TYPE_MULTIPART_RELATED = 'multipart/related';
    const ENCODING_7BIT = '7bit';
    const ENCODING_8BIT = '8bit';
    const ENCODING_BASE64 = 'base64';
    const ENCODING_BINARY = 'binary';
    const ENCODING_QUOTED_PRINTABLE = 'quoted-printable';
    const ENCRYPTION_STARTTLS = 'tls';
    const ENCRYPTION_SMTPS = 'ssl';

    public $Priority;
    public $CharSet = self::CHARSET_UTF8;
    public $ContentType = self::CONTENT_TYPE_PLAINTEXT;
    public $Encoding = self::ENCODING_8BIT;
    public $ErrorInfo = '';
    public $From = '';
    public $FromName = '';
    public $Sender = '';
    public $Subject = '';
    public $Body = '';
    public $AltBody = '';
    protected $MIMEBody = '';
    protected $MIMEHeader = '';
    protected $mailHeader = '';
    public $WordWrap = 0;
    public $Mailer = 'mail';
    public $Host = '';
    public $Port = 25;
    public $SMTPSecure = '';
    public $SMTPAutoTLS = true;
    public $SMTPAuth = false;
    public $Username = '';
    public $Password = '';
    protected $to = [];
    protected $cc = [];
    protected $bcc = [];
    protected $ReplyTo = [];
    protected $attachments = [];
    public $CustomHeader = [];

    public function __construct($exceptions = true)
    {
        $this->exceptions = $exceptions;
        $this->smtp = new SMTP;
    }

    public function isSMTP()
    {
        $this->Mailer = 'smtp';
    }

    public function setFrom($address, $name = '')
    {
        $this->From = $address;
        $this->FromName = $name;
        return true;
    }

    public function addAddress($address, $name = '')
    {
        $this->to[] = [$address, $name];
        return true;
    }

    public function Subject($subject)
    {
        $this->Subject = $subject;
        return true;
    }

    public function Body($body)
    {
        $this->Body = $body;
        return true;
    }

    public function AltBody($altBody)
    {
        $this->AltBody = $altBody;
        return true;
    }

    public function send()
    {
        try {
            if ('smtp' === $this->Mailer) {
                return $this->smtpSend();
            }
            return $this->mailSend();
        } catch (Exception $exc) {
            $this->ErrorInfo = $exc->getMessage();
            return false;
        }
    }

    protected function debugMessage($str)
    {
        if ($this->SMTPDebug <= 0) {
            return;
        }
        if ($this->debugOutput === 'echo') {
            echo $str . "\n";
        } else {
            call_user_func($this->debugOutput, $str);
        }
    }

    protected function smtpSend()
    {
        $this->debugMessage('Connecting to ' . $this->Host);
        
        try {
            if (!$this->smtp->connect($this->Host, $this->Port)) {
                throw new Exception('SMTP connect() failed');
            }
            
            if ($this->SMTPAuth) {
                if (!$this->smtp->authenticate(
                    $this->Username,
                    $this->Password
                )) {
                    throw new Exception('SMTP authenticate() failed');
                }
            }

            // Send email content
            $this->smtp->sendCommand("MAIL FROM:<{$this->From}>");
            foreach ($this->to as $to) {
                $this->smtp->sendCommand("RCPT TO:<{$to[0]}>");
            }
            
            // Send the email content
            $this->smtp->sendCommand("DATA");
            
            $header = "To: " . implode(', ', array_column($this->to, 0)) . "\r\n";
            $header .= "From: {$this->FromName} <{$this->From}>\r\n";
            $header .= "Subject: {$this->Subject}\r\n";
            $header .= "Content-Type: {$this->ContentType}; charset={$this->CharSet}\r\n";
            
            if ($this->ContentType === self::CONTENT_TYPE_TEXT_HTML) {
                $header .= "Content-Type: text/html; charset={$this->CharSet}\r\n";
            }
            
            $this->smtp->sendCommand($header . "\r\n" . $this->Body . "\r\n.");
            $this->smtp->sendCommand("QUIT");
            
            return true;
        } catch (Exception $exc) {
            $this->setError($exc->getMessage());
            $this->debugMessage($exc->getMessage());
            if ($this->exceptions) {
                throw $exc;
            }
            return false;
        }
    }

    public function isHTML($isHtml = true)
    {
        if ($isHtml) {
            $this->ContentType = static::CONTENT_TYPE_TEXT_HTML;
        } else {
            $this->ContentType = static::CONTENT_TYPE_PLAINTEXT;
        }
    }
}