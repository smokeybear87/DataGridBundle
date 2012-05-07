<?php

/*
 * This file is part of the DataGridBundle.
 *
 * (c) Stanislav Turza <sorien@mail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sorien\DataGridBundle\Twig;

class ExportExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
                'convertHTMLtoDSV' => new \Twig_Filter_Method($this, 'convertHTMLtoDSV', array('is_safe' => array('html'))),
        );
    }

    public function convertHTMLtoDSV($value, $delimiter)
    {
        $value = trim($value);

        // Clean indent
        $value = preg_replace('/>[\s\n\t\r]*</', '><', $value);

        // title
        $value = preg_replace('#<th[^>]*?>(.*)?</th>#isU', '<th>"$1"'.$delimiter.'</th>', $value);
        $value = preg_replace('#<th>"([^'.$delimiter.']*)?";</th>#isU', '<th>$1'.$delimiter.'</th>', $value);

        // rows
        $value = str_replace('</tr>', "</tr>\n", $value);

        // cells - Add quotes around the cell value if the delimiter is find
        $value = preg_replace('#<td[^>]*?>(.*)?</td>#isU', '<td>"$1"'.$delimiter.'</td>', $value);
        $value = preg_replace('#<td>"([^'.$delimiter.']*)?";</td>#isU', '<td>$1'.$delimiter.'</td>', $value);

        // Clean HTML tags
        $value = strip_tags($value);

        // Convert Special Characters in HTML
        $value = html_entity_decode($value);

        return $value;
    }

    public function getName()
    {
        return 'datagrid_export_twig_extension';
    }
}

