<head>
    <link rel="stylesheet" href="Libs/Semantic-UI/semantic.css">
    <script src="Libs/AngularJS/angular.min.js"></script>
</head>
<form name="Upload"
      action="Teste01.php"
      method="POST"
      enctype="multipart/form-data"
      class="ui card form">
    <div class="ui content">
        <div class="ui field">
            <div class="ui label">Escolha o arquivo</div>
            <input type="file"
                   id="FileUoload"
                   name="FileUoload"
                   class="ui input"
                   required>
        </div>
        <div class="ui field">
            <button type="submit"
                    class="ui button">
                Enviar
            </button>
        </div>
    </div>
</form>

<?php
TestStrucuire($_FILES);

if ($_FILES) {
    $File = $_FILES["FileUoload"];

    switch ($File["type"]) {
        case "image/bmp":
            MakeUpload($File);
            break;

        case "image/gif":
            MakeUpload($File);
            break;

        case "image/jpeg":
            MakeUpload($File);
            break;

        case "image/png":
            MakeUpload($File);
            break;

        case "image/tiff":
            MakeUpload($File);
            break;

        default:
            throw new Exception("The type is not valid", 2);
    }
} else {
    throw new Exception("File not selected", 1);
}

function MakeUpload($File) {
    $orig = $File["tmp_name"];
    $dest = "Assets/Imagens/{$File["name"]}";

    $tem_content = file_get_contents($orig);
    file_put_contents($dest, $tem_content);

    unlink($orig);
}
