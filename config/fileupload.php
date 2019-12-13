<?php
//นามสกุลไฟล์ที่ กำหนดให้สามารถอัพโหลดได้
return [
    'allowedfileExtension' => explode(',', env('ALLOWED_FILE'))
];
