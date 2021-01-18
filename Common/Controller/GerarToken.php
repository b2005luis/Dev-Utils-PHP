<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerador de Token</title>
        <!-- Framework // jQuery -->
        <script src="../../Libraries/jQuery.js"></script>
        <!-- Framework // Semantic UI -->
        <link rel="stylesheet" href="../../Libraries/SemanticUI/semantic.css">
        <script src="../../Libraries/SemanticUI/semantic.js"></script>
    </head>
    <body>
        <form action=""
              method="POST"
              class="ui form">
            <div class="ui field">
                <label>Conteú para converter</label>
                <input type="text"
                       name="MyMD5"
                       autocomplete="false">
            </div>
            <div class="ui field">
                <button type="submit"
                        class="ui button">Converter</button>
            </div>
        </form>
        <div class="ui segment message">
            <?php
            if (isset($_POST["MyMD5"])) {
                $SessionID = strrev($_POST["MyMD5"]);
                print strtoupper(join("-", str_split(md5($SessionID), 8)));
            }
            ?>
        </div>
    </body>
</html>