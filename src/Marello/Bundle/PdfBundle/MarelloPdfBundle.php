<?php

namespace Marello\Bundle\PdfBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MarelloPdfBundle extends Bundle
{
    public function getParent()
    {
        return 'IbnabPmanagerBundle';
    }
}
