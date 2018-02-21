<?php

namespace Neo\Validation;

/**
 * File Validation
 *
 * @package Neo\Validation
 */
class File extends AbstractValidation
{
    /**
     * Holds type key to mime type mappings for known mime types.
     *
     * @var array
     */
    protected $mimeTypes = [
        'html' => ['text/html', 'text/plain'],
        'json' => ['application/json', 'text/plain'],
        'xml' => ['application/xml', 'text/xml'],
        'rss' => 'application/rss+xml',
        'ai' => 'application/postscript',
        'bcpio' => 'application/x-bcpio',
        'bin' => 'application/octet-stream',
        'ccad' => 'application/clariscad',
        'cdf' => 'application/x-netcdf',
        'class' => 'application/octet-stream',
        'cpio' => 'application/x-cpio',
        'cpt' => 'application/mac-compactpro',
        'csh' => 'application/x-csh',
        'csv' => ['text/csv', 'application/vnd.ms-excel', 'text/plain'],
        'dcr' => 'application/x-director',
        'dir' => 'application/x-director',
        'dms' => 'application/octet-stream',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'drw' => 'application/drafting',
        'dvi' => 'application/x-dvi',
        'dwg' => 'application/acad',
        'dxf' => 'application/dxf',
        'dxr' => 'application/x-director',
        'eot' => 'application/vnd.ms-fontobject',
        'eps' => ['application/postscript', 'application/octet-stream'],
        'exe' => 'application/octet-stream',
        'ez' => 'application/andrew-inset',
        'flv' => 'video/x-flv',
        'gtar' => 'application/x-gtar',
        'gz' => 'application/x-gzip',
        'bz2' => 'application/x-bzip',
        '7z' => 'application/x-7z-compressed',
        'hdf' => 'application/x-hdf',
        'hqx' => 'application/mac-binhex40',
        'ico' => 'image/x-icon',
        'ips' => 'application/x-ipscript',
        'ipx' => 'application/x-ipix',
        'js' => 'application/javascript',
        'latex' => 'application/x-latex',
        'lha' => 'application/octet-stream',
        'lsp' => 'application/x-lisp',
        'lzh' => 'application/octet-stream',
        'man' => 'application/x-troff-man',
        'me' => 'application/x-troff-me',
        'mif' => 'application/vnd.mif',
        'ms' => 'application/x-troff-ms',
        'nc' => 'application/x-netcdf',
        'oda' => 'application/oda',
        'otf' => 'font/otf',
        'pdf' => 'application/pdf',
        'pgn' => 'application/x-chess-pgn',
        'pot' => 'application/vnd.ms-powerpoint',
        'pps' => 'application/vnd.ms-powerpoint',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        'ppz' => 'application/vnd.ms-powerpoint',
        'pre' => 'application/x-freelance',
        'prt' => 'application/pro_eng',
        'ps' => 'application/postscript',
        'roff' => 'application/x-troff',
        'scm' => 'application/x-lotusscreencam',
        'set' => 'application/set',
        'sh' => 'application/x-sh',
        'shar' => 'application/x-shar',
        'sit' => 'application/x-stuffit',
        'skd' => 'application/x-koan',
        'skm' => 'application/x-koan',
        'skp' => 'application/x-koan',
        'skt' => 'application/x-koan',
        'smi' => 'application/smil',
        'smil' => 'application/smil',
        'sol' => 'application/solids',
        'spl' => 'application/x-futuresplash',
        'src' => 'application/x-wais-source',
        'step' => 'application/STEP',
        'stl' => 'application/SLA',
        'stp' => 'application/STEP',
        'sv4cpio' => 'application/x-sv4cpio',
        'sv4crc' => 'application/x-sv4crc',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
        'swf' => 'application/x-shockwave-flash',
        't' => 'application/x-troff',
        'tar' => 'application/x-tar',
        'tcl' => 'application/x-tcl',
        'tex' => 'application/x-tex',
        'texi' => 'application/x-texinfo',
        'texinfo' => 'application/x-texinfo',
        'tr' => 'application/x-troff',
        'tsp' => 'application/dsptype',
        'ttc' => 'font/ttf',
        'ttf' => 'font/ttf',
        'unv' => 'application/i-deas',
        'ustar' => 'application/x-ustar',
        'vcd' => 'application/x-cdlink',
        'vda' => 'application/vda',
        'xlc' => 'application/vnd.ms-excel',
        'xll' => 'application/vnd.ms-excel',
        'xlm' => 'application/vnd.ms-excel',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'xlw' => 'application/vnd.ms-excel',
        'zip' => 'application/zip',
        'aif' => 'audio/x-aiff',
        'aifc' => 'audio/x-aiff',
        'aiff' => 'audio/x-aiff',
        'au' => 'audio/basic',
        'kar' => 'audio/midi',
        'mid' => 'audio/midi',
        'midi' => 'audio/midi',
        'mp2' => 'audio/mpeg',
        'mp3' => 'audio/mpeg',
        'mpga' => 'audio/mpeg',
        'ogg' => 'audio/ogg',
        'oga' => 'audio/ogg',
        'spx' => 'audio/ogg',
        'ra' => 'audio/x-realaudio',
        'ram' => 'audio/x-pn-realaudio',
        'rm' => 'audio/x-pn-realaudio',
        'rpm' => 'audio/x-pn-realaudio-plugin',
        'snd' => 'audio/basic',
        'tsi' => 'audio/TSP-audio',
        'wav' => 'audio/x-wav',
        'aac' => 'audio/aac',
        'asc' => 'text/plain',
        'c' => 'text/plain',
        'cc' => 'text/plain',
        'css' => 'text/css',
        'etx' => 'text/x-setext',
        'f' => 'text/plain',
        'f90' => 'text/plain',
        'h' => 'text/plain',
        'hh' => 'text/plain',
        'ics' => 'text/calendar',
        'm' => 'text/plain',
        'rtf' => 'text/rtf',
        'rtx' => 'text/richtext',
        'sgm' => 'text/sgml',
        'sgml' => 'text/sgml',
        'tsv' => 'text/tab-separated-values',
        'tpl' => 'text/template',
        'txt' => 'text/plain',
        'text' => 'text/plain',
        'avi' => 'video/x-msvideo',
        'fli' => 'video/x-fli',
        'mov' => 'video/quicktime',
        'movie' => 'video/x-sgi-movie',
        'mpe' => 'video/mpeg',
        'mpeg' => 'video/mpeg',
        'mpg' => 'video/mpeg',
        'qt' => 'video/quicktime',
        'viv' => 'video/vnd.vivo',
        'vivo' => 'video/vnd.vivo',
        'ogv' => 'video/ogg',
        'webm' => 'video/webm',
        'mp4' => 'video/mp4',
        'm4v' => 'video/mp4',
        'f4v' => 'video/mp4',
        'f4p' => 'video/mp4',
        'm4a' => 'audio/mp4',
        'f4a' => 'audio/mp4',
        'f4b' => 'audio/mp4',
        'gif' => 'image/gif',
        'ief' => 'image/ief',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpe' => 'image/jpeg',
        'pbm' => 'image/x-portable-bitmap',
        'pgm' => 'image/x-portable-graymap',
        'png' => 'image/png',
        'pnm' => 'image/x-portable-anymap',
        'ppm' => 'image/x-portable-pixmap',
        'ras' => 'image/cmu-raster',
        'rgb' => 'image/x-rgb',
        'tif' => 'image/tiff',
        'tiff' => 'image/tiff',
        'xbm' => 'image/x-xbitmap',
        'xpm' => 'image/x-xpixmap',
        'xwd' => 'image/x-xwindowdump',
        'ice' => 'x-conference/x-cooltalk',
        'iges' => 'model/iges',
        'igs' => 'model/iges',
        'mesh' => 'model/mesh',
        'msh' => 'model/mesh',
        'silo' => 'model/mesh',
        'vrml' => 'model/vrml',
        'wrl' => 'model/vrml',
        'mime' => 'www/mime',
        'pdb' => 'chemical/x-pdb',
        'xyz' => 'chemical/x-pdb',
        'javascript' => 'application/javascript',
        'form' => 'application/x-www-form-urlencoded',
        'file' => 'multipart/form-data',
        'xhtml' => ['application/xhtml+xml', 'application/xhtml', 'text/xhtml'],
        'xhtml-mobile' => 'application/vnd.wap.xhtml+xml',
        'atom' => 'application/atom+xml',
        'amf' => 'application/x-amf',
        'wap' => ['text/vnd.wap.wml', 'text/vnd.wap.wmlscript', 'image/vnd.wap.wbmp'],
        'wml' => 'text/vnd.wap.wml',
        'wmlscript' => 'text/vnd.wap.wmlscript',
        'wbmp' => 'image/vnd.wap.wbmp',
        'woff' => 'application/x-font-woff',
        'webp' => 'image/webp',
        'appcache' => 'text/cache-manifest',
        'manifest' => 'text/cache-manifest',
        'htc' => 'text/x-component',
        'rdf' => 'application/xml',
        'xpi' => 'application/x-xpinstall',
        'safariextz' => 'application/octet-stream',
        'webapp' => 'application/x-web-app-manifest+json',
        'vcf' => 'text/x-vcard',
        'vtt' => 'text/vtt',
        'mkv' => 'video/x-matroska',
    ];

    private $totalSize = 0;

    protected $maxSize;
    protected $maxSizeMessage = 'File size is too big.';
    protected $minSize;
    protected $minSizeMessage = 'File size is too small.';
    protected $extension = [];
    protected $extensionMessage = 'This file extension is not allowed.';
    protected $mime = [];
    protected $disallowExtension = ['php'];
    protected $allowEveryExtension = false;
    protected $totalUploadSize;
    protected $totalUploadSizeMessage = 'Total allowed upload size is %allow_total_size% but
     you tried to upload %total_upload_size%';

    /**
     * File constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (isset($parameters['max_size'])) {
            $this->setMaxSize($parameters['max_size']);
        }

        if (isset($parameters['max_size_message'])) {
            $this->setMaxSizeMessage($parameters['max_size_message']);
        }

        if (isset($parameters['min_size'])) {
            $this->setMinSize($parameters['min_size']);
        }

        if (isset($parameters['extension'])) {
            $this->setExtension($parameters['extension']);
        }

        if (isset($parameters['ext_message'])) {
            $this->setExtensionMessage($parameters['ext_message']);
        }

        if (isset($parameters['mime'])) {
            $this->setMime($parameters['mime']);
        }

        if (isset($parameters['dis_allow_extension'])) {
            $this->setDisallowExtension($parameters['dis_allow_extension']);
        }

        if (isset($parameters['allow_every_extension'])) {
            $this->setAllowEveryExtension($parameters['allow_every_extension']);
        }

        if (isset($parameters['total_upload_size'])) {
            $this->setTotalUploadSize($parameters['total_upload_size']);
        }

        if (isset($parameters['total_upload_size_message'])) {
            $this->setTotalUploadSizeMessage($parameters['total_upload_size_message']);
        }
    }

    /**
     * Internal validation
     * This is a per file validation
     *
     * @param array $data data to use
     *
     * @return bool
     * @throws Exception
     */
    private function internalValidate($data)
    {
        if ($data['error'] == UPLOAD_ERR_NO_FILE) {
            return true;
        }

        if (isset($data['error']) && $data['error'] != UPLOAD_ERR_OK) {
            throw new Exception($this->codeToMessage($data['error']));
        } elseif (!is_uploaded_file($data['tmp_name'])) {
            throw new Exception('File is not uploaded!');
        }

        $this->totalSize += $data['size'];

        if (null !== $this->maxSize && $this->maxSize < $data['size']) {
            throw new Exception($this->maxSizeMessage);
        }

        if (null !== $this->minSize && $this->minSize > $data['size']) {
            throw new Exception($this->minSizeMessage);
        }

        $fileData = \Neo\Filesystem\File::pathinfo($data['name']);
        $ext = strtolower($fileData['extension']);

        if (!empty($this->extension) && !in_array($ext, $this->extension)) {
            throw new Exception($this->extensionMessage);
        }

        $fileInfoH = finfo_open();
        $mime = finfo_file($fileInfoH, $data['tmp_name'], FILEINFO_MIME_TYPE);
        finfo_close($fileInfoH);

        if ((!empty($this->mime) && !in_array($mime, $this->mime))
            || !array_key_exists($ext, $this->mimeTypes)
            || (!$this->allowEveryExtension &&
                !empty($this->disallowExtension) &&
                in_array($ext, $this->disallowExtension))
        ) {
            throw new Exception($this->extensionMessage);
        }

        if ((is_array($this->mimeTypes[$ext]) && !in_array($mime, $this->mimeTypes[$ext])) ||
            (is_string($this->mimeTypes[$ext]) && $this->mimeTypes[$ext] != $mime)
        ) {
            throw new Exception(sprintf('The "%s" extension doesn\'t match with file\'s content.', $ext));
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        $errors = [];
        if (is_array($data) &&
            isset($data['name']) &&
            isset($data['type']) &&
            isset($data['size']) &&
            isset($data['tmp_name'])
        ) {
            return $this->internalValidate($data);
        } elseif (is_array($data)) {
            foreach ($data as $file) {
                if (isset($file['name']) && isset($file['type']) && isset($file['size']) && isset($file['tmp_name'])) {
                    try {
                        $this->internalValidate($file);
                    } catch (Exception $e) {
                        $errors[$file['name']] = $e->getMessage();
                    }
                }
            }

            if (null !== $this->totalUploadSize && $this->totalSize > $this->totalUploadSize) {
                throw new Exception(
                    strtr(
                        $this->totalUploadSizeMessage,
                        [
                            '%allow_total_size%' => $this->formatBytes($this->totalUploadSize),
                            '%total_upload_size%' => $this->formatBytes($this->totalSize)
                        ]
                    )
                );
            }

            if ($errors) {
                $errorMsg = [];
                foreach ($errors as $fileName => $msg) {
                    $errorMsg[] = $fileName . ': ' . $msg;
                }
                throw new Exception(implode(', ', $errorMsg));
            }
        }

        return true;
    }

    /**
     * Convert error code to string.
     *
     * @param int $code Error code
     *
     * @return string
     */
    private function codeToMessage($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
                $message = 'The uploaded file exceeds the upload max file size';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = 'The uploaded file was only partially uploaded';
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = 'No file was uploaded';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = 'Missing a temporary folder';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = 'Failed to write file to disk';
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = 'File upload stopped by extension';
                break;

            default:
                $message = 'Unknown upload error';
                break;
        }

        return $message;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'file';
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationOptions()
    {
        return $this->parameters;
    }

    /**
     * Format File size
     *
     * @param int $bytes     size in bytes
     * @param int $precision Precision
     *
     * @return string
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        // or $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    /**
     * Set max file size
     *
     * @param int $maxSize Max file size
     *
     * @return self
     */
    public function setMaxSize($maxSize)
    {
        $this->maxSize = intval($maxSize);

        return $this;
    }

    /**
     * Set max size message
     *
     * @param string $maxSizeMessage Max size validation message
     *
     * @return self
     */
    public function setMaxSizeMessage($maxSizeMessage)
    {
        $this->maxSizeMessage = strval($maxSizeMessage);

        return $this;
    }

    /**
     * Set min file size
     *
     * @param int $minSize Min file size
     *
     * @return self
     */
    public function setMinSize($minSize)
    {
        $this->minSize = intval($minSize);

        return $this;
    }

    /**
     * Set min size message
     *
     * @param string $minSizeMessage Min size validation message
     *
     * @return self
     */
    public function setMinSizeMessage($minSizeMessage)
    {
        $this->minSizeMessage = $minSizeMessage;

        return $this;
    }

    /**
     * Set allow extension
     *
     * @param array $extension File extensions
     *
     * @return self
     */
    public function setExtension($extension)
    {
        if (!is_array($extension)) {
            $extension = [$extension];
        }

        $this->extension = array_filter(array_map('strtolower', $extension));

        return $this;
    }

    /**
     * Set extension validation message
     *
     * @param string $extensionMessage Extension validation message
     *
     * @return self
     */
    public function setExtensionMessage($extensionMessage)
    {
        $this->extensionMessage = strval($extensionMessage);

        return $this;
    }

    /**
     * Set allow mime
     *
     * @param array $mime File mime
     *
     * @return self
     */
    public function setMime($mime)
    {
        if (!is_array($mime)) {
            $mime = [$mime];
        }

        $this->mime = array_filter(array_map('strtolower', $mime));

        return $this;
    }

    /**
     * Set disallow extension
     *
     * @param array $disallowExtension Disallow file extension
     *
     * @return self
     */
    public function setDisallowExtension($disallowExtension)
    {
        if (!is_array($disallowExtension)) {
            $disallowExtension = [$disallowExtension];
        }

        $disallowExtension = array_filter(array_map('strtolower', $disallowExtension));
        $this->disallowExtension = array_merge($disallowExtension, $this->disallowExtension);

        return $this;
    }

    /**
     * Set allow every extension
     *
     * @param boolean $allowEveryExtension Allow every extension
     *
     * @return self
     */
    public function setAllowEveryExtension($allowEveryExtension)
    {
        $this->allowEveryExtension = boolval($allowEveryExtension);

        return $this;
    }

    /**
     * Set total upload size
     *
     * @param int $totalUploadSize Total upload size
     *
     * @return self
     */
    public function setTotalUploadSize($totalUploadSize)
    {
        $this->totalUploadSize = intval($totalUploadSize);

        return $this;
    }

    /**
     * Set total upload size message
     *
     * @param string $totalUploadSizeMessage Total upload size validation message
     *
     * @return self
     */
    public function setTotalUploadSizeMessage($totalUploadSizeMessage)
    {
        $this->totalUploadSizeMessage = strval($totalUploadSizeMessage);

        return $this;
    }
}
