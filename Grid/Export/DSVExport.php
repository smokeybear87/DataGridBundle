<?php

/*
 * This file is part of the DataGridBundle.
 *
 * (c) Stanislav Turza <sorien@mail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sorien\DataGridBundle\Grid\Export;

/**
 *
 * Delimiter-Separated Calues
 *
 */
class DSVExport extends Export
{
    protected $fileExtension = null;

    protected $mimeType = 'application/octet-stream';

    protected $template = 'SorienDataGridBundle:Exports:export.dsv.twig';

    protected $delimiter = null;


    public function __construct($tilte, $fileName)
    {
        $this->parameters['delimiter'] = $this->delimiter;

        parent::__construct($tilte, $fileName);
    }

    /**
     * get delimiter
     *
     * @return string
     */
    public function getDelimiter()
    {
        return $this->parameters['delimiter'];
    }

    /**
     * set delimiter
     *
     * @param string $separator
     *
     * @return self
     */
    public function setDelimiter($delimiter)
    {
        return $this->parameters['delimiter'] = $delimiter;
    }
}
