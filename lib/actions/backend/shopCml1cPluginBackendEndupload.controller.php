<?php

class shopCml1cPluginBackendEnduploadController extends waJsonController
{
    public function execute()
    {
        $right_path = wa()->getTempPath(null, 'shop') . '/plugins/cml1c/';
        $uploaded_file = $right_path . 'file.upload';
        if (!file_exists($uploaded_file)) return;

        $zip = new ZipArchive;
        if ($zip->open($uploaded_file) === TRUE) {

            $zip->extractTo($right_path);
            $zip->close();
        }

        unlink($uploaded_file);
    }
}