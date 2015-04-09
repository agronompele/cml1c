<?php

class shopCml1cPluginBackendUploadchunkController extends waJsonController
{
    public function execute()
    {
        // Каталог в который будет загружаться файл
        $upload_dir = wa()->getTempPath(null, 'shop').'/plugins/cml1c/';
        if (!file_exists($upload_dir)) {
            waFiles::create($upload_dir, true);
        }

        // Идентификатор загрузки (аплоада). Для генерации идентификатора я обычно использую функцию md5()
        $file_id = $_SERVER["HTTP_UPLOAD_ID"];

        // Если HTTP запрос сделан методом POST, то это загрузка порции
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Имя файла получим из идентификатора загрузки
            $file_name =
                $upload_dir . "/" .
                $file_id . ".upload";

            // Если загружается первая порция, то откроем файл для записи, если не первая, то для дозаписи.
            if (intval($_SERVER["HTTP_PORTION_FROM"]) == 0)
                $fout = fopen($file_name, "wb");
            else
                $fout = fopen($file_name, "ab");

            // Если не смогли открыть файл на запись, то выдаем сообщение об ошибке
            if (!$fout) {
                header("HTTP/1.0 500 Internal Server Error");
                print "Can't open file for writing.";
                return;
            }

            // Из stdin читаем данные отправленные методом POST - это и есть содержимое порций
            $fin = fopen("php://input", "rb");
            if ($fin) {
                while (!feof($fin)) {
                    // Считаем 1Мб из stdin
                    $data = fread($fin, 1024 * 1024);
                    // Сохраним считанные данные в файл
                    fwrite($fout, $data);
                }
                fclose($fin);
            }

            fclose($fout);
        }
    }
}
