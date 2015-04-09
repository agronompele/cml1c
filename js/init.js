function Init() {

    // Создаем объект - FileUploader. Задаем опции.
    var uploader = new FileUploader({

        // Сообщение об ошибке
        message_error: 'Ошибка при загрузке файла',

        // ID элемента формы
        form: 'uploadform',

        // ID элемента <input type=file
        formfiles: 'files',

        // Идентификатор загрузки
        uploadid: 'file',

        // URL скрипта загрузки
        //uploadscript: 'webasyst/shop/?plugin=cml1c&action=uploadchunk',
        //
        //donescript: 'webasyst/shop/?plugin=cml1c&action=endupload',
        uploadscript: '?plugin=cml1c&action=uploadchunk',

        donescript: '?plugin=cml1c&action=endupload',

        // Размер порции. 2 Мб
        portion: 1024 * 1024 * 2
    });
}

Init();